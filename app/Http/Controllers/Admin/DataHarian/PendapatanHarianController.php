<?php

namespace App\Http\Controllers\Admin\DataHarian;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\PendapatanHarian;
use App\Models\Toko;
use Illuminate\Http\Request;
use DataTables;

class PendapatanHarianController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = PendapatanHarian::with(['karyawan', 'toko']);

            // Apply date filter
            if ($request->has('filter_tanggal') && !empty($request->input('filter_tanggal'))) {
                $filterDate = $request->input('filter_tanggal');
                $data->whereDate('tanggal', $filterDate);
            }

            // Apply store filter
            if ($request->has('filter_toko_id') && !empty($request->input('filter_toko_id'))) {
                $filterTokoId = $request->input('filter_toko_id');
                $data->where('toko_id', $filterTokoId);
            }

            // Apply employee filter
            if ($request->has('filter_karyawan_id') && !empty($request->input('filter_karyawan_id'))) {
                $filterKaryawanId = $request->input('filter_karyawan_id');
                $data->where('karyawan_id', $filterKaryawanId);
            }

            // Apply search filter
            if ($request->has('search') && !empty($request->input('search')['value'])) {
                $searchValue = $request->input('search')['value'];
                $data->where(function($query) use ($searchValue) {
                    $query->where('tanggal', 'like', '%' . $searchValue . '%')
                          ->orWhereHas('karyawan', function($q) use ($searchValue) {
                              $q->where('name', 'like', '%' . $searchValue . '%');
                          })
                          ->orWhereHas('toko', function($q) use ($searchValue) {
                              $q->where('name', 'like', '%' . $searchValue . '%');
                          })
                          ->orWhere('jumlah_like', 'like', '%' . $searchValue . '%')
                          ->orWhere('jumlah_komentar', 'like', '%' . $searchValue . '%')
                          ->orWhere('jumlah_ditonton', 'like', '%' . $searchValue . '%')
                          ->orWhere('jumlah_penjualan', 'like', '%' . $searchValue . '%')
                          ->orWhere('sesi', 'like', '%' . $searchValue . '%')
                          ->orWhere('jam_mulai', 'like', '%' . $searchValue . '%')
                          ->orWhere('jam_selesai', 'like', '%' . $searchValue . '%');
                });
            }

            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('jumlah_penjualan', function ($row) {
                    return 'Rp. ' . number_format($row->jumlah_penjualan, 0, ',', '.');
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('admin.dataharian.pendapatan-harian.edit', $row->id);
                    $deleteUrl = route('admin.dataharian.pendapatan-harian.destroy', $row->id);

                    $btn = '<div class="flex items-center space-x-2">';
                    $btn .= '<a href="' . $editUrl . '" class="text-blue-500 hover:text-blue-700" title="Edit">';
                    $btn .= '<i data-lucide="pencil" class="w-5 h-5"></i>';
                    $btn .= '</a>';
                    $btn .= '<form action="' . $deleteUrl . '" method="POST" class="delete-form inline-block">';
                    $btn .= csrf_field();
                    $btn .= method_field('DELETE');
                    $btn .= '<button type="submit" class="text-red-500 hover:text-red-700" title="Delete">';
                    $btn .= '<i data-lucide="trash" class="w-5 h-5"></i>';
                    $btn .= '</button>';
                    $btn .= '</form>';
                    $btn .= '</div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $karyawans = Karyawan::all();
        $tokos = Toko::all();
        return view('admin.dataharian.pendapatan.index', compact('karyawans', 'tokos'));
    }

    public function create()
    {
        $karyawans = Karyawan::all();
        return view('admin.dataharian.pendapatan.create', compact('karyawans'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'tanggal' => 'required|date',
                'karyawan_id' => 'required|exists:karyawans,id',
                'jumlah_like' => 'required|integer',
                'jumlah_komentar' => 'required|integer',
                'jumlah_ditonton' => 'required|integer',
                'jumlah_penjualan' => 'required',
                'sesi' => 'required|integer|min:1|max:5',
                'jam_mulai' => 'required|date_format:H:i',
                'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            ]);

            $karyawan = Karyawan::where('id', $request->karyawan_id)->first();
            $request['toko_id'] = $karyawan->toko_id;

            $jumlahPenjualan = str_replace(['Rp.', '.', ','], '', $request->jumlah_penjualan);
            $request->merge(['jumlah_penjualan' => (int) $jumlahPenjualan]);

            PendapatanHarian::create($request->all());

            return redirect()->route('admin.dataharian.pendapatan-harian.index')
                ->with('success', 'Pendapatan Harian created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.dataharian.pendapatan-harian.index')
                ->with('error', 'Pendapatan Harian gagal di buat.' . $e->getMessage());
        }
    }

    public function show(PendapatanHarian $pendapatanHarian)
    {
        return view('admin.dataharian.pendapatan.show', compact('pendapatanHarian'));
    }

    public function edit(PendapatanHarian $pendapatanHarian)
    {
        $karyawans = Karyawan::all();
        return view('admin.dataharian.pendapatan.edit', compact('pendapatanHarian', 'karyawans'));
    }

    public function update(Request $request, PendapatanHarian $pendapatanHarian)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'karyawan_id' => 'required|exists:karyawans,id',
            'jumlah_like' => 'required|integer',
            'jumlah_komentar' => 'required|integer',
            'jumlah_ditonton' => 'required|integer',
            'jumlah_penjualan' => 'required',
            'sesi' => 'required|integer|min:1|max:5',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);
        $karyawan = Karyawan::where('id', $request->karyawan_id)->first();
        $request['toko_id'] = $karyawan->toko_id;

        $jumlahPenjualan = str_replace(['Rp.', '.', ','], '', $request->jumlah_penjualan);
        $request->merge(['jumlah_penjualan' => (int) $jumlahPenjualan]);

        $pendapatanHarian->update($request->all());

        return redirect()->route('admin.dataharian.pendapatan-harian.index')
            ->with('success', 'Pendapatan Harian updated successfully');
    }

    public function destroy(PendapatanHarian $pendapatanHarian)
    {
        $pendapatanHarian->delete();

        return redirect()->route('admin.dataharian.pendapatan-harian.index')
            ->with('success', 'Pendapatan Harian deleted successfully');
    }
}