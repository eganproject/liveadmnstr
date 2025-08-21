<?php

namespace App\Http\Controllers\Admin\Masterdata;

use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jabatans = Jabatan::all();
        return view("admin.masterdata.jabatan.index", compact('jabatans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Not needed as we are using the index page for creation
        return redirect()->route('admin.masterdata.jabatan.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:jabatans,name',
            'description' => 'nullable|string|max:255',
        ]);

        Jabatan::create($request->all());

        return redirect()->route('admin.masterdata.jabatan.index')
                         ->with('success', 'Jabatan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jabatan $jabatan)
    {
        // Not needed for this implementation
        return redirect()->route('admin.masterdata.jabatan.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jabatan $jabatan)
    {
        // Not needed as we are using the index page for editing
        return redirect()->route('admin.masterdata.jabatan.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jabatan $jabatan)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:jabatans,name,' . $jabatan->id,
            'description' => 'nullable|string|max:255',
        ]);

        $jabatan->update($request->all());

        return redirect()->route('admin.masterdata.jabatan.index')
                         ->with('success', 'Jabatan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jabatan $jabatan)
    {
        $jabatan->delete();

        return redirect()->route('admin.masterdata.jabatan.index')
                         ->with('success', 'Jabatan berhasil dihapus.');
    }
}