<header class="flex justify-between items-center p-4 bg-white border-b border-slate-200 shadow-sm">
    <div class="flex items-center">
        <button id="sidebar-toggle" class="md:hidden text-slate-500 hover:text-slate-700 focus:outline-none"><svg
                class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg></button>
        <div class="relative ml-4 hidden md:block"><span class="absolute inset-y-0 left-0 flex items-center pl-3"><svg
                    class="w-5 h-5 text-slate-400" viewBox="0 0 24 24" fill="none">
                    <path
                        d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg></span><input type="text"
                class="w-full py-2 pl-10 pr-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-slate-50 transition"
                placeholder="Cari..."></div>
    </div>
    <div class="flex items-center space-x-5">
        <button class="text-slate-500 hover:text-indigo-600 transition-colors"><svg class="w-6 h-6" fill="none"
                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                </path>
            </svg></button>
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open" class="flex items-center space-x-2"><img
                    class="h-10 w-10 rounded-full object-cover border-2 border-transparent hover:border-indigo-500 transition"
                    src="https://placehold.co/100x100/E2E8F0/475569?text=A" alt="Avatar Pengguna"><span
                    class="hidden lg:inline font-semibold">Admin User</span></button>
            <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95"
                class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg py-1 z-10 border border-slate-200"
                style="display: none;"><a href="#"
                    class="block px-4 py-2 text-sm text-slate-700 hover:bg-indigo-50 hover:text-indigo-600">Profil</a><a
                    href="#"
                    class="block px-4 py-2 text-sm text-slate-700 hover:bg-indigo-50 hover:text-indigo-600">Pengaturan</a>
                <div class="border-t border-slate-200 my-1"></div><a href="{{ route('logout') }}"
                    class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Keluar</a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</header>
