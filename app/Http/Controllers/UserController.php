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
            'user_id' => 'exists:user,id'
        ]);
        Membership::firstWhere('user_id',$validated['id'])->update([
            'isRemoved' => true,
            'left_at' => now()
        ]); 

         return redirect()->back();
    }
}
