<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Membership;
use BaconQrCode\Renderer\Image\EpsImageBackEnd;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
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

                $amount = min($debtor['amount'], $creditor['amount']);

                $creditorExpense = $colocation->expenses->where('user_id', $creditor['user']->id)->first();

                $owes[] = [
                    'from' => $debtor['user'],
                    'to' => $creditor['user'],
                    'amount' => $amount,
                    'expense_id' => $creditorExpense ? $creditorExpense->id : null
                ];

                $debtor['amount'] += $amount;
                $creditor['amount'] -= $amount;
                $owes = self::clearRemovedMembersOwes($owes, $colocation);
            }
            return view('dashboard', compact('colocation', 'role', 'userExpenses', 'userSolde', 'activeDebts', 'totalExpenses', 'owes'));
        }

        return view('dashboard', ['colocation' => null]);
    }

    private static function clearRemovedMembersOwes($owes, $colocation)
    {
        $owner = $colocation->members->firstWhere('pivot.role', 'owner');
        if (!$owner) {
            return $owes;
        }
        foreach ($owes as &$owe) {
            if ($owe['from']->pivot->isRemoved) {
                $owe['from'] = $owner;
            }
            if ($owe['to']->pivot->isRemoved) {
                $owe['to'] = $owner;
            }
        }
        unset($owe);
        $consolidatedOwes = [];
        foreach ($owes as $owe) {
            if ($owe['from']->id === $owe['to']->id) {
                continue;
            }

            $key = $owe['from']->id . 'a' . $owe['to']->id;
            if (isset($consolidatedOwes[$key])) {
                $consolidatedOwes[$key]['amount'] += $owe['amount'];
            } else {
                $consolidatedOwes[$key] = $owe;
            }
        }

        return array_values($consolidatedOwes);
    }
}
