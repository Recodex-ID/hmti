<x-layouts.main>
    <div class="min-h-screen bg-zinc-50 dark:bg-zinc-900">
        <!-- Hero Section -->
        <section class="bg-gradient-to-br from-purple-600 to-purple-800 dark:from-purple-800 dark:to-purple-900 text-white">
            <div class="container mx-auto px-4 py-16">
                <div class="text-center">
                    <h1 class="text-4xl lg:text-5xl font-bold mb-6">Panduan Logo HMTI</h1>
                    <p class="text-purple-100 text-lg max-w-3xl mx-auto">
                        Pedoman penggunaan logo dan identitas visual HMTI Telkom University
                    </p>
                </div>
            </div>
        </section>

        <!-- Content Section -->
        <div class="container mx-auto px-4 py-12">
            <div class="max-w-4xl mx-auto space-y-8">
                <!-- Logo Display -->
                <div class="bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-lg p-8 text-center">
                    <img src="{{ asset('images/logo_hmti.jpg') }}" alt="Logo HMTI" class="w-32 h-32 mx-auto mb-6 rounded-full">
                    <h2 class="text-2xl font-bold text-zinc-900 dark:text-zinc-100 mb-4">Logo HMTI</h2>
                    <p class="text-zinc-600 dark:text-zinc-400 max-w-2xl mx-auto">
                        Logo resmi Himpunan Mahasiswa Teknik Industri (HMTI) Telkom University yang merepresentasikan 
                        identitas dan nilai-nilai organisasi.
                    </p>
                </div>

                <!-- Download Section -->
                <div class="bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-lg p-8">
                    <h3 class="text-xl font-bold text-zinc-900 dark:text-zinc-100 mb-6">Download Panduan Logo</h3>
                    
                    @if($about && $about->hasLogoGuideline())
                        <div class="text-center mb-6">
                            <a href="{{ $about->logo_guideline_url }}" target="_blank" class="inline-flex items-center px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-md transition">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Download Panduan Logo PDF
                            </a>
                        </div>
                    @else
                        <div class="text-center mb-6 p-4 bg-zinc-100 dark:bg-zinc-700 rounded-lg">
                            <p class="text-zinc-600 dark:text-zinc-400">Panduan logo belum tersedia</p>
                        </div>
                    @endif

                    <h4 class="text-lg font-semibold text-zinc-900 dark:text-zinc-100 mb-4">Asset Logo Lainnya</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <a href="#" class="flex items-center p-4 border border-zinc-200 dark:border-zinc-700 rounded-lg hover:bg-zinc-50 dark:hover:bg-zinc-700 transition">
                            <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-purple-600 dark:text-purple-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <div class="font-medium text-zinc-900 dark:text-zinc-100">PNG</div>
                                <div class="text-sm text-zinc-500 dark:text-zinc-400">High Resolution</div>
                            </div>
                        </a>
                        <a href="#" class="flex items-center p-4 border border-zinc-200 dark:border-zinc-700 rounded-lg hover:bg-zinc-50 dark:hover:bg-zinc-700 transition">
                            <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-purple-600 dark:text-purple-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <div class="font-medium text-zinc-900 dark:text-zinc-100">SVG</div>
                                <div class="text-sm text-zinc-500 dark:text-zinc-400">Vector Format</div>
                            </div>
                        </a>
                        <a href="#" class="flex items-center p-4 border border-zinc-200 dark:border-zinc-700 rounded-lg hover:bg-zinc-50 dark:hover:bg-zinc-700 transition">
                            <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-purple-600 dark:text-purple-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <div class="font-medium text-zinc-900 dark:text-zinc-100">PDF</div>
                                <div class="text-sm text-zinc-500 dark:text-zinc-400">Print Ready</div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Usage Guidelines -->
                <div class="bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-lg p-8">
                    <h3 class="text-xl font-bold text-zinc-900 dark:text-zinc-100 mb-6">Panduan Penggunaan</h3>
                    <div class="space-y-6">
                        <div>
                            <h4 class="font-semibold text-zinc-900 dark:text-zinc-100 mb-3">✅ Yang Diperbolehkan</h4>
                            <ul class="space-y-2 text-zinc-700 dark:text-zinc-300">
                                <li class="flex items-start gap-3">
                                    <div class="w-2 h-2 rounded-full bg-green-500 mt-2 flex-shrink-0"></div>
                                    <span>Menggunakan logo untuk keperluan resmi HMTI</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <div class="w-2 h-2 rounded-full bg-green-500 mt-2 flex-shrink-0"></div>
                                    <span>Mempertahankan proporsi dan warna asli logo</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <div class="w-2 h-2 rounded-full bg-green-500 mt-2 flex-shrink-0"></div>
                                    <span>Menggunakan pada media cetak dan digital</span>
                                </li>
                            </ul>
                        </div>
                        
                        <div>
                            <h4 class="font-semibold text-zinc-900 dark:text-zinc-100 mb-3">❌ Yang Tidak Diperbolehkan</h4>
                            <ul class="space-y-2 text-zinc-700 dark:text-zinc-300">
                                <li class="flex items-start gap-3">
                                    <div class="w-2 h-2 rounded-full bg-red-500 mt-2 flex-shrink-0"></div>
                                    <span>Mengubah bentuk, warna, atau proporsi logo</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <div class="w-2 h-2 rounded-full bg-red-500 mt-2 flex-shrink-0"></div>
                                    <span>Menggunakan untuk kepentingan komersial tanpa izin</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <div class="w-2 h-2 rounded-full bg-red-500 mt-2 flex-shrink-0"></div>
                                    <span>Menempatkan logo pada background yang kontrasnya rendah</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-lg p-8">
                    <h3 class="text-xl font-bold text-zinc-900 dark:text-zinc-100 mb-4">Butuh Bantuan?</h3>
                    <p class="text-zinc-600 dark:text-zinc-400 mb-4">
                        Jika Anda memerlukan format khusus atau memiliki pertanyaan tentang penggunaan logo, 
                        silakan hubungi Departemen Komunikasi & Informasi HMTI.
                    </p>
                    <a href="mailto:kominfo@hmti.ac.id" class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-md transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.main>