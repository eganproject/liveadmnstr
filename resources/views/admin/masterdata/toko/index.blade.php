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
                <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2">Toko</span>
            </div>
        </li>
    </ol>
</nav>
@endsection

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-sm mb-6">
        <h3 id="form-title" class="text-lg font-semibold text-gray-800 mb-4">Tambah Toko</h3>
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

        <form id="toko-form" action="{{ route('admin.masterdata.toko.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-xs font-medium text-gray-600 mb-1">Nama Toko</label>
                    <input type="text" id="name" name="name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-black text-sm" placeholder="Masukkan nama toko" required value="{{ old('name') }}">
                </div>
                <div>
                    <label for="description" class="block text-xs font-medium text-gray-600 mb-1">Deskripsi</label>
                    <input type="text" id="description" name="description" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-black text-sm" placeholder="Masukkan deskripsi singkat" value="{{ old('description') }}">
                </div>
            </div>
            <div class="mt-6 border-t border-gray-200 pt-4 flex justify-end gap-3">
                <button type="button" id="cancel-edit-btn" class="bg-gray-200 text-gray-800 px-5 py-2.5 rounded-md text-xs font-semibold hover:bg-gray-300" style="display: none;">BATAL</button>
                <button type="submit" class="bg-black text-white px-5 py-2.5 rounded-md text-xs font-semibold hover:bg-gray-800">SIMPAN</button>
            </div>
        </form>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Daftar Toko</h3>
        <div class="overflow-x-auto">
            <table id="tokoTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Toko</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tokos as $toko)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $toko->name }}</td>
                        <td>{{ $toko->description }}</td>
                        <td>
                            <div class="flex items-center space-x-2 justify-center">
                                <button class="p-1 text-blue-600 hover:text-blue-800 edit-btn" data-id="{{ $toko->id }}" data-name="{{ $toko->name }}" data-description="{{ $toko->description }}">
                                    <i data-lucide="file-pen-line" class="w-4 h-4"></i>
                                </button>
                                <form class="delete-form" action="{{ route('admin.masterdata.toko.destroy', $toko->id) }}" method="POST">
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
        $('#tokoTable').DataTable({
            columnDefs: [
                { "width": "5%", "targets": 0 },
                { "width": "15%", "targets": 3 }
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

        const form = $('#toko-form');
        const formTitle = $('#form-title');
        const nameInput = $('#name');
        const descriptionInput = $('#description');
        const cancelBtn = $('#cancel-edit-btn');
        const originalAction = form.attr('action');

        $('.edit-btn').on('click', function() {
            const id = $(this).data('id');
            const name = $(this).data('name');
            const description = $(this).data('description');
            
            formTitle.text('Edit Toko');
            nameInput.val(name);
            descriptionInput.val(description);
            
            form.attr('action', `/admin/masterdata/toko/${id}`);
            if (form.find('input[name="_method"]').length === 0) {
                form.append('<input type="hidden" name="_method" value="PUT">');
            }
            
            cancelBtn.show();
            $('html, body').animate({ scrollTop: 0 }, 'slow');
        });

        cancelBtn.on('click', function() {
            formTitle.text('Tambah Toko');
            form.attr('action', originalAction);
            form.find('input[name="_method"]').remove();
            form[0].reset();
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

