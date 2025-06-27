<x-layouts.main title="Beranda | HMTI Telkom University">
    <!-- Hero Section with Carousel -->
    <div x-data="{
            activeSlide: 0,
            slides: [
                @if($heroes->count() > 0)
                    @foreach($heroes as $hero)
                    {
                        image: '{{ $hero->image_url ? $hero->image_url : asset('images/gedung.jpg') }}',
                        title: '{{ $hero->title }}',
                        subtitle: '{{ $hero->subtitle }}'
                    }@if(!$loop->last),@endif
                    @endforeach
                @else
                    {
                        image: '{{ asset('images/gedung.jpg') }}',
                        title: 'Himpunan Mahasiswa Teknik Industri',
                        subtitle: 'Membangun masa depan insinyur industri yang unggul'
                    }
                @endif
            ],
            loop() {
                setInterval(() => {
                    this.activeSlide = (this.activeSlide + 1) % this.slides.length
                }, 5000)
            }
        }"
         x-init="loop()"
         class="relative overflow-hidden bg-zinc-900 h-[70vh]">
        <!-- Slides -->
        <template x-for="(slide, index) in slides" :key="index">
            <div x-show="activeSlide === index"
                 x-transition:enter="transition ease-out duration-500"
                 x-transition:enter-start="opacity-0 transform scale-105"
                 x-transition:enter-end="opacity-100 transform scale-100"
                 x-transition:leave="transition ease-in duration-500"
                 x-transition:leave-start="opacity-100 transform scale-100"
                 x-transition:leave-end="opacity-0 transform scale-95"
                 class="absolute inset-0">
                <!-- Background image with overlay -->
                <div class="absolute inset-0 bg-zinc-900/40"></div>
                <img :src="slide.image" class="h-full w-full object-cover" :alt="slide.title" alt="" src="">

                <!-- Text content -->
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 text-center">
                        <h1
                            x-text="slide.title"
                            class="text-3xl sm:text-4xl md:text-5xl font-bold text-zinc-50 mb-4"
                            x-transition:enter="transition ease-out delay-300 duration-500"
                            x-transition:enter-start="opacity-0 transform translate-y-4"
                            x-transition:enter-end="opacity-100 transform translate-y-0">
                        </h1>
                        <p
                            x-text="slide.subtitle"
                            class="text-lg sm:text-xl text-zinc-50/90 max-w-2xl mx-auto mb-8"
                            x-transition:enter="transition ease-out delay-500 duration-500"
                            x-transition:enter-start="opacity-0 transform translate-y-4"
                            x-transition:enter-end="opacity-100 transform translate-y-0">
                        </p>
                    </div>
                </div>
            </div>
        </template>

        <!-- Arrow navigation -->
        <button @click="activeSlide = (activeSlide - 1 + slides.length) % slides.length" class="cursor-pointer absolute left-4 top-1/2 -translate-y-1/2 rounded-full bg-quarternary/90 p-2 text-zinc-50 hover:bg-quarternary focus:outline-none transition-all duration-300 hover:scale-110">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>
        <button @click="activeSlide = (activeSlide + 1) % slides.length" class="cursor-pointer absolute right-4 top-1/2 -translate-y-1/2 rounded-full bg-quarternary/90 p-2 text-zinc-50 hover:bg-quarternary focus:outline-none transition-all duration-300 hover:scale-110">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>

        <!-- end of carousel container -->
    </div>

    <!-- Cards section below the carousel (moved outside as a separate section) -->
    <div class="relative -mt-24 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
            <a href="#" class="overflow-hidden rounded-lg bg-zinc-50 shadow-lg transition-all duration-300 hover:shadow-xl hover:scale-105 border border-zinc-900 dark:border-zinc-200">
                <div class="w-full h-44 overflow-hidden">
                    <img src="{{ asset('images/surat_edaran.png') }}" alt="Surat Edaran" class="h-full w-full object-cover">
                </div>
            </a>

            <a href="#" class="overflow-hidden rounded-lg bg-zinc-50 shadow-lg transition-all duration-300 hover:shadow-xl hover:scale-105 border border-zinc-900 dark:border-zinc-200">
                <div class="w-full h-44 overflow-hidden">
                    <img src="{{ asset('images/surat_kegiatan.png') }}" alt="Surat Kegiatan" class="h-full w-full object-cover">
                </div>
            </a>

            <a href="#" class="overflow-hidden rounded-lg bg-zinc-50 shadow-lg transition-all duration-300 hover:shadow-xl hover:scale-105 border border-zinc-900 dark:border-zinc-200">
                <div class="w-full h-44 overflow-hidden">
                    <img src="{{ asset('images/informasi_lomba.png') }}" alt="Informasi Lomba" class="h-full w-full object-cover">
                </div>
            </a>

            <a href="#" class="overflow-hidden rounded-lg bg-zinc-50 shadow-lg transition-all duration-300 hover:shadow-xl hover:scale-105 border border-zinc-900 dark:border-zinc-200">
                <div class="w-full h-44 overflow-hidden">
                    <img src="{{ asset('images/berita.png') }}" alt="Berita" class="h-full w-full object-cover">
                </div>
            </a>
        </div>
    </div>

    <!-- Banner Section -->
    @if($about && $about->hasBanner())
    <section class="py-8 md:py-12 lg:py-16">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="flex justify-center">
                <img
                    src="{{ $about->banner_url }}"
                    alt="Banner HMTI"
                    class="w-full max-w-[1440px] h-auto aspect-[1440/440] object-cover rounded-lg border border-zinc-900"
                >
            </div>
        </div>
    </section>
    @endif

    <!-- Informasi Surat Edaran Section -->
    <section class="py-8 md:py-12 lg:py-16 bg-zinc-50 dark:bg-zinc-800">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="mb-12 text-center">
                <h2 class="text-3xl font-bold text-zinc-900 dark:text-zinc-50 mb-4">Informasi Surat Edaran</h2>
                <p class="text-lg text-zinc-600 dark:text-zinc-300 max-w-2xl mx-auto">Dapatkan informasi terbaru dari surat edaran HMTI untuk seluruh mahasiswa Teknik Industri</p>
            </div>
            <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($circularLetters as $letter)
                <div class="bg-white dark:bg-zinc-900 rounded-lg shadow-md hover:shadow-lg transition-shadow p-6 border border-zinc-200 dark:border-zinc-700">
                    <div class="flex items-center justify-between mb-4">
                        <span class="bg-quarternary/10 text-quarternary px-3 py-1 rounded-full text-sm font-medium">{{ $letter->number }}</span>
                        <span class="text-sm text-zinc-500 dark:text-zinc-400">{{ $letter->letter_date->format('d M Y') }}</span>
                    </div>
                    <h3 class="text-lg font-semibold text-zinc-900 dark:text-zinc-50 mb-2">{{ $letter->title }}</h3>
                    <p class="text-zinc-600 dark:text-zinc-300 text-sm mb-4">{{ Str::limit($letter->description, 100) }}</p>
                    <a href="#" class="inline-flex items-center text-primary hover:text-secondary text-sm font-medium">
                        Baca Selengkapnya
                        <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
                @empty
                <div class="col-span-full text-center py-8">
                    <p class="text-zinc-500 dark:text-zinc-400">Belum ada surat edaran tersedia.</p>
                </div>
                @endforelse
            </div>
            <div class="text-center mt-8">
                <a href="#" class="inline-flex items-center px-6 py-3 bg-primary hover:bg-secondary text-white font-medium rounded-lg transition">
                    Lihat Semua Surat Edaran
                    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Informasi Kegiatan Section -->
    <section class="py-8 md:py-12 lg:py-16">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="mb-12 text-center">
                <h2 class="text-3xl font-bold text-zinc-900 dark:text-zinc-50 mb-4">Informasi Kegiatan</h2>
                <p class="text-lg text-zinc-600 dark:text-zinc-300 max-w-2xl mx-auto">Ikuti berbagai kegiatan menarik yang diselenggarakan oleh HMTI Teknik Industri</p>
            </div>
            <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($activities as $activity)
                <div class="bg-white dark:bg-zinc-900 rounded-lg shadow-md hover:shadow-lg transition-shadow overflow-hidden border border-zinc-200 dark:border-zinc-700">
                    <div class="h-48 bg-gradient-to-r from-primary to-secondary relative">
                        @if($activity->image_path)
                            <img src="{{ asset('storage/' . $activity->image_path) }}" alt="{{ $activity->title }}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-r from-primary to-secondary opacity-80"></div>
                        @endif
                        <div class="absolute top-4 left-4">
                            <span class="bg-white/90 text-primary px-3 py-1 rounded-full text-sm font-medium">{{ $activity->organizer ?? 'Kegiatan' }}</span>
                        </div>
                        <div class="absolute bottom-4 right-4">
                            <span class="bg-white/90 text-zinc-800 px-3 py-1 rounded-full text-sm font-medium">{{ $activity->start_date->format('d M Y') }}</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-zinc-900 dark:text-zinc-50 mb-2">{{ $activity->title }}</h3>
                        <p class="text-zinc-600 dark:text-zinc-300 text-sm mb-4">{{ Str::limit($activity->description, 100) }}</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-zinc-500 dark:text-zinc-400">📍 {{ $activity->location }}</span>
                            <a href="#" class="text-primary hover:text-secondary text-sm font-medium">Daftar</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-8">
                    <p class="text-zinc-500 dark:text-zinc-400">Belum ada kegiatan tersedia.</p>
                </div>
                @endforelse
            </div>
            <div class="text-center mt-8">
                <a href="#" class="inline-flex items-center px-6 py-3 bg-secondary hover:bg-primary text-white font-medium rounded-lg transition">
                    Lihat Semua Kegiatan
                    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Informasi Lomba Section -->
    <section class="py-8 md:py-12 lg:py-16 bg-zinc-50 dark:bg-zinc-800">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="mb-12 text-center">
                <h2 class="text-3xl font-bold text-zinc-900 dark:text-zinc-50 mb-4">Informasi Lomba</h2>
                <p class="text-lg text-zinc-600 dark:text-zinc-300 max-w-2xl mx-auto">Ikuti berbagai kompetisi dan lomba untuk mengasah kemampuan dan meraih prestasi</p>
            </div>
            <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($competitions as $competition)
                <div class="bg-white dark:bg-zinc-900 rounded-lg shadow-md hover:shadow-lg transition-shadow p-6 border border-zinc-200 dark:border-zinc-700 relative">
                    <div class="absolute top-4 right-4">
                        <span class="bg-primary/10 text-primary px-2 py-1 rounded text-xs font-medium">{{ $competition->level }}</span>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold text-zinc-900 dark:text-zinc-50 mb-2">{{ $competition->title }}</h3>
                        <p class="text-zinc-600 dark:text-zinc-300 text-sm mb-4">{{ Str::limit($competition->description, 100) }}</p>
                    </div>
                    <div class="space-y-2 mb-4">
                        <div class="flex items-center text-sm text-zinc-500 dark:text-zinc-400">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Deadline: {{ $competition->registration_deadline->format('d F Y') }}
                        </div>
                        @if($competition->prizes)
                        <div class="flex items-center text-sm text-zinc-500 dark:text-zinc-400">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                            </svg>
                            Hadiah: {{ $competition->prizes }}
                        </div>
                        @endif
                    </div>
                    <a href="#" class="inline-flex items-center text-primary hover:text-secondary text-sm font-medium">
                        Daftar Sekarang
                        <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
                @empty
                <div class="col-span-full text-center py-8">
                    <p class="text-zinc-500 dark:text-zinc-400">Belum ada lomba tersedia.</p>
                </div>
                @endforelse
            </div>
            <div class="text-center mt-8">
                <a href="#" class="inline-flex items-center px-6 py-3 bg-primary hover:bg-secondary text-white font-medium rounded-lg transition">
                    Lihat Semua Lomba
                    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Berita Section -->
    <section class="py-8 md:py-12 lg:py-16">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="mb-12 text-center">
                <h2 class="text-3xl font-bold text-zinc-900 dark:text-zinc-50 mb-4">Berita Terbaru</h2>
                <p class="text-lg text-zinc-600 dark:text-zinc-300 max-w-2xl mx-auto">Tetap update dengan berita dan informasi terkini seputar HMTI dan dunia teknik industri</p>
            </div>
            <div class="max-w-7xl mx-auto">
                <!-- Featured News -->
                @if($featuredNews)
                <div class="mb-8">
                    <div class="bg-white dark:bg-zinc-900 rounded-lg shadow-md hover:shadow-lg transition-shadow overflow-hidden border border-zinc-200 dark:border-zinc-700">
                        <div class="md:flex">
                            <div class="md:w-1/3">
                                @if($featuredNews->featured_image)
                                    <img src="{{ asset('storage/' . $featuredNews->featured_image) }}" alt="{{ $featuredNews->title }}" class="w-full h-64 md:h-full object-cover">
                                @else
                                    <div class="h-64 md:h-full bg-gradient-to-br from-primary to-secondary relative">
                                        <div class="absolute top-4 left-4">
                                            <span class="bg-white/90 text-primary px-3 py-1 rounded-full text-sm font-medium">Featured</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="md:w-2/3 p-6">
                                <div class="flex items-center mb-2">
                                    <span class="text-sm text-zinc-500 dark:text-zinc-400">{{ $featuredNews->published_at->format('d F Y') }}</span>
                                    <span class="mx-2 text-zinc-300">•</span>
                                    <span class="text-sm text-quarternary font-medium">{{ $featuredNews->category }}</span>
                                </div>
                                <h3 class="text-2xl font-bold text-zinc-900 dark:text-zinc-50 mb-3">{{ $featuredNews->title }}</h3>
                                <p class="text-zinc-600 dark:text-zinc-300 mb-4">{{ $featuredNews->excerpt }}</p>
                                <a href="#" class="inline-flex items-center text-primary hover:text-secondary font-medium">
                                    Baca Selengkapnya
                                    <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- News Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($news as $article)
                    <div class="bg-white dark:bg-zinc-900 rounded-lg shadow-md hover:shadow-lg transition-shadow overflow-hidden border border-zinc-200 dark:border-zinc-700">
                        <div class="h-48 relative">
                            @if($article->featured_image)
                                <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gradient-to-r from-primary to-secondary"></div>
                            @endif
                            <div class="absolute bottom-4 left-4">
                                <span class="bg-white/90 text-zinc-800 px-2 py-1 rounded text-xs">{{ $article->published_at->format('d M Y') }}</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="mb-2">
                                <span class="text-xs text-quarternary font-medium">{{ $article->category }}</span>
                            </div>
                            <h3 class="text-lg font-semibold text-zinc-900 dark:text-zinc-50 mb-2">{{ $article->title }}</h3>
                            <p class="text-zinc-600 dark:text-zinc-300 text-sm mb-4">{{ Str::limit($article->excerpt, 100) }}</p>
                            <a href="#" class="text-primary hover:text-secondary text-sm font-medium">Baca Selengkapnya</a>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full text-center py-8">
                        <p class="text-zinc-500 dark:text-zinc-400">Belum ada berita tersedia.</p>
                    </div>
                    @endforelse
                </div>
            </div>
            <div class="text-center mt-8">
                <a href="#" class="inline-flex items-center px-6 py-3 bg-quarternary hover:bg-quarternary/80 text-black font-medium rounded-lg transition">
                    Lihat Semua Berita
                    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Video Profil Section -->
    @if($about && $about->hasYoutubeLink())
    <section class="py-8 md:py-12 lg:py-16 bg-zinc-900">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="mb-12 text-center">
                <h2 class="text-4xl font-bold text-zinc-50 mb-4">Tonton Video Kami</h2>
                <p class="text-2xl text-zinc-50/90 max-w-2xl mx-auto">Pelajari tentang sejarah, misi, dan dampak himpunan kami bagi mahasiswa teknik industri.</p>
            </div>

            <div class="max-w-7xl mx-auto">
                <div class="relative overflow-hidden rounded-lg shadow-2xl aspect-video">
                    <!-- YouTube embed with responsive iframe -->
                    <iframe
                        class="absolute inset-0 w-full h-full"
                        src="{{ $about->youtube_embed_url }}"
                        title="Video Profil HMTI"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                </div>

                <div class="mt-6 md:mt-8 flex justify-center">
                    <a href="https://www.youtube.com/@HMTITelkomUniversity" target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center space-x-1 md:space-x-2 rounded-full bg-secondary px-4 py-2 md:px-6 md:py-3 text-sm md:text-base text-zinc-50 hover:bg-primary transition">
                        <svg class="h-4 w-4 md:h-5 md:w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/>
                        </svg>
                        <span class="whitespace-nowrap">Subscribe channel YouTube kami</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
    @endif
</x-layouts.main>
