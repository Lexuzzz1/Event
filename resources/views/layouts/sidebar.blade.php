<aside class="fixed inset-y-0 left-0 w-64 bg-gradient-to-b from-slate-900 to-slate-800 text-white z-40 transform transition-transform duration-300 ease-in-out lg:translate-x-0 -translate-x-full" id="sidebar">
    <!-- Header -->
    <div class="flex items-center justify-between p-5 border-b border-white/10">
        <a href="{{ route('dashboard') }}" class="flex items-center space-x-3">
            <div class="w-9 h-9 bg-gradient-to-tr from-purple-600 to-blue-500 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M13 10V3L4 14h7v7l9-11h-7z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <span class="text-lg font-semibold tracking-wide">Dashboard</span>
        </a>
        <button class="lg:hidden text-white hover:text-gray-300" onclick="toggleSidebar()">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M6 18L18 6M6 6l12 12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
    </div>

    <!-- Navigation -->
    <nav class="p-4 space-y-8 overflow-y-auto">
        <!-- Menu Utama -->
        <div>
            <h3 class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-3 px-2">Menu Utama</h3>
            <a href="{{ route('dashboard') }}"
               class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-white transition-all duration-150 {{ request()->routeIs('dashboard') ? 'bg-white/10 border-l-4 border-purple-500' : 'hover:bg-white/5' }}">
                <div class="w-8 h-8 flex items-center justify-center rounded-md {{ request()->routeIs('dashboard') ? 'bg-purple-500' : 'bg-slate-700 hover:bg-slate-600' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"/>
                        <path d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z"/>
                    </svg>
                </div>
                <span class="text-sm font-medium">Dashboard</span>
            </a>
        </div>

        <!-- Menu Berdasarkan Role -->
        @switch(auth()->user()->role_id)
            @case(1)
                <div>
                    <h3 class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-3 px-2">Kelola Event</h3>

                    <a href="{{ route('event.all') }}"
                       class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition-all duration-150 {{ request()->routeIs('event.all') ? 'bg-white/10 border-l-4 border-purple-500' : 'hover:bg-white/5' }}">
                        <div class="w-8 h-8 flex items-center justify-center rounded-md {{ request()->routeIs('event.all') ? 'bg-purple-500' : 'bg-slate-700 hover:bg-slate-600' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118L2.078 10.1c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium">Semua Event</span>
                    </a>

                    <a href="{{ route('event.history') }}"
                       class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition-all duration-150 {{ request()->routeIs('event.history') ? 'bg-white/10 border-l-4 border-purple-500' : 'hover:bg-white/5' }}">
                        <div class="w-8 h-8 flex items-center justify-center rounded-md {{ request()->routeIs('event.history') ? 'bg-purple-500' : 'bg-slate-700 hover:bg-slate-600' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zM9 19V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium">Riwayat</span>
                    </a>
                </div>
                @break

            @case(2)
                <div>
                    <h3 class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-3 px-2">Kelola Sistem</h3>
                    <a href="{{ route('user.index') }}"
                       class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition-all duration-150 {{ request()->routeIs('user.index') ? 'bg-white/10 border-l-4 border-purple-500' : 'hover:bg-white/5' }}">
                        <div class="w-8 h-8 flex items-center justify-center rounded-md {{ request()->routeIs('user.index') ? 'bg-purple-500' : 'bg-slate-700 hover:bg-slate-600' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm6-1v-1a6 6 0 00-9-5.197"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium">Kelola User</span>
                    </a>
                </div>
                @break

            @case(3)
                <div>
                    <h3 class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-3 px-2">Event Saya</h3>
                    <a href="{{ route('event.index') }}"
                       class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition-all duration-150 {{ request()->routeIs('event.index') ? 'bg-white/10 border-l-4 border-purple-500' : 'hover:bg-white/5' }}">
                        <div class="w-8 h-8 flex items-center justify-center rounded-md {{ request()->routeIs('event.index') ? 'bg-purple-500' : 'bg-slate-700 hover:bg-slate-600' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4M6 10h12l-1 5v4a2 2 0 01-2 2H9a2 2 0 01-2-2v-4l-1-5z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium">Event</span>
                    </a>
                </div>
                @break
        @endswitch
    </nav>

    <!-- Footer -->
    <div class="p-4 border-t border-white/10">
        <div class="flex items-center space-x-3 p-2 bg-white/5 rounded-lg">
            <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center">
                <span class="text-white font-medium text-sm">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
            </div>
            <div class="truncate">
                <p class="text-sm font-medium truncate">{{ Auth::user()->name }}</p>
                <p class="text-xs text-slate-400 truncate">
                    @switch(auth()->user()->role_id)
                        @case(1) Admin @break
                        @case(2) Super Admin @break
                        @case(3) User @break
                        @default User
                    @endswitch
                </p>
            </div>
        </div>
    </div>
</aside>

<!-- Overlay Mobile -->
<div class="fixed inset-0 bg-black bg-opacity-50 z-30 lg:hidden hidden" id="sidebar-overlay" onclick="toggleSidebar()"></div>

<script>
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    sidebar.classList.toggle('-translate-x-full');
    overlay.classList.toggle('hidden');
}
</script>
