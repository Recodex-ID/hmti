<x-layouts.main>
    <div class="min-h-screen bg-zinc-50 dark:bg-zinc-900">
        <!-- Hero Section -->
        <section class="bg-primary text-white">
            <div class="container mx-auto px-4 py-16">
                <div class="flex flex-col lg:flex-row items-center gap-8">
                    <!-- Logo Departemen -->
                    @if($department->hasLogo())
                        <div class="flex-shrink-0">
                            <img src="{{ $department->logo_url }}" alt="{{ $department->title }}" class="w-24 lg:w-32 shadow-lg shadow-white">
                        </div>
                    @endif

                    <!-- Informasi Departemen -->
                    <div class="text-center lg:text-left">
                        <h1 class="text-3xl lg:text-4xl font-bold mb-2">{{ $department->title }}</h1>
                        <p class="text-blue-100 text-lg mb-4">{{ ucfirst($department->division) }}</p>
                        @if($department->hasDescription())
                            <p class="text-blue-50 max-w-2xl">{{ $department->description }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <!-- Content Section -->
        <div class="container mx-auto px-4 py-12">
            <div class="space-y-8">
                <!-- Anggota -->
                @if($department->hasActiveMembers())
                    <div class="bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-lg p-6">
                        <h2 class="text-xl font-bold text-zinc-900 dark:text-zinc-100 mb-6">Anggota Departemen</h2>
                        <p class="text-sm text-zinc-500 dark:text-zinc-400 mb-6">{{ $department->activeMembers->count() }} anggota aktif</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($department->activeMembers as $member)
                                <div class="p-4 border border-zinc-200 dark:border-zinc-700 rounded-lg bg-zinc-50 dark:bg-zinc-700 hover:shadow-md transition-shadow">
                                    <div class="flex items-center gap-3 mb-3">
                                        @if($member->hasPhoto())
                                            <img src="{{ $member->photo_url }}" alt="{{ $member->name }}" class="w-12 h-12 rounded-full object-cover">
                                        @else
                                            <div class="w-12 h-12 rounded-full bg-zinc-200 dark:bg-zinc-600 flex items-center justify-center">
                                                <svg class="w-6 h-6 text-zinc-400" viewBox="0 0 20 20">
                                                    <path fill="currentColor" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
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
                @if($department->hasFunctions())
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
                @if($department->hasWorkPrograms())
                    <div class="bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-lg p-6">
                        <h2 class="text-xl font-bold text-zinc-900 dark:text-zinc-100 mb-6">Program Kerja</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($department->workPrograms as $program)
                                <div class="p-4 border border-zinc-200 dark:border-zinc-700 rounded-lg bg-zinc-50 dark:bg-zinc-700">
                                    <h4 class="font-semibold text-zinc-900 dark:text-zinc-100 mb-2">{{ $program->title }}</h4>
                                    @if($program->hasDescription())
                                        <p class="text-sm text-zinc-600 dark:text-zinc-400">{{ $program->description }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Pengurus -->
                @if($department->hasHeadMembers())
                <div class="bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-lg p-6">
                    <h2 class="text-xl font-bold text-zinc-900 dark:text-zinc-100 mb-6">Pengurus Departemen</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($department->headMembers as $member)
                        <div class="p-4 border border-zinc-200 dark:border-zinc-700 rounded-lg bg-zinc-50 dark:bg-zinc-700 hover:shadow-md transition-shadow">
                            <div class="flex items-center gap-3 mb-3">
                                @if($member->hasPhoto())
                                <img src="{{ $member->photo_url }}" alt="{{ $member->name }}" class="w-12 h-12 rounded-full object-cover">
                                @else
                                <div class="w-12 h-12 rounded-full bg-zinc-200 dark:bg-zinc-600 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-zinc-400" viewBox="0 0 20 20">
                                        <path fill="currentColor" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                                    </svg>
                                </div>
                                @endif
                                <div class="flex-1">
                                    <h4 class="font-semibold text-zinc-900 dark:text-zinc-100 text-sm">{{ $member->name }}</h4>
                                    <p class="text-xs text-blue-600 dark:text-blue-400 font-medium">{{ $member->position }}</p>
                                </div>
                            </div>
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
            </div>
        </div>
    </div>
</x-layouts.main>
