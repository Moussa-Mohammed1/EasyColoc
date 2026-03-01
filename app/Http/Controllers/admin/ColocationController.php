<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Colocation;
use Illuminate\Http\Request;

class ColocationController extends Controller
{
    public function index()
    {
        $colocations = Colocation::with(['user', 'members'])->latest()->paginate(15);

        return view('admin.colocations.index', compact('colocations'));
    }

    public function show(Colocation $colocation)
    {
        $colocation->load(['user', 'members', 'expenses.user', 'expenses.payments']);
        
        return view('admin.colocations.show', compact('colocation'));
    }

    public function updateStatus(Colocation $colocation, Request $request)
    {
        $request->validate([
            'status' => 'required'
        ]);

        $colocation->update(['status' => $request->status]);
        
        return redirect()->back();
    }
}
