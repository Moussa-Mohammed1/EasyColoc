<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Colocation;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        
        $totalUsers = User::count();
        $activeColocations = Colocation::where('status', 'active')->count();
        
        $totalExpenses = Expense::sum('amount');
        $bannedUsers = User::where('isBanned', true)->count();
        $recentColocations = Colocation::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'activeColocations',
            'recentColocations',
            'totalExpenses',
            'bannedUsers',
        ));
    }
}
