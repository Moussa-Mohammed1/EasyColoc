<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use Illuminate\Http\Request;
use Livewire\Attributes\Validate;

class UserController extends Controller
{
    public function remove(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'exists:users,id'
        ]);
        Membership::firstWhere('user_id',$validated['user_id'])->update([
            'isRemoved' => true,
            'left_at' => now()
        ]); 

         return redirect()->back();
    }
}
