<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Membership;
use BaconQrCode\Renderer\Image\EpsImageBackEnd;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        if ($user->isBanned) {
            return view('banned');
        }
        if (session()->has('invitation_token')) {
            $token = session()->get('invitation_token');
            $invitation = \App\Models\Invitation::where('token', $token)->where('status', 'pending')->first();

            if ($invitation) {
                if (!$invitation->colocation->members->contains($user->id)) {
                    $invitation->colocation->members()->attach($user->id, ['role' => 'member']);
                    $invitation->update(['status' => 'accepted', 'responded_at' => now()]);
                    session()->forget('invitation_token');
                    return redirect()->route('dashboard.index');
                }
            }
            session()->forget('invitation_token');
        }

        $membership = Membership::with([
            'colocation' => function ($q) {
                $q->where('status' , '=', 'active');
            },
            'colocation.categories',
            'colocation.expenses.payments',
            'colocation.expenses.user',
            'colocation.members' => function ($query) {
                $query->whereNull('left_at');
            }
        ])
            ->where('user_id', $user->id)
            ->whereNull('left_at')
            ->first();

        if ($membership && $membership->colocation) {
            $colocation = $membership->colocation;
            $userId = auth()->id();
            if ($colocation->status !== 'active') {
                return view('dashboard')->with('status', 'votre derniere colocation a été annulé le ' . $colocation->updated_at->format('M d Y'));
            }
            
            $filteredExpenses = self::filterExpensesByDate($colocation->expenses, $request);
            $colocation->filteredExpenses = $filteredExpenses;
            
            $userExpenses = $colocation->expenses->where('user_id', '=', $userId)->sum('amount');

            $totalExpenses = $colocation->expenses->sum('amount');
            $numberOfMembers = $colocation->members->count();
            $userFairShare = $numberOfMembers > 0 ? $totalExpenses / $numberOfMembers : 0;
            $userPaymentsMade = 0;

            foreach ($colocation->expenses as $expense) {
                $userPaymentsMade += $expense->payments->where('payer_id', '=', $userId)->sum('amount');
            }

            $userPaymentsReceived = 0;
            foreach ($colocation->expenses->where('user_id', '=', $userId) as $expense) {
                $userPaymentsReceived += $expense->payments->sum('amount');
            }

            $userSolde = ($userExpenses - $userFairShare) + ($userPaymentsMade - $userPaymentsReceived);

            $activeDebts = $userSolde < 0 ? abs($userSolde) : 0;

            $role = $user->isAdmin ? 'Admin Global' : ($user->isOwner ? 'owner' : 'member');

            $balances = [];
            $share = $totalExpenses / max($numberOfMembers, 1);

            foreach ($colocation->members as $member) {

                $spent = $colocation->expenses->where('user_id', $member->id)->sum('amount');

                $paymentsMade = 0;
                foreach ($colocation->expenses as $expense) {
                    $paymentsMade += $expense->payments->where('payer_id', $member->id)->sum('amount');
                }

                $paymentsReceived = 0;
                foreach ($colocation->expenses->where('user_id', $member->id) as $expense) {
                    $paymentsReceived += $expense->payments->sum('amount');
                }

                $net = ($spent - $share) + ($paymentsMade - $paymentsReceived);

                $balances[] = [
                    'user' => $member,
                    'amount' => $net
                ];
            }
            ;

            $debtors = array_filter($balances, fn($b) => $b['amount'] < 0);
            $creditors = array_filter($balances, fn($b) => $b['amount'] > 0);

            usort($debtors, fn($a, $b) => $a['amount'] <=> $b['amount']);
            usort($creditors, fn($a, $b) => $b['amount'] <=> $a['amount']);

            $owes = [];

            while (!empty($debtors) && !empty($creditors)) {
                $debtor = array_shift($debtors);
                $creditor = array_shift($creditors);

                $amount = min(abs($debtor['amount']), $creditor['amount']);

                $creditorExpense = $colocation->expenses->where('user_id', $creditor['user']->id)->first();

                $owes[] = [
                    'from' => $debtor['user'],
                    'to' => $creditor['user'],
                    'amount' => $amount,
                    'expense_id' => $creditorExpense ? $creditorExpense->id : null
                ];

                $debtor['amount'] += $amount;
                $creditor['amount'] -= $amount;

                if ($debtor['amount'] < 0) {
                    array_unshift($debtors, $debtor);
                }
                if ($creditor['amount'] > 0) {
                    array_unshift($creditors, $creditor);
                }
            }
            
            $owes = self::clearRemovedMembersOwes($owes, $colocation);
            
            $selectedMonth = $request->input('month', '');
            $selectedYear = $request->input('year', '');
            
            return view('dashboard', compact('colocation', 'role', 'userExpenses', 'userSolde', 'activeDebts', 'totalExpenses', 'owes', 'selectedMonth', 'selectedYear'));
        }

        return view('dashboard', ['colocation' => null]);
    }

    private static function filterExpensesByDate($expenses, Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');

        if (!$month || !$year) {
            return $expenses;
        }

        return $expenses->filter(function ($expense) use ($month, $year) {
            $expenseDate = \Carbon\Carbon::parse($expense->created_at);
            return $expenseDate->format('m') === $month && $expenseDate->format('Y') === $year;
        });
    }

    private static function clearRemovedMembersOwes($owes, $colocation)
    {
        $owner = $colocation->members->firstWhere('pivot.role', 'owner');

        $consolidated = [];

        foreach ($owes as $owe) {
            // remplacer les dettes des membres retirer aux owner
            $from = $owe['from']->pivot->isRemoved ? $owner : $owe['from'];
            $to = $owe['to']->pivot->isRemoved ? $owner : $owe['to'];
            
            // en cas d'un membre a une dettes aux owner 
            if ($from->id === $to->id) {
                continue;
            }

            // en cas des dettes duplicer entre les memes users 
            $key = $from->id . '_' . $to->id;
            if (isset($consolidated[$key])) {
                $consolidated[$key]['amount'] += $owe['amount'];
            } else {
                $consolidated[$key] = [
                    'from' => $from,
                    'to' => $to,
                    'amount' => $owe['amount'],
                    'expense_id' => $owe['expense_id'] ?? null
                ];
            }
        }

        return array_values($consolidated);
    }
}
