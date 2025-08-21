@extends('layouts.admin.main')

@section('breadcrumb')
<nav class="flex mb-4" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
        <li class="inline-flex items-center">
            <a href="/admin" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-black">
                <i data-lucide="home" class="w-4 h-4 me-2.5"></i>
                Admin
            </a>
        </li>
        <li aria-current="page">
            <div class="flex items-center">
                <i data-lucide="chevron-right" class="w-4 h-4 text-gray-400"></i>
                <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2">Data Harian</span>
            </div>
        </li>
        <li aria-current="page">
            <div class="flex items-center">
                <i data-lucide="chevron-right" class="w-4 h-4 text-gray-400"></i>
                <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2">Pendapatan Harian</span>
            </div>
        </li>
    </ol>
</nav>
@endsection

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-sm">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Daftar Pendapatan Harian</h3>
            <a href="{{ route('admin.dataharian.pendapatan-harian.create') }}" class="bg-black text-white px-5 py-2.5 rounded-md text-xs font-semibold hover:bg-gray-800">Tambah Data</a>
        </div>

        <div class="mb-4">
            <label for="filter_tanggal" class="block text-xs font-medium text-gray-600 mb-1">Filter Tanggal:</label>
            <input type="date" id="filter_tanggal" class="w-auto px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-black text-sm">
        </div>

        <div class="overflow-x-auto">
            <table id="pendapatan-table" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Karyawan</th>
                        <th>Toko</th>
                        <th>Jumlah Like</th>
                        <th>Jumlah Komentar</th>
                        <th>Jumlah Ditonton</th>
                        <th>Jumlah Penjualan</th>
                        <th>Sesi</th>
                        <th>Jam Mulai</th>
                        <th>Jam Selesai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Set default date to today
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        today = yyyy + '-' + mm + '-' + dd;
        $('#filter_tanggal').val(today);

        var pendapatanTable = $('#pendapatan-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route("admin.dataharian.pendapatan-harian.index") }}',
                data: function (d) {
                    d.filter_tanggal = $('#filter_tanggal').val();
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'tanggal', name: 'tanggal' },
                { data: 'karyawan.name', name: 'karyawan.name' },
                { data: 'toko.name', name: 'toko.name' },
                { data: 'jumlah_like', name: 'jumlah_like' },
                { data: 'jumlah_komentar', name: 'jumlah_komentar' },
                { data: 'jumlah_ditonton', name: 'jumlah_ditonton' },
                { data: 'jumlah_penjualan', name: 'jumlah_penjualan' },
                { data: 'sesi', name: 'sesi' },
                { data: 'jam_mulai', name: 'jam_mulai' },
                { data: 'jam_selesai', name: 'jam_selesai' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            order: [[ 1, "desc" ]],
            paging: false,
            // info: false,
            drawCallback: function() {
                lucide.createIcons();
            }
        });

        // Reload DataTable when date filter changes
        $('#filter_tanggal').on('change', function() {
            pendapatanTable.ajax.reload();
        });

        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
        @endif
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}',
                showConfirmButton: true,
                // timer: 2000
            });
        @endif

        $(document).on('submit', '.delete-form', function(e) {
            e.preventDefault();
            var form = this;

            Swal.fire({
                title: 'Anda Yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endpush