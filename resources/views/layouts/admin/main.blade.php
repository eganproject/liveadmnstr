<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel Premium')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.tailwindcss.css">

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f7f8fa;
        }
        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #eef2f9; }
        ::-webkit-scrollbar-thumb { background: #d1d9e6; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #b8c1d1; }
        
        /* Validator error messages */
        label.error { color: #ef4444; font-size: 0.875rem; margin-top: 0.25rem; }
        input.error, select.error, textarea.error { border-color: #ef4444; --tw-ring-color: #ef4444; }
        
        /* DataTables custom styling */
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #4f46e5 !important;
            color: white !important;
            border-color: #4f46e5 !important;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        }
        
        /* MODERN TABLE STYLES */
        #myDataTable_wrapper {
            background-color: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            border: 1px solid #e5e7eb;
        }
        table.dataTable {
            border-collapse: separate;
            border-spacing: 0 1rem; /* Creates space between rows */
        }
        table.dataTable thead th {
            border: none;
            padding: 0 1rem 1rem 1rem;
        }
        table.dataTable tbody tr {
            background-color: #f9fafb; /* bg-slate-50 */
            transition: all 0.2s ease-in-out;
            border-radius: 0.75rem;
        }
        table.dataTable tbody tr:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 20px -5px rgb(0 0 0 / 0.1);
            background-color: white;
        }
        table.dataTable tbody td {
            border: none;
            padding: 1.25rem 1rem;
        }
        table.dataTable tbody td:first-child {
            border-top-left-radius: 0.75rem;
            border-bottom-left-radius: 0.75rem;
        }
        table.dataTable tbody td:last-child {
            border-top-right-radius: 0.75rem;
            border-bottom-right-radius: 0.75rem;
        }
    </style>
</head>
<body class="antialiased text-slate-800">

    <div class="flex h-screen bg-slate-100">
        <!-- Sidebar -->
        @include('layouts.admin.sidebar')

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            @include('layouts.admin.header')

            <!-- Content Area -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-100 p-8">
                @yield('content')
            </main>
        </div>
    </div>

    @include('layouts.admin.footer')
</body>
</html>
