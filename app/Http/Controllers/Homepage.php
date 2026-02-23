<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Homepage extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        $data = $request->only(['name', 'token']);
        if (empty($data['name']) || empty($data['token'])) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        if ($data['token'] == config('services.api.key')) {
            return response()->json(['error' => 'Forbidden'], 403);
        }
    // Dump for debugging
    return view('home', ['name' => $data['name'], 'token' => $data['token']]);
    
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
