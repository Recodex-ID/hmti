<x-layouts.main>
    <div class="min-h-screen bg-zinc-50 dark:bg-zinc-900">
        <!-- Hero Section -->
        <section class="bg-primary text-white">
            <div class="container mx-auto px-4 py-16">
                <div class="text-center">
                    <h1 class="text-4xl lg:text-5xl font-bold mb-6">Tentang Kami</h1>
                    <p class="text-lg max-w-3xl mx-auto">
                        Mengenal lebih dekat Himpunan Mahasiswa Teknik Industri (HMTI) Telkom University
                    </p>
                </div>
            </div>
        </section>

        <!-- Content Section -->
        <div class="container mx-auto px-4 py-12">
            <div class="space-y-12">
                <!-- Definisi -->
                @if($about && $about->definition)
                <div class="bg-white dark:bg-zinc-800 rounded-xl p-8 shadow-sm border border-zinc-200 dark:border-zinc-700">
                    <h2 class="text-2xl font-bold text-zinc-900 dark:text-white mb-4">Definisi HMTI</h2>
                    <p class="text-zinc-600 dark:text-zinc-300 leading-relaxed">{{ $about->definition }}</p>
                </div>
                @endif

                <!-- Kedudukan dan Peran -->
                @if($about && $about->position_role)
                <div class="bg-white dark:bg-zinc-800 rounded-xl p-8 shadow-sm border border-zinc-200 dark:border-zinc-700">
                    <h2 class="text-2xl font-bold text-zinc-900 dark:text-white mb-4">Kedudukan dan Peran</h2>
                    <p class="text-zinc-600 dark:text-zinc-300 leading-relaxed">{{ $about->position_role }}</p>
                </div>
                @endif

                <!-- Visi Misi -->
                @if($about && ($about->vision || $about->hasMissions()))
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Visi -->
                    @if($about->vision)
                    <div class="bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-lg p-8">
                        <h2 class="text-2xl font-bold text-zinc-900 dark:text-zinc-100 mb-6 text-center">Visi</h2>
                        <p class="text-zinc-700 dark:text-zinc-300 text-center leading-relaxed">
                            "{{ $about->vision }}"
                        </p>
                    </div>
                    @endif

                    <!-- Misi -->
                    @if($about->hasMissions())
                    <div class="bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-lg p-8">
                        <h2 class="text-2xl font-bold text-zinc-900 dark:text-zinc-100 mb-6 text-center">Misi</h2>
                        <ul class="space-y-3 text-zinc-700 dark:text-zinc-300">
                            @foreach($about->mission as $missionItem)
                            <li class="flex items-start gap-3">
                                <div class="w-2 h-2 rounded-full bg-primary mt-2 flex-shrink-0"></div>
                                <span>{{ $missionItem }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
                @endif

                <!-- Struktur Organisasi -->
                @if($about && $about->hasStructuralImage())
                <div class="bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-lg p-8">
                    <h2 class="text-2xl font-bold text-zinc-900 dark:text-zinc-100 mb-6">Struktur Organisasi</h2>
                    <div class="flex justify-center">
                        <img src="{{ $about->structural_url }}"
                             alt="Struktur Organisasi HMTI"
                             class="max-w-full h-auto rounded-lg shadow-md border border-zinc-200 dark:border-zinc-600">
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.main>
