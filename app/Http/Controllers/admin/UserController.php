<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {

        $users = User::withCount('colocations')->latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function ban(User $user)
    {
        if ($user->isOwner) {
            return redirect()->back()->with('failure', 'les proprietaires des colocations ne peuvent pas etre bannis');
        }
        $user->update(['isBanned' => true]);
        return redirect()->back();
    }

    public function unban(User $user)
    {
        $user->update(['isBanned' => false]);
        return redirect()->back();
    }
}
