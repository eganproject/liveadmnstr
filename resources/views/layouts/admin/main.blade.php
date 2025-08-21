<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin Modern</title>
    {{-- header icon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('logo/cok.png') }}">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }
        /* Styles lainnya... */
        .dataTables_wrapper .dataTables_paginate .paginate_button { padding: 0.3em 0.8em; margin: 0 2px; border-radius: 0.375rem; }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover { color: #fff !important; background: #111827 !important; border-color: #111827 !important; }
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover { background: #e5e7eb !important; border-color: #d1d5db !important; color: #111827 !important; }
        .error { color: #ef4444; font-size: 0.75rem; margin-top: 0.25rem; }
        input.error, select.error, textarea.error { border-color: #ef4444; }
        .swal2-confirm { background-color: #111827 !important; }
        .swal2-cancel { background-color: #e5e7eb !important; color: #1f2937 !important; }
        .select2-container--default .select2-selection--single { border: 1px solid #d1d5db; height: 42px; border-radius: 0.375rem; }
        .select2-container--default .select2-selection--single .select2-selection__rendered { line-height: 40px; padding-left: 0.75rem; color: #374151; }
        .select2-container--default .select2-selection--single .select2-selection__arrow { height: 40px; }
        .select2-container--default.select2-container--open .select2-selection--single { border-color: #111827; box-shadow: 0 0 0 1px #111827; }
        .select2-dropdown { border-color: #d1d5db; border-radius: 0.375rem; }
        .select2-container .error + .select2-container .select2-selection--single { border-color: #ef4444; }
        aside, .main-content-wrapper { transition: all 0.3s ease-in-out; }
                }
        /* Logo switching */
        .sidebar-logo-icon { display: none; }

        @media (min-width: 768px) {
            .sidebar-collapsed aside { width: 5rem; }
            .sidebar-collapsed .sidebar-text, .sidebar-collapsed .sidebar-logo-text, .sidebar-collapsed .sidebar-dropdown-icon { display: none; }
            .sidebar-collapsed #master-data-submenu { display: none !important; }
            .sidebar-collapsed .px-6 { justify-content: center; }
            .sidebar-collapsed .px-6 .ml-4 { margin-left: 0; }

            /* Logo switching for collapsed sidebar */
            .sidebar-collapsed .sidebar-logo-full { display: none; }
            .sidebar-collapsed .sidebar-logo-icon { display: block; }
        }
        /* Custom styles for Flatpickr inputs to ensure consistent height */
        .flatpickr-input {
            height: 42px !important; /* Match select2 height */
            line-height: 40px !important; /* Match select2 line-height */
            padding-top: 0.5rem !important; /* Ensure consistent padding */
            padding-bottom: 0.5rem !important; /* Ensure consistent padding */
        }
    </style>
</head>
<body class="text-sm text-gray-800">
    <!-- Sidebar Backdrop for Mobile -->
    <div id="sidebar-backdrop" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden md:hidden"></div>

    <div id="app-container" class="flex h-screen bg-gray-100">
        
        @include('layouts.admin.sidebar')

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col overflow-hidden min-w-0 main-content-wrapper">
            
            @include('layouts.admin.header')

            <!-- Breadcrumb -->
            <div class="px-6 pt-4 bg-white border-b border-gray-200">
                @yield('breadcrumb')
            </div>

            <!-- Content Area -->
            <main id="main-content" class="flex-1 overflow-x-hidden overflow-y-auto p-6 bg-f8f9fa">
                @yield('content')
            </main>
        </div>
    </div>

    @include('layouts.admin.footer')

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @stack('scripts')
</body>
</html>
