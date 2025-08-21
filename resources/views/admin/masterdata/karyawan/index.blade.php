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
                <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2">Masterdata</span>
            </div>
        </li>
        <li aria-current="page">
            <div class="flex items-center">
                <i data-lucide="chevron-right" class="w-4 h-4 text-gray-400"></i>
                <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2">Karyawan</span>
            </div>
        </li>
    </ol>
</nav>
@endsection

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-sm mb-6">
        <h3 id="form-title" class="text-lg font-semibold text-gray-800 mb-4">Tambah Karyawan</h3>
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Gagal!</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="karyawan-form" action="{{ route('admin.masterdata.karyawan.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-xs font-medium text-gray-600 mb-1">Nama Karyawan</label>
                    <input type="text" id="name" name="name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-black text-sm" placeholder="Masukkan nama karyawan" required value="{{ old('name') }}">
                </div>
                <div>
                    <label for="email" class="block text-xs font-medium text-gray-600 mb-1">Email</label>
                    <input type="email" id="email" name="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-black text-sm" placeholder="Masukkan email" required value="{{ old('email') }}">
                </div>
                <div>
                    <label for="jabatan_id" class="block text-xs font-medium text-gray-600 mb-1">Jabatan</label>
                    <select id="jabatan_id" name="jabatan_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-black text-sm" required>
                        <option value="">Pilih Jabatan</option>
                        @foreach($jabatans as $jabatan)
                            <option value="{{ $jabatan->id }}">{{ $jabatan->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="toko_id" class="block text-xs font-medium text-gray-600 mb-1">Toko</label>
                    <select id="toko_id" name="toko_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-black text-sm" required>
                        <option value="">Pilih Toko</option>
                        @foreach($tokos as $toko)
                            <option value="{{ $toko->id }}">{{ $toko->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mt-6 border-t border-gray-200 pt-4 flex justify-end gap-3">
                <button type="button" id="cancel-edit-btn" class="bg-gray-200 text-gray-800 px-5 py-2.5 rounded-md text-xs font-semibold hover:bg-gray-300" style="display: none;">BATAL</button>
                <button type="submit" class="bg-black text-white px-5 py-2.5 rounded-md text-xs font-semibold hover:bg-gray-800">SIMPAN</button>
            </div>
        </form>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Daftar Karyawan</h3>
        <div class="overflow-x-auto">
            <table id="karyawanTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Karyawan</th>
                        <th>Email</th>
                        <th>Jabatan</th>
                        <th>Toko</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($karyawans as $karyawan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $karyawan->name }}</td>
                        <td>{{ $karyawan->email }}</td>
                        <td>{{ $karyawan->jabatan->name }}</td>
                        <td>{{ $karyawan->toko->name }}</td>
                        <td>
                            <div class="flex items-center space-x-2 justify-center">
                                <button class="p-1 text-blue-600 hover:text-blue-800 edit-btn" 
                                    data-id="{{ $karyawan->id }}" 
                                    data-name="{{ $karyawan->name }}" 
                                    data-email="{{ $karyawan->email }}" 
                                    data-jabatan_id="{{ $karyawan->jabatan_id }}" 
                                    data-toko_id="{{ $karyawan->toko_id }}">
                                    <i data-lucide="file-pen-line" class="w-4 h-4"></i>
                                </button>
                                <form class="delete-form" action="{{ route('admin.masterdata.karyawan.destroy', $karyawan->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1 text-red-600 hover:text-red-800">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#jabatan_id, #toko_id').select2({
            width: '100%',
            theme: "default"
        });

        $('#karyawanTable').DataTable({
            columnDefs: [
                { "width": "5%", "targets": 0 },
                { "width": "15%", "targets": 5 }
            ],
            language: { /* Opsi bahasa DataTables */ },
            drawCallback: function() {
                lucide.createIcons();
            }
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

        const form = $('#karyawan-form');
        const formTitle = $('#form-title');
        const nameInput = $('#name');
        const emailInput = $('#email');
        const jabatanInput = $('#jabatan_id');
        const tokoInput = $('#toko_id');
        const cancelBtn = $('#cancel-edit-btn');
        const originalAction = form.attr('action');

        $('.edit-btn').on('click', function() {
            const id = $(this).data('id');
            const name = $(this).data('name');
            const email = $(this).data('email');
            const jabatan_id = $(this).data('jabatan_id');
            const toko_id = $(this).data('toko_id');
            
            formTitle.text('Edit Karyawan');
            nameInput.val(name);
            emailInput.val(email);
            jabatanInput.val(jabatan_id).trigger('change');
            tokoInput.val(toko_id).trigger('change');
            
            form.attr('action', `/admin/masterdata/karyawan/${id}`);
            if (form.find('input[name="_method"]').length === 0) {
                form.append('<input type="hidden" name="_method" value="PUT">');
            }
            
            cancelBtn.show();
            $('html, body').animate({ scrollTop: 0 }, 'slow');
        });

        cancelBtn.on('click', function() {
            formTitle.text('Tambah Karyawan');
            form.attr('action', originalAction);
            form.find('input[name="_method"]').remove();
            form[0].reset();
            jabatanInput.val(null).trigger('change');
            tokoInput.val(null).trigger('change');
            $(this).hide();
        });

        $('.delete-form').on('submit', function(e) {
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
