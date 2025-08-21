@extends('layouts.admin.main')

@section('breadcrumb')
    <nav class="flex mb-4" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-black">
                    <i data-lucide="home" class="w-4 h-4 me-2.5"></i>
                    Home
                </a>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <i data-lucide="chevron-right" class="w-4 h-4 text-gray-400"></i>
                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2">Dashboard</span>
                </div>
            </li>
        </ol>
    </nav>
@endsection

@section('content')
    <!-- Section: DataTables -->
    <div id="users" class="bg-white p-6 rounded-lg shadow-sm mb-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-4">
            <h3 class="text-lg font-semibold text-gray-800">Daftar Pengguna</h3>
            <button class="bg-black text-white px-4 py-2 rounded-md text-xs font-semibold hover:bg-gray-800 transition-colors flex items-center w-full sm:w-auto justify-center">
                <i data-lucide="plus" class="w-4 h-4 mr-1"></i>TAMBAH USER
            </button>
        </div>
        <div class="overflow-x-auto">
            <table id="usersTable" class="display" style="width:100%">
                <!-- Konten tabel akan diinisialisasi oleh DataTables -->
            </table>
        </div>
    </div>

    <!-- Section: Form with Validation -->
    <div id="forms" class="bg-white p-6 rounded-lg shadow-sm mb-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Form Input dengan Validasi</h3>
        <form id="userForm">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-xs font-medium text-gray-600 mb-1">Nama Lengkap</label>
                    <input type="text" id="name" name="name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-black text-sm" placeholder="Masukkan nama lengkap">
                </div>
                <div>
                    <label for="email" class="block text-xs font-medium text-gray-600 mb-1">Alamat Email</label>
                    <input type="email" id="email" name="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-black text-sm" placeholder="contoh@email.com">
                </div>
                <div>
                    <label for="role" class="block text-xs font-medium text-gray-600 mb-1">Role</label>
                    <select id="role" name="role" class="w-full">
                        <option></option>
                        <option value="admin">Admin</option>
                        <option value="editor">Editor</option>
                        <option value="viewer">Viewer</option>
                    </select>
                </div>
            </div>
            <div class="mt-6 border-t border-gray-200 pt-4 flex justify-end">
                <button type="submit" class="bg-black text-white px-5 py-2.5 rounded-md text-xs font-semibold hover:bg-gray-800">SIMPAN DATA</button>
            </div>
        </form>
    </div>

    <!-- Section: Dynamic Form -->
    <div id="dynamic-forms" class="bg-white p-6 rounded-lg shadow-sm">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Form Input Dinamis</h3>
        <form id="dynamicForm">
            <div id="skills-container" class="space-y-4">
                <label class="block text-xs font-medium text-gray-600">Keterampilan</label>
            </div>
            <div class="mt-4">
                 <button type="button" id="add-skill-btn" class="bg-gray-200 text-gray-800 px-4 py-2 rounded-md text-xs font-semibold hover:bg-gray-300 flex items-center">
                    <i data-lucide="plus" class="w-4 h-4 mr-1"></i>TAMBAH
                </button>
            </div>
            <div class="mt-6 border-t border-gray-200 pt-4 flex justify-end">
                <button type="submit" class="bg-black text-white px-5 py-2.5 rounded-md text-xs font-semibold hover:bg-gray-800">SIMPAN KETERAMPILAN</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // --- PAGE-SPECIFIC SCRIPTS ---

        const dummyData = [
            ["John Doe", "john.doe@example.com", "Admin", "<span class='bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full'>Aktif</span>"],
            ["Jane Smith", "jane.smith@example.com", "Editor", "<span class='bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full'>Aktif</span>"],
            ["Mike Johnson", "mike.j@example.com", "Viewer", "<span class='bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full'>Nonaktif</span>"]
        ];
        $('#usersTable').DataTable({
            data: dummyData,
            columns: [
                { title: "Nama" }, { title: "Email" }, { title: "Role" }, { title: "Status" },
                {
                    title: "Aksi",
                    render: function() {
                        return `<div class="flex items-center space-x-2 justify-center">
                                    <button class="p-1 text-blue-600 hover:text-blue-800"><i data-lucide="file-pen-line" class="w-4 h-4"></i></button>
                                    <button class="p-1 text-red-600 hover:text-red-800 delete-btn"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                                </div>`;
                    },
                    orderable: false,
                    className: "text-center"
                }
            ],
            drawCallback: function() {
                lucide.createIcons();
            },
            language: { /* Opsi bahasa DataTables */ }
        });
        
        $('#role').select2({
            placeholder: "Pilih Role",
            allowClear: true,
            width: '100%'
        });

        $('#usersTable').on('click', '.delete-btn', function() { 
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
                    var table = $('#usersTable').DataTable();
                    table.row($(this).parents('tr')).remove().draw();
                    Swal.fire('Terhapus!', 'Data pengguna berhasil dihapus.', 'success');
                }
            });
        });
        
        $("#userForm").validate({
            rules: { name: { required: true }, email: { required: true, email: true }, role: { required: true } },
            messages: {
                name: "Nama lengkap tidak boleh kosong",
                email: { required: "Email tidak boleh kosong", email: "Format email tidak valid" },
                role: "Silakan pilih role"
            },
            errorElement: "div",
            errorPlacement: function(error, element) {
                error.addClass("error");
                if (element.hasClass('select2-hidden-accessible')) {
                    error.insertAfter(element.next('.select2-container'));
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                Swal.fire('Berhasil!', 'Data berhasil disimpan.', 'success');
                form.reset();
                $('#role').val(null).trigger('change');
            }
        });

        $("#dynamicForm").validate({
            errorElement: "div",
            errorPlacement: function(error, element) {
                error.addClass("error");
                error.insertAfter(element);
            },
            submitHandler: function(form) {
                Swal.fire('Berhasil!', 'Keterampilan berhasil disimpan.', 'success');
                $('#skills-container').find('.skill-row').remove();
                $('#add-skill-btn').click();
                form.reset();
            }
        });

        let skillIndex = 0;
        $('#add-skill-btn').on('click', function() {
            skillIndex++;
            const newSkillFieldHTML = `
                <div class="flex items-center space-x-2 skill-row">
                    <input type="text" name="skill_${skillIndex}" id="skill_${skillIndex}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-black text-sm" placeholder="Contoh: Javascript">
                    <button type="button" class="remove-skill-btn text-red-500 hover:text-red-700 p-2 rounded-md">
                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                    </button>
                </div>`;
            $('#skills-container').append(newSkillFieldHTML);
            lucide.createIcons();

            $(`#skill_${skillIndex}`).rules('add', {
                required: true,
                messages: {
                    required: "Keterampilan tidak boleh kosong"
                }
            });
        });

        $('#skills-container').on('click', '.remove-skill-btn', function() {
            $(this).closest('.skill-row').remove();
        });
        
        $('#add-skill-btn').click();
    });
</script>
@endpush
