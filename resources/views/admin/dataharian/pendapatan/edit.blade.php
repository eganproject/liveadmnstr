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
                <a href="{{ route('admin.dataharian.pendapatan-harian.index') }}" class="ms-1 text-sm font-medium text-gray-700 hover:text-black md:ms-2">Pendapatan Harian</a>
            </div>
        </li>
        <li aria-current="page">
            <div class="flex items-center">
                <i data-lucide="chevron-right" class="w-4 h-4 text-gray-400"></i>
                <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2">Edit</span>
            </div>
        </li>
    </ol>
</nav>
@endsection

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-sm mb-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Edit Data Pendapatan Harian</h3>
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

        <form action="{{ route('admin.dataharian.pendapatan-harian.update', $pendapatanHarian->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.dataharian.pendapatan._form')
        </form>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    });
</script>
@endpush