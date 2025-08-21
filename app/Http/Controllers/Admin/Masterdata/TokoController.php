<?php

namespace App\Http\Controllers\Admin\Masterdata;

use App\Http\Controllers\Controller;
use App\Models\Toko;
use Illuminate\Http\Request;

class TokoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tokos = Toko::all();
        return view("admin.masterdata.toko.index", compact('tokos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Not needed for this implementation
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Toko::create($request->all());

        return redirect()->route('admin.masterdata.toko.index')
                         ->with('success', 'Toko created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Toko $toko)
    {
        // Not needed for this implementation
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Toko $toko)
    {
        // Not needed for this implementation
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Toko $toko)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $toko->update($request->all());

        return redirect()->route('admin.masterdata.toko.index')
                         ->with('success', 'Toko updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Toko $toko)
    {
        $toko->delete();

        return redirect()->route('admin.masterdata.toko.index')
                         ->with('success', 'Toko deleted successfully.');
    }
}
