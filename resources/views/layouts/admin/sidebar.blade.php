<!-- Sidebar -->
<aside
    class="w-64 flex-shrink-0 bg-white border-r border-gray-200 flex-col flex fixed inset-y-0 left-0 z-50 transform -translate-x-full md:relative md:translate-x-0">
    <div class="h-16 flex items-center justify-center border-b border-gray-200 px-4 flex-shrink-0">
        <i data-lucide="shield-check" class="w-8 h-8 text-black"></i>
        <h1 class="text-xl font-bold text-gray-800 ml-2 sidebar-logo-text">AdminPanel</h1>
    </div>
    <nav class="flex-1 overflow-y-auto pt-4">
        <a href="/admin" class="flex items-center px-6 py-3 text-gray-700 {{ Request::is('admin') ? 'bg-gray-100 font-semibold' : '' }}">
            <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
            <span class="ml-4 sidebar-text">Dashboard</span>
        </a>
        <!-- Master Data Dropdown -->
        <div>
            <a href="#" id="master-data-toggle"
                class="flex items-center justify-between px-6 py-3 text-gray-600 hover:bg-gray-50 {{ Request::is('admin/masterdata*') ? '' : '' }}">
                <div class="flex items-center">
                    <i data-lucide="database" class="w-5 h-5"></i>
                    <span class="ml-4 sidebar-text">Master Data</span>
                </div>
                <i data-lucide="chevron-down" class="w-4 h-4 sidebar-dropdown-icon transition-transform {{ Request::is('admin/masterdata*') ? 'rotate-180' : '' }}"></i>
            </a>
            <div id="master-data-submenu" class="{{ Request::is('admin/masterdata*') ? '' : 'hidden' }}">
                <a href="{{ route('admin.masterdata.jabatan.index') }}" class="flex items-center py-2 pl-12 pr-6 text-gray-600 hover:bg-gray-100 {{ Request::is('admin/masterdata/jabatan*') ? 'bg-gray-100 font-semibold' : '' }}">
                    <span class="sidebar-text">Jabatan</span>
                </a>
                <a href="{{ route('admin.masterdata.toko.index') }}" class="flex items-center py-2 pl-12 pr-6 text-gray-600 hover:bg-gray-100 {{ Request::is('admin/masterdata/toko*') ? 'bg-gray-100 font-semibold' : '' }}">
                    <span class="sidebar-text">Toko</span>
                </a>
                <a href="/admin/masterdata/karyawan" class="flex items-center py-2 pl-12 pr-6 text-gray-600 hover:bg-gray-100 {{ Request::is('admin/masterdata/karyawan*') ? 'bg-gray-100 font-semibold' : '' }}">
                    <span class="sidebar-text">Karyawan</span>
                </a>
            </div>
        </div>
        <a href="{{ route('admin.dataharian.pendapatan-harian.index') }}" class="flex items-center px-6 py-3 text-gray-700 {{ Request::is('admin/dataharian*') ? 'bg-gray-100 font-semibold' : '' }}">
            <i data-lucide="file-text" class="w-5 h-5"></i>
            <span class="ml-4 sidebar-text">Data Harian</span>
        </a>

        <!-- Laporan Dropdown -->
        <div>
            <a href="#" id="laporan-toggle"
                class="flex items-center justify-between px-6 py-3 text-gray-600 hover:bg-gray-50 {{ Request::is('admin/reports*') ? '' : '' }}">
                <div class="flex items-center">
                    <i data-lucide="bar-chart-2" class="w-5 h-5"></i>
                    <span class="ml-4 sidebar-text">Laporan</span>
                </div>
                <i data-lucide="chevron-down" class="w-4 h-4 sidebar-dropdown-icon transition-transform {{ Request::is('admin/reports*') ? 'rotate-180' : '' }}"></i>
            </a>
            <div id="laporan-submenu" class="{{ Request::is('admin/reports*') ? '' : 'hidden' }}">
                <a href="{{ route('admin.reports.pendapatan.index') }}" class="flex items-center py-2 pl-12 pr-6 text-gray-600 hover:bg-gray-100 {{ Request::is('admin/reports/pendapatan*') ? 'bg-gray-100 font-semibold' : '' }}">
                    <span class="sidebar-text">Laporan Pendapatan</span>
                </a>
            </div>
        </div>
       
    </nav>
</aside>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const masterDataToggle = document.getElementById('master-data-toggle');
        const masterDataSubmenu = document.getElementById('master-data-submenu');
        const masterDataIcon = masterDataToggle.querySelector('.sidebar-dropdown-icon');

        masterDataToggle.addEventListener('click', function (e) {
            e.preventDefault();
            masterDataSubmenu.classList.toggle('hidden');
            masterDataIcon.classList.toggle('rotate-180');
        });

        // Add this new part for Laporan dropdown
        const laporanToggle = document.getElementById('laporan-toggle');
        const laporanSubmenu = document.getElementById('laporan-submenu');
        const laporanIcon = laporanToggle.querySelector('.sidebar-dropdown-icon');

        laporanToggle.addEventListener('click', function (e) {
            e.preventDefault();
            laporanSubmenu.classList.toggle('hidden');
            laporanIcon.classList.toggle('rotate-180');
        });
    });
</script>
@endpush