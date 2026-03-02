<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Colocation;
use Illuminate\Http\Request;

class ColocationController extends Controller
{
    public function index(Request $request)
    {
        $query = Colocation::with(['user', 'members', 'expenses'])
            ->withCount('members');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $colocations = $query->latest()->paginate(15)->withQueryString();

        return view('admin.colocations.index', compact('colocations'));
    }

    public function show(Colocation $colocation)
    {
        $colocation->load(['user', 'members', 'expenses.user', 'expenses.payments']);
        
        return view('admin.colocations.show', compact('colocation'));
    }

    
}
