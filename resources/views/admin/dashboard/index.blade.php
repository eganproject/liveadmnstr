@extends('layouts.admin.main')

@section('title', 'Dashboard - Admin Panel')

@section('content')
<nav class="flex mb-6" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-3">
        <li class="inline-flex items-center">
            <a href="#" class="inline-flex items-center text-sm font-medium text-slate-700 hover:text-indigo-600">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                Home
            </a>
        </li>
        <li>
            <div class="flex items-center">
                <svg class="w-6 h-6 text-slate-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                <span class="ml-1 text-sm font-bold text-slate-800 md:ml-2">Dashboard</span>
            </div>
        </li>
    </ol>
</nav>
<h2 class="text-3xl font-extrabold text-slate-900 mb-8">Manajemen Pengguna</h2>

<!-- MODERN TABLE CONTAINER -->
<div class="overflow-x-auto mb-8">
    <table id="myDataTable" class="w-full">
        <thead>
            <tr>
                <th class="p-4 text-left text-sm font-semibold text-slate-500 tracking-wider">Pengguna</th>
                <th class="p-4 text-left text-sm font-semibold text-slate-500 tracking-wider">Posisi</th>
                <th class="p-4 text-left text-sm font-semibold text-slate-500 tracking-wider">Status</th>
                <th class="p-4 text-left text-sm font-semibold text-slate-500 tracking-wider">Tanggal Mulai</th>
                <th class="p-4 text-center text-sm font-semibold text-slate-500 tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<!-- FORM SECTION -->
