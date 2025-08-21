<?php

namespace App\Http\Controllers\Admin\Masterdata;

use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use App\Models\Karyawan;
use App\Models\Toko;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $karyawans = Karyawan::with('jabatan', 'toko')->get();
        $jabatans = Jabatan::all();
        $tokos = Toko::all();
        return view('admin.masterdata.karyawan.index', compact('karyawans', 'jabatans', 'tokos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:karyawans,email',
            'jabatan_id' => 'required|exists:jabatans,id',
            'toko_id' => 'required|exists:tokos,id',
        ]);

        Karyawan::create($request->all());

        return redirect()->route('admin.masterdata.karyawan.index')
                         ->with('success', 'Karyawan created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Karyawan $karyawan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Karyawan $karyawan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Karyawan $karyawan)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:karyawans,email,' . $karyawan->id,
            'jabatan_id' => 'required|exists:jabatans,id',
            'toko_id' => 'required|exists:tokos,id',
        ]);

        $karyawan->update($request->all());

        return redirect()->route('admin.masterdata.karyawan.index')
                         ->with('success', 'Karyawan updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Karyawan $karyawan)
    {
        $karyawan->delete();

        return redirect()->route('admin.masterdata.karyawan.index')
                         ->with('success', 'Karyawan deleted successfully.');
    }
}
