<header class="glass-effect sticky top-0 z-30 border-b border-slate-200/50">
    <nav class="px-6 py-4">
        <div class="flex items-center justify-between">
            <!-- Mobile Menu Button -->
            <button class="lg:hidden p-2 rounded-lg hover:bg-slate-100 transition-colors duration-200" onclick="toggleSidebar()">
                <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>

            <!-- Search Bar -->
            <div class="hidden md:flex items-center max-w-md mx-4 flex-1">
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" 
                           class="w-full pl-10 pr-4 py-2 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white/80 backdrop-blur-sm transition-all duration-200"
                           placeholder="Cari sesuatu...">
                </div>
            </div>

            <!-- Right Side Icons -->
            <div class="flex items-center space-x-4">

                <!-- User Profile Dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" 
                            class="flex items-center space-x-3 p-2 rounded-lg hover:bg-slate-100 transition-all duration-200">
                        <div class="w-8 h-8 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center">
                            <span class="text-white font-medium text-sm">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </span>
                        </div>
                        <div class="hidden md:block text-left">
                            <p class="text-sm font-medium text-slate-900">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-slate-500">
                                @switch(auth()->user()->role_id)
                                    @case(1) Admin @break
                                    @case(2) Super Admin @break
                                    @case(3) User @break
                                    @default User
                                @endswitch
                            </p>
                        </div>
                        <svg class="w-4 h-4 text-slate-400 hidden md:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <!-- Profile Dropdown -->
                    <div x-show="open" 
                         @click.away="open = false"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg border border-slate-200 py-2 z-50">
                        
                        <div class="px-4 py-3 border-b border-slate-100">
                            <p class="text-sm font-medium text-slate-900">{{ Auth::user()->name }}</p>
                            <p class="text-sm text-slate-500">{{ Auth::user()->email }}</p>
                        </div>

                        <form method="POST" action="{{ route('logout') }}" id="logout-form">
                            @csrf
                            <button type="submit" 
                                    class="w-full flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-150">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>