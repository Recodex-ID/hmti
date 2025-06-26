<x-layouts.main title="Beranda | HMTI Telkom University">
    <!-- Hero Section with Carousel -->
    <div x-data="{
    activeSlide: 0,
    slides: [
        {
            image: '{{ asset('images/gedung.jpg') }}',
            title: 'Himpunan Mahasiswa Teknik Industri',
            subtitle: 'Membangun masa depan insinyur industri yang unggul'
        },
        {
            image: 'https://picsum.photos/id/2/1920/1080',
            title: 'Bergabunglah dengan Komunitas Kami',
            subtitle: 'Terhubung dengan sesama mahasiswa dan profesional industri'
        },
        {
            image: 'https://picsum.photos/id/3/1920/1080',
            title: 'Keunggulan dalam Teknik Industri',
            subtitle: 'Mengembangkan keterampilan, pengetahuan, dan inovasi'
        }
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
    <section class="py-8 md:py-12 lg:py-16">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="flex justify-center">
                <img
                    src="{{ asset('images/banner.png') }}"
                    alt="Banner"
                    class="w-full max-w-[1440px] h-auto aspect-[1440/440] object-cover rounded-lg border border-zinc-900"
                >
            </div>
        </div>
    </section>

    <!-- Informasi Surat Edaran Section -->
    <section class="py-8 md:py-12 lg:py-16 bg-zinc-50 dark:bg-zinc-800">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="mb-12 text-center">
                <h2 class="text-3xl font-bold text-zinc-900 dark:text-zinc-50 mb-4">Informasi Surat Edaran</h2>
                <p class="text-lg text-zinc-600 dark:text-zinc-300 max-w-2xl mx-auto">Dapatkan informasi terbaru dari surat edaran HMTI untuk seluruh mahasiswa Teknik Industri</p>
            </div>
            <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Sample Circular Letter Cards -->
                <div class="bg-white dark:bg-zinc-900 rounded-lg shadow-md hover:shadow-lg transition-shadow p-6 border border-zinc-200 dark:border-zinc-700">
                    <div class="flex items-center justify-between mb-4">
                        <span class="bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 px-3 py-1 rounded-full text-sm font-medium">SE-001/2024</span>
                        <span class="text-sm text-zinc-500 dark:text-zinc-400">15 Des 2024</span>
                    </div>
                    <h3 class="text-lg font-semibold text-zinc-900 dark:text-zinc-50 mb-2">Pengumuman Kegiatan Akhir Tahun HMTI</h3>
                    <p class="text-zinc-600 dark:text-zinc-300 text-sm mb-4">Pemberitahuan mengenai serangkaian kegiatan akhir tahun yang akan dilaksanakan oleh HMTI...</p>
                    <a href="#" class="inline-flex items-center text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 text-sm font-medium">
                        Baca Selengkapnya
                        <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>

                <div class="bg-white dark:bg-zinc-900 rounded-lg shadow-md hover:shadow-lg transition-shadow p-6 border border-zinc-200 dark:border-zinc-700">
                    <div class="flex items-center justify-between mb-4">
                        <span class="bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 px-3 py-1 rounded-full text-sm font-medium">SE-002/2024</span>
                        <span class="text-sm text-zinc-500 dark:text-zinc-400">10 Des 2024</span>
                    </div>
                    <h3 class="text-lg font-semibold text-zinc-900 dark:text-zinc-50 mb-2">Protokol Kesehatan dalam Kegiatan HMTI</h3>
                    <p class="text-zinc-600 dark:text-zinc-300 text-sm mb-4">Panduan dan protokol kesehatan yang harus dipatuhi dalam setiap kegiatan HMTI...</p>
                    <a href="#" class="inline-flex items-center text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 text-sm font-medium">
                        Baca Selengkapnya
                        <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>

                <div class="bg-white dark:bg-zinc-900 rounded-lg shadow-md hover:shadow-lg transition-shadow p-6 border border-zinc-200 dark:border-zinc-700">
                    <div class="flex items-center justify-between mb-4">
                        <span class="bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 px-3 py-1 rounded-full text-sm font-medium">SE-003/2024</span>
                        <span class="text-sm text-zinc-500 dark:text-zinc-400">5 Des 2024</span>
                    </div>
                    <h3 class="text-lg font-semibold text-zinc-900 dark:text-zinc-50 mb-2">Pendaftaran Anggota Baru HMTI 2025</h3>
                    <p class="text-zinc-600 dark:text-zinc-300 text-sm mb-4">Informasi mengenai pembukaan pendaftaran anggota baru HMTI untuk tahun 2025...</p>
                    <a href="#" class="inline-flex items-center text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 text-sm font-medium">
                        Baca Selengkapnya
                        <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="text-center mt-8">
                <a href="#" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition">
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
                <!-- Sample Activity Cards -->
                <div class="bg-white dark:bg-zinc-900 rounded-lg shadow-md hover:shadow-lg transition-shadow overflow-hidden border border-zinc-200 dark:border-zinc-700">
                    <div class="h-48 bg-gradient-to-r from-green-400 to-green-600 relative">
                        <div class="absolute top-4 left-4">
                            <span class="bg-white/90 text-green-800 px-3 py-1 rounded-full text-sm font-medium">Workshop</span>
                        </div>
                        <div class="absolute bottom-4 right-4">
                            <span class="bg-white/90 text-zinc-800 px-3 py-1 rounded-full text-sm font-medium">20 Jan 2025</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-zinc-900 dark:text-zinc-50 mb-2">Workshop Lean Manufacturing</h3>
                        <p class="text-zinc-600 dark:text-zinc-300 text-sm mb-4">Pelatihan implementasi prinsip lean manufacturing dalam industri modern untuk meningkatkan efisiensi produksi</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-zinc-500 dark:text-zinc-400">📍 Gedung C - Lab IE</span>
                            <a href="#" class="text-green-600 dark:text-green-400 hover:text-green-800 dark:hover:text-green-300 text-sm font-medium">Daftar</a>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-zinc-900 rounded-lg shadow-md hover:shadow-lg transition-shadow overflow-hidden border border-zinc-200 dark:border-zinc-700">
                    <div class="h-48 bg-gradient-to-r from-purple-400 to-purple-600 relative">
                        <div class="absolute top-4 left-4">
                            <span class="bg-white/90 text-purple-800 px-3 py-1 rounded-full text-sm font-medium">Seminar</span>
                        </div>
                        <div class="absolute bottom-4 right-4">
                            <span class="bg-white/90 text-zinc-800 px-3 py-1 rounded-full text-sm font-medium">25 Jan 2025</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-zinc-900 dark:text-zinc-50 mb-2">Seminar Industri 4.0</h3>
                        <p class="text-zinc-600 dark:text-zinc-300 text-sm mb-4">Diskusi mendalam tentang transformasi digital dan teknologi Industry 4.0 dalam perspektif teknik industri</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-zinc-500 dark:text-zinc-400">📍 Auditorium FRI</span>
                            <a href="#" class="text-purple-600 dark:text-purple-400 hover:text-purple-800 dark:hover:text-purple-300 text-sm font-medium">Daftar</a>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-zinc-900 rounded-lg shadow-md hover:shadow-lg transition-shadow overflow-hidden border border-zinc-200 dark:border-zinc-700">
                    <div class="h-48 bg-gradient-to-r from-orange-400 to-orange-600 relative">
                        <div class="absolute top-4 left-4">
                            <span class="bg-white/90 text-orange-800 px-3 py-1 rounded-full text-sm font-medium">Kunjungan</span>
                        </div>
                        <div class="absolute bottom-4 right-4">
                            <span class="bg-white/90 text-zinc-800 px-3 py-1 rounded-full text-sm font-medium">30 Jan 2025</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-zinc-900 dark:text-zinc-50 mb-2">Kunjungan Industri</h3>
                        <p class="text-zinc-600 dark:text-zinc-300 text-sm mb-4">Kunjungan ke PT. Astra Honda Motor untuk melihat langsung penerapan sistem produksi lean</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-zinc-500 dark:text-zinc-400">📍 PT. Astra Honda</span>
                            <a href="#" class="text-orange-600 dark:text-orange-400 hover:text-orange-800 dark:hover:text-orange-300 text-sm font-medium">Daftar</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-8">
                <a href="#" class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition">
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
                <!-- Sample Competition Cards -->
                <div class="bg-white dark:bg-zinc-900 rounded-lg shadow-md hover:shadow-lg transition-shadow p-6 border border-zinc-200 dark:border-zinc-700 relative">
                    <div class="absolute top-4 right-4">
                        <span class="bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 px-2 py-1 rounded text-xs font-medium">Nasional</span>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold text-zinc-900 dark:text-zinc-50 mb-2">Industrial Engineering Competition 2025</h3>
                        <p class="text-zinc-600 dark:text-zinc-300 text-sm mb-4">Kompetisi nasional untuk mahasiswa teknik industri dengan berbagai kategori lomba</p>
                    </div>
                    <div class="space-y-2 mb-4">
                        <div class="flex items-center text-sm text-zinc-500 dark:text-zinc-400">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Deadline: 15 Februari 2025
                        </div>
                        <div class="flex items-center text-sm text-zinc-500 dark:text-zinc-400">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                            </svg>
                            Hadiah: Rp 25.000.000
                        </div>
                    </div>
                    <a href="#" class="inline-flex items-center text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 text-sm font-medium">
                        Daftar Sekarang
                        <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>

                <div class="bg-white dark:bg-zinc-900 rounded-lg shadow-md hover:shadow-lg transition-shadow p-6 border border-zinc-200 dark:border-zinc-700 relative">
                    <div class="absolute top-4 right-4">
                        <span class="bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200 px-2 py-1 rounded text-xs font-medium">Regional</span>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold text-zinc-900 dark:text-zinc-50 mb-2">Business Case Competition</h3>
                        <p class="text-zinc-600 dark:text-zinc-300 text-sm mb-4">Kompetisi studi kasus bisnis untuk mahasiswa se-Jawa Barat dengan tema sustainable business</p>
                    </div>
                    <div class="space-y-2 mb-4">
                        <div class="flex items-center text-sm text-zinc-500 dark:text-zinc-400">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Deadline: 20 Februari 2025
                        </div>
                        <div class="flex items-center text-sm text-zinc-500 dark:text-zinc-400">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                            </svg>
                            Hadiah: Rp 15.000.000
                        </div>
                    </div>
                    <a href="#" class="inline-flex items-center text-yellow-600 dark:text-yellow-400 hover:text-yellow-800 dark:hover:text-yellow-300 text-sm font-medium">
                        Daftar Sekarang
                        <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>

                <div class="bg-white dark:bg-zinc-900 rounded-lg shadow-md hover:shadow-lg transition-shadow p-6 border border-zinc-200 dark:border-zinc-700 relative">
                    <div class="absolute top-4 right-4">
                        <span class="bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 px-2 py-1 rounded text-xs font-medium">Internal</span>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold text-zinc-900 dark:text-zinc-50 mb-2">HMTI Innovation Challenge</h3>
                        <p class="text-zinc-600 dark:text-zinc-300 text-sm mb-4">Kompetisi inovasi internal HMTI untuk mengembangkan solusi kreatif masalah industri</p>
                    </div>
                    <div class="space-y-2 mb-4">
                        <div class="flex items-center text-sm text-zinc-500 dark:text-zinc-400">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Deadline: 28 Februari 2025
                        </div>
                        <div class="flex items-center text-sm text-zinc-500 dark:text-zinc-400">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                            </svg>
                            Hadiah: Rp 5.000.000
                        </div>
                    </div>
                    <a href="#" class="inline-flex items-center text-green-600 dark:text-green-400 hover:text-green-800 dark:hover:text-green-300 text-sm font-medium">
                        Daftar Sekarang
                        <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="text-center mt-8">
                <a href="#" class="inline-flex items-center px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition">
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
                <div class="mb-8">
                    <div class="bg-white dark:bg-zinc-900 rounded-lg shadow-md hover:shadow-lg transition-shadow overflow-hidden border border-zinc-200 dark:border-zinc-700">
                        <div class="md:flex">
                            <div class="md:w-1/3">
                                <div class="h-64 md:h-full bg-gradient-to-br from-blue-500 to-purple-600 relative">
                                    <div class="absolute top-4 left-4">
                                        <span class="bg-white/90 text-purple-800 px-3 py-1 rounded-full text-sm font-medium">Featured</span>
                                    </div>
                                </div>
                            </div>
                            <div class="md:w-2/3 p-6">
                                <div class="flex items-center mb-2">
                                    <span class="text-sm text-zinc-500 dark:text-zinc-400">22 Desember 2024</span>
                                    <span class="mx-2 text-zinc-300">•</span>
                                    <span class="text-sm text-purple-600 dark:text-purple-400 font-medium">Prestasi</span>
                                </div>
                                <h3 class="text-2xl font-bold text-zinc-900 dark:text-zinc-50 mb-3">HMTI Telkom University Raih Juara 1 Kompetisi Nasional Industrial Engineering</h3>
                                <p class="text-zinc-600 dark:text-zinc-300 mb-4">Tim mahasiswa HMTI Telkom University berhasil meraih juara 1 dalam kompetisi nasional Industrial Engineering Challenge 2024 yang diselenggarakan di Jakarta. Prestasi ini membuktikan kualitas mahasiswa teknik industri Telkom University di tingkat nasional.</p>
                                <a href="#" class="inline-flex items-center text-purple-600 dark:text-purple-400 hover:text-purple-800 dark:hover:text-purple-300 font-medium">
                                    Baca Selengkapnya
                                    <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- News Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-white dark:bg-zinc-900 rounded-lg shadow-md hover:shadow-lg transition-shadow overflow-hidden border border-zinc-200 dark:border-zinc-700">
                        <div class="h-48 bg-gradient-to-r from-green-400 to-blue-500 relative">
                            <div class="absolute bottom-4 left-4">
                                <span class="bg-white/90 text-zinc-800 px-2 py-1 rounded text-xs">20 Des 2024</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="mb-2">
                                <span class="text-xs text-green-600 dark:text-green-400 font-medium">Kegiatan</span>
                            </div>
                            <h3 class="text-lg font-semibold text-zinc-900 dark:text-zinc-50 mb-2">Workshop Lean Six Sigma Sukses Diselenggarakan</h3>
                            <p class="text-zinc-600 dark:text-zinc-300 text-sm mb-4">HMTI berhasil menyelenggarakan workshop Lean Six Sigma dengan partisipasi 150 mahasiswa dari berbagai perguruan tinggi.</p>
                            <a href="#" class="text-green-600 dark:text-green-400 hover:text-green-800 dark:hover:text-green-300 text-sm font-medium">Baca Selengkapnya</a>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-zinc-900 rounded-lg shadow-md hover:shadow-lg transition-shadow overflow-hidden border border-zinc-200 dark:border-zinc-700">
                        <div class="h-48 bg-gradient-to-r from-orange-400 to-red-500 relative">
                            <div class="absolute bottom-4 left-4">
                                <span class="bg-white/90 text-zinc-800 px-2 py-1 rounded text-xs">18 Des 2024</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="mb-2">
                                <span class="text-xs text-orange-600 dark:text-orange-400 font-medium">Kerjasama</span>
                            </div>
                            <h3 class="text-lg font-semibold text-zinc-900 dark:text-zinc-50 mb-2">MoU dengan PT Unilever Indonesia</h3>
                            <p class="text-zinc-600 dark:text-zinc-300 text-sm mb-4">HMTI menandatangani MoU dengan PT Unilever Indonesia untuk program magang dan pengembangan kurikulum.</p>
                            <a href="#" class="text-orange-600 dark:text-orange-400 hover:text-orange-800 dark:hover:text-orange-300 text-sm font-medium">Baca Selengkapnya</a>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-zinc-900 rounded-lg shadow-md hover:shadow-lg transition-shadow overflow-hidden border border-zinc-200 dark:border-zinc-700">
                        <div class="h-48 bg-gradient-to-r from-purple-400 to-pink-500 relative">
                            <div class="absolute bottom-4 left-4">
                                <span class="bg-white/90 text-zinc-800 px-2 py-1 rounded text-xs">15 Des 2024</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="mb-2">
                                <span class="text-xs text-purple-600 dark:text-purple-400 font-medium">Pengumuman</span>
                            </div>
                            <h3 class="text-lg font-semibold text-zinc-900 dark:text-zinc-50 mb-2">Pengurus Baru HMTI Periode 2025</h3>
                            <p class="text-zinc-600 dark:text-zinc-300 text-sm mb-4">Pengumuman susunan pengurus baru HMTI Telkom University periode 2025 telah resmi diumumkan.</p>
                            <a href="#" class="text-purple-600 dark:text-purple-400 hover:text-purple-800 dark:hover:text-purple-300 text-sm font-medium">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-8">
                <a href="#" class="inline-flex items-center px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-lg transition">
                    Lihat Semua Berita
                    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Video Profil Section -->
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
                        src="https://www.youtube.com/embed/MkOS0xYa5qY?si=_ZNVQDB72NI-rK0I"
                        title="THIRTY TWO WONDER YEARS"
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
</x-layouts.main>