<div class="bg-white p-8 rounded-2xl shadow-lg border border-slate-200">
    <h3 class="text-2xl font-bold text-slate-900 mb-6">Formulir Pendaftaran</h3>
    <form id="registrationForm" novalidate>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div><label for="nama" class="block mb-2 text-sm font-medium text-slate-700">Nama Lengkap</label><input type="text" id="nama" name="nama" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3 transition" placeholder="John Doe" required></div>
            <div><label for="email" class="block mb-2 text-sm font-medium text-slate-700">Alamat Email</label><input type="email" id="email" name="email" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3 transition" placeholder="john.doe@example.com" required></div>
            <div><label for="password" class="block mb-2 text-sm font-medium text-slate-700">Kata Sandi</label><input type="password" id="password" name="password" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3 transition" required minlength="8"></div>
            <div><label for="confirm_password" class="block mb-2 text-sm font-medium text-slate-700">Konfirmasi Kata Sandi</label><input type="password" id="confirm_password" name="confirm_password" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3 transition" required></div>
        </div>
        <div class="mt-8 border-t border-slate-200 pt-6">
            <h4 class="text-lg font-semibold text-slate-800 mb-4">Hobi</h4>
            <div id="hobbies-container" class="space-y-4"></div>
            <button type="button" id="add-hobby-btn" class="mt-4 flex items-center text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition"><svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>Tambah Hobi</button>
        </div>
        <div class="mt-8"><button type="submit" class="text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-semibold rounded-lg text-sm w-full sm:w-auto px-6 py-3 text-center transition duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">Kirim Pendaftaran</button></div>
    </form>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {

    // --- Sidebar Toggle for Mobile ---
    $('#sidebar-toggle').on('click', function() { $('#sidebar').toggleClass('-translate-x-full'); });

    // --- Sample Data with more details ---
    const tableData = [
        { "name": "Airi Satou", "email": "airi.satou@example.com", "position": "Accountant", "office": "Tokyo", "status": "Active", "startDate": "2008/11/28" },
        { "name": "Angelica Ramos", "email": "angelica.ramos@example.com", "position": "CEO", "office": "London", "status": "Active", "startDate": "2009/10/09" },
        { "name": "Ashton Cox", "email": "ashton.cox@example.com", "position": "Author", "office": "San Francisco", "status": "Pending", "startDate": "2009/01/12" },
        { "name": "Bradley Greer", "email": "bradley.greer@example.com", "position": "Software Engineer", "office": "London", "status": "Active", "startDate": "2012/10/13" },
        { "name": "Brenden Wagner", "email": "brenden.wagner@example.com", "position": "Software Engineer", "office": "San Francisco", "status": "Active", "startDate": "2011/06/07" },
    ];

    // --- DataTable Initialization ---
    const table = $('#myDataTable').DataTable({
        data: tableData,
        columns: [ { data: 'name' }, { data: 'position' }, { data: 'status' }, { data: 'startDate' }, { data: null, defaultContent: '' } ],
        "sDom": '<"flex justify-between items-center mb-6"f<"flex items-center gap-4"l>>rt<"mt-6"ip>',
        "bAutoWidth": false,
        columnDefs: [
            { targets: 0, render: function (data, type, row) { const firstLetter = row.name.charAt(0).toUpperCase(); return `<div class="flex items-center gap-4"><div class="w-11 h-11 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-lg">${firstLetter}</div><div><div class="font-semibold text-slate-900">${row.name}</div><div class="text-sm text-slate-500">${row.email}</div></div></div>`; } },
            { targets: 1, render: function (data, type, row) { return `<div><div class="font-medium text-slate-800">${row.position}</div><div class="text-sm text-slate-500">${row.office}</div></div>`; } },
            { targets: 2, render: function (data, type, row) { const statusClass = row.status === 'Active' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800'; return `<span class="px-3 py-1 text-xs font-semibold rounded-full ${statusClass}">${row.status}</span>`; } },
            { targets: 4, orderable: false, className: 'text-center', render: function(data, type, row) { return `<div class="flex items-center justify-center space-x-2"><button data-tippy-content="Edit Pengguna" class="p-2 rounded-md text-slate-500 hover:bg-indigo-100 hover:text-indigo-600 transition"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.5L15.232 5.232z"></path></svg></button><button data-tippy-content="Hapus Pengguna" class="p-2 rounded-md text-slate-500 hover:bg-red-100 hover:text-red-600 transition delete-btn" data-user-name="${row.name}"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button></div>`; } }
        ],
        language: { "search": "", "searchPlaceholder": "Cari pengguna...", "lengthMenu": "Tampilkan _MENU_", "info": "Menampilkan _START_-_END_ dari _TOTAL_", "paginate": { "next": "→", "previous": "←" } }
    });
    
    // --- SweetAlert2 for Delete Button ---
    $('#myDataTable tbody').on('click', '.delete-btn', function() {
        const userName = $(this).data('user-name');
        Swal.fire({ title: 'Konfirmasi Penghapusan', html: `Anda yakin ingin menghapus pengguna <br><b>${userName}</b>?`, icon: 'warning', showCancelButton: true, confirmButtonText: 'Ya, Hapus', cancelButtonText: 'Batal', customClass: { popup: 'rounded-2xl shadow-xl', confirmButton: 'text-white bg-red-600 hover:bg-red-700 font-semibold py-2.5 px-5 rounded-lg', cancelButton: 'bg-slate-200 hover:bg-slate-300 text-slate-700 font-semibold py-2.5 px-5 rounded-lg ml-3' }, buttonsStyling: false }).then((result) => { if (result.isConfirmed) { Swal.fire({ title: 'Berhasil Dihapus!', text: `Data ${userName} telah dihapus.`, icon: 'success', customClass: { popup: 'rounded-2xl', confirmButton: 'text-white bg-indigo-600 hover:bg-indigo-700 font-semibold py-2.5 px-5 rounded-lg' }, buttonsStyling: false }); } });
    });

    // --- Tippy.js (Tooltip) Initialization ---
    function initTippy() { tippy('[data-tippy-content]', { animation: 'scale-subtle', theme: 'light-border' }); }
    table.on('draw', initTippy);
    initTippy();

    // --- Dynamic Form Logic ---
    let hobbyIndex = 0;
    $('#add-hobby-btn').on('click', function() {
        const hobbyHtml = `<div class="flex items-center space-x-3 hobby-input-group"><input type="text" name="hobbies[${hobbyIndex}]" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3 transition" placeholder="Contoh: Membaca Buku"><button type="button" class="remove-hobby-btn p-2 rounded-md text-slate-500 hover:bg-red-100 hover:text-red-600 transition"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button></div>`;
        $('#hobbies-container').append(hobbyHtml);
        $(`[name="hobbies[${hobbyIndex}]"]`).rules('add', { required: true, messages: { required: "Hobi tidak boleh kosong" } });
        hobbyIndex++;
    });
    $('#hobbies-container').on('click', '.remove-hobby-btn', function() { $(this).closest('.hobby-input-group').remove(); });

    // --- jQuery Validator Initialization ---
    const validator = $('#registrationForm').validate({
        rules: { nama: { required: true, minlength: 3 }, email: { required: true, email: true }, password: { required: true, minlength: 8 }, confirm_password: { required: true, minlength: 8, equalTo: "#password" } },
        messages: { nama: { required: "Nama lengkap wajib diisi", minlength: "Nama lengkap minimal 3 karakter" }, email: { required: "Alamat email wajib diisi", email: "Format email tidak valid" }, password: { required: "Kata sandi wajib diisi", minlength: "Kata sandi minimal 8 karakter" }, confirm_password: { required: "Konfirmasi kata sandi wajib diisi", minlength: "Kata sandi minimal 8 karakter", equalTo: "Kata sandi tidak cocok" } },
        errorPlacement: function(error, element) { if (element.closest('.hobby-input-group').length) { error.insertAfter(element.closest('.hobby-input-group')); } else { error.insertAfter(element); } },
        submitHandler: function(form) { Swal.fire({ title: 'Pendaftaran Berhasil!', text: 'Formulir Anda telah berhasil dikirim.', icon: 'success', customClass: { popup: 'rounded-2xl', confirmButton: 'text-white bg-indigo-600 hover:bg-indigo-700 font-semibold py-2.5 px-5 rounded-lg' }, buttonsStyling: false }); form.reset(); $('#hobbies-container').empty(); hobbyIndex = 0; validator.resetForm(); return false; }
    });
});
</script>
@endpush
