<x-layouts.main>
    <div class="min-h-screen bg-zinc-50 dark:bg-zinc-900">
        <!-- Hero Section -->
        <section class="bg-gradient-to-br from-purple-600 to-purple-800 dark:from-purple-800 dark:to-purple-900 text-white">
            <div class="container mx-auto px-4 py-16">
                <div class="flex flex-col lg:flex-row items-center gap-8">
                    <!-- Logo Community -->
                    @if($community->logo)
                        <div class="flex-shrink-0">
                            <img src="{{ $community->logo_url }}" alt="{{ $community->title }}" class="w-24 h-24 lg:w-32 lg:h-32 rounded-full border-4 border-white/20">
                        </div>
                    @endif
                    
                    <!-- Informasi Community -->
                    <div class="text-center lg:text-left">
                        <h1 class="text-3xl lg:text-4xl font-bold mb-2">{{ $community->title }}</h1>
                        <p class="text-purple-100 text-lg mb-4">{{ ucfirst($community->category) }}</p>
                        @if($community->description)
                            <p class="text-purple-50 max-w-2xl">{{ $community->description }}</p>
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
                    <!-- Tentang Community -->
                    <div class="bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-lg p-6">
                        <h2 class="text-xl font-bold text-zinc-900 dark:text-zinc-100 mb-6">Tentang {{ $community->title }}</h2>
                        @if($community->description)
                            <div class="prose dark:prose-invert max-w-none">
                                <p class="text-zinc-700 dark:text-zinc-300 leading-relaxed">{{ $community->description }}</p>
                            </div>
                        @else
                            <p class="text-zinc-500 dark:text-zinc-400 italic">Deskripsi belum tersedia.</p>
                        @endif
                    </div>

                    <!-- Aktivitas & Kegiatan -->
                    <div class="bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-lg p-6">
                        <h2 class="text-xl font-bold text-zinc-900 dark:text-zinc-100 mb-6">Aktivitas & Kegiatan</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @if($community->category === 'Community')
                                <div class="p-4 border border-zinc-200 dark:border-zinc-700 rounded-lg bg-zinc-50 dark:bg-zinc-700">
                                    <h4 class="font-semibold text-zinc-900 dark:text-zinc-100 mb-2">Pengembangan Minat & Bakat</h4>
                                    <p class="text-sm text-zinc-600 dark:text-zinc-400">Wadah untuk mengembangkan minat dan bakat mahasiswa</p>
                                </div>
                                <div class="p-4 border border-zinc-200 dark:border-zinc-700 rounded-lg bg-zinc-50 dark:bg-zinc-700">
                                    <h4 class="font-semibold text-zinc-900 dark:text-zinc-100 mb-2">Workshop & Pelatihan</h4>
                                    <p class="text-sm text-zinc-600 dark:text-zinc-400">Menyelenggarakan workshop dan pelatihan reguler</p>
                                </div>
                                <div class="p-4 border border-zinc-200 dark:border-zinc-700 rounded-lg bg-zinc-50 dark:bg-zinc-700">
                                    <h4 class="font-semibold text-zinc-900 dark:text-zinc-100 mb-2">Event & Kompetisi</h4>
                                    <p class="text-sm text-zinc-600 dark:text-zinc-400">Mengadakan event dan kompetisi sesuai bidang</p>
                                </div>
                                <div class="p-4 border border-zinc-200 dark:border-zinc-700 rounded-lg bg-zinc-50 dark:bg-zinc-700">
                                    <h4 class="font-semibold text-zinc-900 dark:text-zinc-100 mb-2">Kolaborasi & Networking</h4>
                                    <p class="text-sm text-zinc-600 dark:text-zinc-400">Membangun jaringan dengan komunitas lain</p>
                                </div>
                            @else
                                <div class="p-4 border border-zinc-200 dark:border-zinc-700 rounded-lg bg-zinc-50 dark:bg-zinc-700">
                                    <h4 class="font-semibold text-zinc-900 dark:text-zinc-100 mb-2">Perencanaan Event</h4>
                                    <p class="text-sm text-zinc-600 dark:text-zinc-400">Merancang dan mengorganisir acara besar</p>
                                </div>
                                <div class="p-4 border border-zinc-200 dark:border-zinc-700 rounded-lg bg-zinc-50 dark:bg-zinc-700">
                                    <h4 class="font-semibold text-zinc-900 dark:text-zinc-100 mb-2">Koordinasi Tim</h4>
                                    <p class="text-sm text-zinc-600 dark:text-zinc-400">Mengkoordinasikan berbagai divisi</p>
                                </div>
                                <div class="p-4 border border-zinc-200 dark:border-zinc-700 rounded-lg bg-zinc-50 dark:bg-zinc-700">
                                    <h4 class="font-semibold text-zinc-900 dark:text-zinc-100 mb-2">Manajemen Proyek</h4>
                                    <p class="text-sm text-zinc-600 dark:text-zinc-400">Mengelola timeline dan deliverables</p>
                                </div>
                                <div class="p-4 border border-zinc-200 dark:border-zinc-700 rounded-lg bg-zinc-50 dark:bg-zinc-700">
                                    <h4 class="font-semibold text-zinc-900 dark:text-zinc-100 mb-2">Evaluasi & Laporan</h4>
                                    <p class="text-sm text-zinc-600 dark:text-zinc-400">Mengevaluasi hasil dan membuat laporan</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Info Community -->
                    <div class="bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-lg p-6">
                        <h3 class="text-lg font-bold text-zinc-900 dark:text-zinc-100 mb-4">Informasi</h3>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-zinc-500 dark:text-zinc-400">Kategori</span>
                                <span class="text-sm font-medium text-zinc-900 dark:text-zinc-100">{{ ucfirst($community->category) }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-zinc-500 dark:text-zinc-400">Status</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                    Aktif
                                </span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-zinc-500 dark:text-zinc-400">Bergabung</span>
                                <span class="text-sm font-medium text-zinc-900 dark:text-zinc-100">Terbuka</span>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Info -->
                    <div class="bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-lg p-6">
                        <h3 class="text-lg font-bold text-zinc-900 dark:text-zinc-100 mb-4">Kontak</h3>
                        <div class="space-y-3 text-sm">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <span class="text-zinc-600 dark:text-zinc-400">{{ strtolower(str_replace(' ', '', $community->title)) }}@hmti.ac.id</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-zinc-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                </svg>
                                <span class="text-zinc-600 dark:text-zinc-400">@{{ strtolower(str_replace(' ', '', $community->title)) }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-zinc-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.097.118.112.221.085.342-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001 12.017.001z"/>
                                </svg>
                                <span class="text-zinc-600 dark:text-zinc-400">{{ $community->title }} HMTI</span>
                            </div>
                        </div>
                    </div>

                    <!-- Cara Bergabung -->
                    <div class="bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-lg p-6">
                        <h3 class="text-lg font-bold text-zinc-900 dark:text-zinc-100 mb-4">Cara Bergabung</h3>
                        <div class="space-y-3 text-sm">
                            <div class="flex items-start gap-3">
                                <div class="w-6 h-6 rounded-full bg-purple-100 dark:bg-purple-900 text-purple-600 dark:text-purple-300 flex items-center justify-center text-xs font-bold flex-shrink-0">
                                    1
                                </div>
                                <p class="text-zinc-600 dark:text-zinc-400">Hubungi kontak yang tersedia</p>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="w-6 h-6 rounded-full bg-purple-100 dark:bg-purple-900 text-purple-600 dark:text-purple-300 flex items-center justify-center text-xs font-bold flex-shrink-0">
                                    2
                                </div>
                                <p class="text-zinc-600 dark:text-zinc-400">Ikuti proses seleksi</p>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="w-6 h-6 rounded-full bg-purple-100 dark:bg-purple-900 text-purple-600 dark:text-purple-300 flex items-center justify-center text-xs font-bold flex-shrink-0">
                                    3
                                </div>
                                <p class="text-zinc-600 dark:text-zinc-400">Mulai berkontribusi</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.main>