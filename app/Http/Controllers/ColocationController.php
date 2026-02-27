<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreColocationRequest;
use App\Models\Colocation;
use App\Models\Membership;
use Illuminate\Http\Request;

class ColocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreColocationRequest $request)
    {
        $validated = $request->validated();
        $owner_id = auth()->user()->id;
        $c = Colocation::create([
            'name'=> $validated['name'],
            'description' => $validated['description'] ?? null,
            'owner_id' => $owner_id,
            'status' => 'active',
        ]);
        Membership::create([
            'user_id' => $owner_id,
            'colocation_id' => $c->id,
            'role' => 'owner'
        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
