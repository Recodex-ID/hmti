<header class="sticky top-0 z-50 px-4 sm:px-6 lg:px-8 bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700 min-h-26 flex items-center">
    <!-- Mobile sidebar toggle -->
    <button class="xl:hidden p-2 text-zinc-600 dark:text-zinc-300 hover:text-zinc-800 dark:hover:text-zinc-100">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
    </button>

    <!-- Logo -->
    <a href="#" class="flex items-center">
        <img class="sm:ms-4 w-auto h-20" src="{{ asset('images/logo_hmti.jpg') }}" alt="HMTI Logo">
    </a>

    <div class="flex-1"></div>

    <!-- Desktop Navigation -->
    <nav class="-mb-px max-xl:hidden">
        <div class="flex space-x-8">
            <div class="relative group">
                <button class="flex items-center px-3 py-2 text-sm font-medium text-zinc-700 dark:text-zinc-200 hover:text-zinc-900 dark:hover:text-zinc-50">
                    Profil
                    <svg class="ml-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
                <div class="absolute left-0 mt-2 w-48 bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                    <a href="#" class="block px-4 py-2 text-sm text-zinc-700 dark:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-700">Tentang Kami</a>
                    <a href="#" class="block px-4 py-2 text-sm text-zinc-700 dark:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-700">AD/ART</a>
                    <a href="#" class="block px-4 py-2 text-sm text-zinc-700 dark:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-700">Panduan Logo HMTI</a>
                    <a href="#" class="block px-4 py-2 text-sm text-zinc-700 dark:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-700">Grand Design HMTI 2025</a>
                    <a href="#" class="block px-4 py-2 text-sm text-zinc-700 dark:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-700">HUT HMTI</a>
                    <a href="#" class="block px-4 py-2 text-sm text-zinc-700 dark:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-700">Sejarah HMTI</a>
                </div>
            </div>

            <div class="relative group">
                <button class="flex items-center px-3 py-2 text-sm font-medium text-zinc-700 dark:text-zinc-200 hover:text-zinc-900 dark:hover:text-zinc-50">
                    Departemen & Biro
                    <svg class="ml-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
                <div class="absolute left-0 mt-2 w-64 bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                    <div class="px-4 py-2 text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase">Internal</div>
                    <a href="#" class="block px-4 py-2 text-sm text-zinc-700 dark:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-700">Departemen Human Resource</a>
                    <a href="#" class="block px-4 py-2 text-sm text-zinc-700 dark:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-700">Departemen Kaderisasi</a>
                    <a href="#" class="block px-4 py-2 text-sm text-zinc-700 dark:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-700">Departemen Kemahasiswaan</a>
                    
                    <div class="px-4 py-2 text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase border-t border-zinc-200 dark:border-zinc-700 mt-2">PSTI</div>
                    <a href="#" class="block px-4 py-2 text-sm text-zinc-700 dark:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-700">Departemen Akademik</a>
                    <a href="#" class="block px-4 py-2 text-sm text-zinc-700 dark:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-700">Departemen Generasi Bisnis</a>
                    <a href="#" class="block px-4 py-2 text-sm text-zinc-700 dark:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-700">Departemen Riset & Kompetisi</a>
                    
                    <div class="px-4 py-2 text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase border-t border-zinc-200 dark:border-zinc-700 mt-2">Eksternal</div>
                    <a href="#" class="block px-4 py-2 text-sm text-zinc-700 dark:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-700">Departemen Komunikasi & Informasi</a>
                    <a href="#" class="block px-4 py-2 text-sm text-zinc-700 dark:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-700">Biro Dedikasi Masyarakat</a>
                    <a href="#" class="block px-4 py-2 text-sm text-zinc-700 dark:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-700">Biro Public Relation</a>
                </div>
            </div>

            <div class="relative group">
                <button class="flex items-center px-3 py-2 text-sm font-medium text-zinc-700 dark:text-zinc-200 hover:text-zinc-900 dark:hover:text-zinc-50">
                    Community & Committee
                    <svg class="ml-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
                <div class="absolute left-0 mt-2 w-64 bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                    <div class="px-4 py-2 text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase">Community</div>
                    <a href="#" class="block px-4 py-2 text-sm text-zinc-700 dark:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-700">Incoustic</a>
                    <a href="#" class="block px-4 py-2 text-sm text-zinc-700 dark:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-700">Industrial Competition Community</a>
                    <a href="#" class="block px-4 py-2 text-sm text-zinc-700 dark:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-700">Koma Creative</a>
                    <a href="#" class="block px-4 py-2 text-sm text-zinc-700 dark:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-700">Maroon Army</a>
                    <a href="#" class="block px-4 py-2 text-sm text-zinc-700 dark:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-700">Community Motor Telkom University</a>
                    <a href="#" class="block px-4 py-2 text-sm text-zinc-700 dark:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-700">Community of Tentor</a>
                    <a href="#" class="block px-4 py-2 text-sm text-zinc-700 dark:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-700">Society</a>
                    
                    <div class="px-4 py-2 text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase border-t border-zinc-200 dark:border-zinc-700 mt-2">Committee</div>
                    <a href="#" class="block px-4 py-2 text-sm text-zinc-700 dark:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-700">Invention</a>
                    <a href="#" class="block px-4 py-2 text-sm text-zinc-700 dark:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-700">SEHATI</a>
                    <a href="#" class="block px-4 py-2 text-sm text-zinc-700 dark:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-700">LEGION</a>
                    <a href="#" class="block px-4 py-2 text-sm text-zinc-700 dark:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-700">Increase</a>
                    <a href="#" class="block px-4 py-2 text-sm text-zinc-700 dark:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-700">Inaugurasi</a>
                    <a href="#" class="block px-4 py-2 text-sm text-zinc-700 dark:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-700">ORATIONS</a>
                    <a href="#" class="block px-4 py-2 text-sm text-zinc-700 dark:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-700">INFADE</a>
                </div>
            </div>

            <div class="relative group">
                <button class="flex items-center px-3 py-2 text-sm font-medium text-zinc-700 dark:text-zinc-200 hover:text-zinc-900 dark:hover:text-zinc-50">
                    Partnership
                    <svg class="ml-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
                <div class="absolute left-0 mt-2 w-48 bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                    <a href="#" class="block px-4 py-2 text-sm text-zinc-700 dark:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-700">Benchmark</a>
                    <a href="#" class="block px-4 py-2 text-sm text-zinc-700 dark:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-700">Media Partner</a>
                    <a href="#" class="block px-4 py-2 text-sm text-zinc-700 dark:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-700">MC & Moderator</a>
                </div>
            </div>

            <div class="relative group">
                <button class="flex items-center px-3 py-2 text-sm font-medium text-zinc-700 dark:text-zinc-200 hover:text-zinc-900 dark:hover:text-zinc-50">
                    MPM
                    <svg class="ml-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
                <div class="absolute left-0 mt-2 w-48 bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                    <a href="#" class="block px-4 py-2 text-sm text-zinc-700 dark:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-700">Komisi A</a>
                    <a href="#" class="block px-4 py-2 text-sm text-zinc-700 dark:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-700">Komisi B</a>
                    <a href="#" class="block px-4 py-2 text-sm text-zinc-700 dark:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-700">Komisi C</a>
                    <a href="#" class="block px-4 py-2 text-sm text-zinc-700 dark:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-700">BURT</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="flex-1"></div>

    <!-- Theme toggle -->
    <div class="hidden mx-2 sm:mx-4 md:flex">
        <button class="p-2 text-zinc-600 dark:text-zinc-300 hover:text-zinc-800 dark:hover:text-zinc-100">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"/>
            </svg>
        </button>
    </div>

    <div class="my-2 mx-2 sm:mx-4 hidden sm:block border-l border-zinc-200 dark:border-zinc-700 h-6"></div>

    <!-- User section -->
    @auth
        <div class="relative group">
            <button class="flex items-center space-x-3 p-2 border border-zinc-200 dark:border-zinc-700 rounded-lg hover:bg-zinc-100 dark:hover:bg-zinc-800">
                <img class="w-8 h-8 rounded-full" src="{{ Storage::url(auth()->user()->photo) }}" alt="{{ auth()->user()->name }}">
                <div class="hidden md:block text-left">
                    <div class="text-sm font-medium text-zinc-900 dark:text-zinc-100">{{ auth()->user()->name }}</div>
                    <div class="text-xs text-zinc-500 dark:text-zinc-400">{{ Str::title(str_replace('-', ' ', auth()->user()->roles->first()?->name)) }}</div>
                </div>
                <svg class="w-4 h-4 text-zinc-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            </button>
            
            <div class="absolute right-0 mt-2 w-48 bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                <div class="px-4 py-3 border-b border-zinc-200 dark:border-zinc-700">
                    <div class="text-sm font-medium text-zinc-900 dark:text-zinc-100">{{ auth()->user()->name }}</div>
                    <div class="text-xs text-zinc-500 dark:text-zinc-400">{{ auth()->user()->email }}</div>
                </div>
                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-zinc-700 dark:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-700">Dashboard</a>
                <a href="#" class="block px-4 py-2 text-sm text-zinc-700 dark:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-700">Settings</a>
                <div class="border-t border-zinc-200 dark:border-zinc-700">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-zinc-700 dark:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-700">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @else
        <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md transition">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
            </svg>
            Login
        </a>
    @endauth
</header>
