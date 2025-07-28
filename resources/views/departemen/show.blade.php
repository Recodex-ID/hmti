<x-layouts.main>
    <div class="min-h-screen bg-zinc-50 dark:bg-zinc-900">
        <!-- Hero Section -->
        <section class="bg-primary text-white">
            <div class="container mx-auto px-4 py-16">
                <div class="flex flex-col lg:flex-row items-center gap-8">
                    <!-- Logo Departemen -->
                    @if($department->hasLogo())
                        <div class="flex-shrink-0">
                            <img src="{{ $department->logo_url }}" alt="{{ $department->title }}" class="w-24 lg:w-32">
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
                <!-- Kepala Departemen -->
                @if($department->hasHeadMembers())
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold text-zinc-900 dark:text-zinc-100">Kepala Departemen</h2>
                    </div>
                    <div class="flex justify-center mb-12">
                        @foreach($department->headMembers as $member)
                            <div class="bg-white dark:bg-zinc-800 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden group w-full max-w-sm">
                                <!-- Photo Section -->
                                <div class="relative h-64 bg-gradient-to-br from-blue-500 to-purple-600 overflow-hidden">
                                    @if($member->hasPhoto())
                                        <img src="{{ $member->photo_url }}" alt="{{ $member->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <div class="w-24 h-24 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center">
                                                <svg class="w-12 h-12 text-white" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <!-- Content Section -->
                                <div class="p-6 text-center">
                                    <h3 class="text-lg font-bold text-zinc-900 dark:text-zinc-100 mb-1">{{ $member->name }}</h3>
                                    <p class="text-blue-600 dark:text-blue-400 font-medium text-sm mb-3">{{ $member->formatted_position }}</p>

                                    @if($member->start_year)
                                        <div class="inline-flex items-center px-3 py-1 rounded-full bg-zinc-100 dark:bg-zinc-700 text-xs text-zinc-600 dark:text-zinc-400">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                            </svg>
                                            {{ $member->start_year }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- Staff Departemen -->
                @if($department->hasActiveStaffMembers())
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold text-zinc-900 dark:text-zinc-100">Staff Departemen</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($department->activeStaffMembers as $member)
                            <div class="bg-white dark:bg-zinc-800 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden group">
                                <!-- Photo Section -->
                                <div class="relative h-48 bg-gradient-to-br from-zinc-400 to-zinc-600 overflow-hidden">
                                    @if($member->hasPhoto())
                                        <img src="{{ $member->photo_url }}" alt="{{ $member->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <div class="w-20 h-20 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center">
                                                <svg class="w-10 h-10 text-white" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <!-- Content Section -->
                                <div class="p-5 text-center">
                                    <h3 class="text-base font-bold text-zinc-900 dark:text-zinc-100 mb-1">{{ $member->name }}</h3>
                                    <p class="text-zinc-600 dark:text-zinc-400 text-sm mb-3">{{ $member->formatted_position }}</p>

                                    @if($member->start_year)
                                        <div class="inline-flex items-center px-2.5 py-1 rounded-full bg-zinc-100 dark:bg-zinc-700 text-xs text-zinc-600 dark:text-zinc-400">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                            </svg>
                                            {{ $member->start_year }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
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
            </div>
        </div>
    </div>
</x-layouts.main>
