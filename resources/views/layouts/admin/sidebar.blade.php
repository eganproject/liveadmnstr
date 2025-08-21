<!-- Sidebar -->
<aside class="w-64 flex-shrink-0 bg-white border-r border-gray-200 flex-col flex fixed inset-y-0 left-0 z-50 transform -translate-x-full md:relative md:translate-x-0">
    <div class="h-16 flex items-center justify-center border-b border-gray-200 px-4 flex-shrink-0">
        <i data-lucide="shield-check" class="w-8 h-8 text-black"></i>
        <h1 class="text-xl font-bold text-gray-800 ml-2 sidebar-logo-text">AdminPanel</h1>
    </div>
    <nav class="flex-1 overflow-y-auto pt-4">
        <a href="#dashboard" class="flex items-center px-6 py-3 text-gray-700 bg-gray-100 font-semibold">
            <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
            <span class="ml-4 sidebar-text">Dashboard</span>
        </a>
        <a href="#users" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-50">
            <i data-lucide="users" class="w-5 h-5"></i>
            <span class="ml-4 sidebar-text">Manajemen User</span>
        </a>
        <!-- Master Data Dropdown -->
        <div>
            <a href="#" id="master-data-toggle" class="flex items-center justify-between px-6 py-3 text-gray-600 hover:bg-gray-50">
                <div class="flex items-center">
                    <i data-lucide="database" class="w-5 h-5"></i>
                    <span class="ml-4 sidebar-text">Master Data</span>
                </div>
                <i data-lucide="chevron-down" class="w-4 h-4 sidebar-dropdown-icon transition-transform"></i>
            </a>
            <div id="master-data-submenu" class="hidden bg-gray-50">
                <a href="#" class="flex items-center py-2 pl-12 pr-6 text-gray-600 hover:bg-gray-100">
                   <span class="sidebar-text">Toko</span>
                </a>
                <a href="#" class="flex items-center py-2 pl-12 pr-6 text-gray-600 hover:bg-gray-100">
                   <span class="sidebar-text">Karyawan</span>
                </a>
                {{-- <a href="#" class="flex items-center py-2 pl-12 pr-6 text-gray-600 hover:bg-gray-100">
                   <span class="sidebar-text">Toko</span>
                </a> --}}
            </div>
        </div>
        <a href="#forms" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-50">
            <i data-lucide="file-text" class="w-5 h-5"></i>
            <span class="ml-4 sidebar-text">Contoh Form</span>
        </a>
         <a href="#dynamic-forms" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-50">
            <i data-lucide="file-plus-2" class="w-5 h-5"></i>
            <span class="ml-4 sidebar-text">Form Dinamis</span>
        </a>
    </nav>
</aside>
