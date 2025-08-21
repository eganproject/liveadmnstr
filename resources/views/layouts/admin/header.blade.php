<!-- Header -->
<header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-6 flex-shrink-0">
    <div class="flex items-center">
        <button id="sidebar-toggle" class="hidden md:block mr-4 text-gray-600 hover:text-gray-800">
            <i data-lucide="panel-left-close" class="w-6 h-6"></i>
        </button>
        <button id="menu-button" class="md:hidden mr-4 text-gray-600 hover:text-gray-800">
            <i data-lucide="menu" class="w-6 h-6"></i>
        </button>
    </div>
    <div class="flex items-center">
        <!-- User Dropdown -->
        <div class="relative">
            <button id="user-menu-button" class="flex items-center focus:outline-none">
                <img src="https://placehold.co/40x40/E2E8F0/4A5568?text=A" alt="Avatar" class="h-8 w-8 rounded-full object-cover">
                <span class="ml-2 hidden md:inline">{{ Auth::user()->name ?? 'Admin User' }}</span>
                 <i data-lucide="chevron-down" class="w-4 h-4 ml-1 hidden md:inline"></i>
            </button>
            <!-- Dropdown Menu -->
            <div id="user-menu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-20">
                <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    <i data-lucide="user" class="w-4 h-4 mr-2"></i>
                    Profil
                </a>
                <a href="{{ route('logout') }}" 
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                   class="flex items-center w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    <i data-lucide="log-out" class="w-4 h-4 mr-2"></i>
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</header>
