<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CardControl;

use Illuminate\Http\Request;

class CardContrller extends Controller
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
    public function create(Request $request)
{
    // 1. Validate
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'AccessLevel' => 'required|array', 
        'route' => 'required|string',
        'order' => 'integer',
    ]);

    // 2. IMPORTANT: If you ARE NOT using $casts in the Model, 
    // fix the double $$ and re-assign the encoded value:
    $validated['AccessLevel'] = json_encode($validated['AccessLevel']);

    // 3. Create
    CardControl::create($validated);

    // 4. Redirect
    return redirect()->route('home')->with('success', 'Card created successfully!');
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
