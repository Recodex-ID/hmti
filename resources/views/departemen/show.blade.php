<x-layouts.main>
    <div class="min-h-screen bg-zinc-50 dark:bg-zinc-900">
        <!-- Hero Section -->
        <section class="bg-gradient-to-br from-blue-600 to-blue-800 dark:from-blue-800 dark:to-blue-900 text-white">
            <div class="container mx-auto px-4 py-16">
                <div class="flex flex-col lg:flex-row items-center gap-8">
                    <!-- Logo Departemen -->
                    @if($department->logo)
                        <div class="flex-shrink-0">
                            <img src="{{ $department->logo_url }}" alt="{{ $department->title }}" class="w-24 lg:w-32">
                        </div>
                    @endif

                    <!-- Informasi Departemen -->
                    <div class="text-center lg:text-left">
                        <h1 class="text-3xl lg:text-4xl font-bold mb-2">{{ $department->title }}</h1>
                        <p class="text-blue-100 text-lg mb-4">{{ ucfirst($department->division) }}</p>
                        @if($department->description)
                            <p class="text-blue-50 max-w-2xl">{{ $department->description }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <!-- Content Section -->
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Anggota -->
                    @if($department->activeMembers->count() > 0)
                        <div class="bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-lg p-6">
                            <h2 class="text-xl font-bold text-zinc-900 dark:text-zinc-100 mb-6">Anggota Departemen</h2>
                            <p class="text-sm text-zinc-500 dark:text-zinc-400 mb-6">{{ $department->activeMembers->count() }} anggota aktif</p>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($department->activeMembers as $member)
                                    <div class="p-4 border border-zinc-200 dark:border-zinc-700 rounded-lg bg-zinc-50 dark:bg-zinc-700 hover:shadow-md transition-shadow">
                                        <div class="flex items-center gap-3 mb-3">
                                            @if($member->photo)
                                                <img src="{{ Storage::url($member->photo) }}" alt="{{ $member->name }}" class="w-12 h-12 rounded-full object-cover">
                                            @else
                                                <div class="w-12 h-12 rounded-full bg-zinc-200 dark:bg-zinc-600 flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-zinc-400" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                                    </svg>
                                                </div>
                                            @endif
                                            <div class="flex-1">
                                                <h4 class="font-semibold text-zinc-900 dark:text-zinc-100 text-sm">{{ $member->name }}</h4>
                                                @if($member->position)
                                                    <p class="text-xs text-blue-600 dark:text-blue-400 font-medium">{{ $member->position }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        @if($member->nim)
                                            <div class="text-xs text-zinc-500 dark:text-zinc-400">
                                                <span class="font-medium">NIM:</span> {{ $member->nim }}
                                            </div>
                                        @endif
                                        @if($member->start_year)
                                            <div class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">
                                                <span class="font-medium">Tahun Masuk:</span> {{ $member->start_year }}
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Fungsi Departemen -->
                    @if($department->departmentFunctions->count() > 0)
                        <div class="bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-lg p-6">
                            <h2 class="text-xl font-bold text-zinc-900 dark:text-zinc-100 mb-6">Fungsi Departemen</h2>
                            <div class="space-y-4">
                                @foreach($department->departmentFunctions as $function)
                                    <div class="flex items-start gap-3">
                                        <div class="w-2 h-2 rounded-full bg-blue-500 mt-2 flex-shrink-0"></div>
                                        <p class="text-zinc-700 dark:text-zinc-300">{{ $function->title }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Program Kerja -->
                    @if($department->workPrograms->count() > 0)
                        <div class="bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-lg p-6">
                            <h2 class="text-xl font-bold text-zinc-900 dark:text-zinc-100 mb-6">Program Kerja</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach($department->workPrograms as $program)
                                    <div class="p-4 border border-zinc-200 dark:border-zinc-700 rounded-lg bg-zinc-50 dark:bg-zinc-700">
                                        <h4 class="font-semibold text-zinc-900 dark:text-zinc-100 mb-2">{{ $program->title }}</h4>
                                        @if($program->description)
                                            <p class="text-sm text-zinc-600 dark:text-zinc-400">{{ $program->description }}</p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Pengurus -->
                    @if($department->headMembers->count() > 0)
                        <div class="bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-lg p-6">
                            <h3 class="text-lg font-bold text-zinc-900 dark:text-zinc-100 mb-4">Pengurus</h3>
                            <div class="space-y-4">
                                @foreach($department->headMembers as $member)
                                    <div class="flex items-center gap-3">
                                        @if($member->photo)
                                            <img src="{{ Storage::url($member->photo) }}" alt="{{ $member->name }}" class="w-10 h-10 rounded-full object-cover">
                                        @else
                                            <div class="w-10 h-10 rounded-full bg-zinc-200 dark:bg-zinc-700 flex items-center justify-center">
                                                <svg class="w-6 h-6 text-zinc-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                        @endif
                                        <div>
                                            <p class="font-medium text-zinc-900 dark:text-zinc-100">{{ $member->name }}</p>
                                            <p class="text-sm text-zinc-500 dark:text-zinc-400">{{ $member->position }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif


                    <!-- Contact Info -->
                    <div class="bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-lg p-6">
                        <h3 class="text-lg font-bold text-zinc-900 dark:text-zinc-100 mb-4">Kontak</h3>
                        <div class="space-y-3 text-sm">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <span class="text-zinc-600 dark:text-zinc-400">{{ strtolower(str_replace(' ', '', $department->title)) }}@hmti.ac.id</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span class="text-zinc-600 dark:text-zinc-400">Gedung HMTI, Telkom University</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.main>
