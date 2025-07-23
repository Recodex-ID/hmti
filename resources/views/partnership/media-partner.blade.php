<x-layouts.main>
    <div class="min-h-screen bg-zinc-50 dark:bg-zinc-900">
        <!-- Hero Section -->
        <section class="bg-gradient-to-br from-pink-600 to-pink-800 dark:from-pink-800 dark:to-pink-900 text-white">
            <div class="container mx-auto px-4 py-16">
                <div class="text-center">
                    <h1 class="text-4xl lg:text-5xl font-bold mb-6">
                        {{ $partnership ? $partnership->title : 'Media Partner' }}
                    </h1>
                    <p class="text-pink-100 text-lg max-w-3xl mx-auto">
                        {{ $partnership ? $partnership->description : 'Kerjasama media partner untuk publikasi dan promosi acara HMTI' }}
                    </p>
                </div>
            </div>
        </section>

        <!-- Content Section -->
        <div class="container mx-auto px-4 py-12">
            <div class="max-w-4xl mx-auto space-y-8">
                @if($partnership && $partnership->hasBanner())
                    <div class="bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-lg p-8">
                        <img src="{{ $partnership->banner_url }}" alt="Partnership Banner" class="w-full h-64 object-cover rounded-lg">
                    </div>
                @endif

                <div class="bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-lg p-8 text-center">
                    <div class="w-24 h-24 bg-pink-100 dark:bg-pink-900 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-pink-600 dark:text-pink-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-zinc-900 dark:text-zinc-100 mb-4">
                        {{ $partnership ? $partnership->title : 'Media Partner' }}
                    </h2>
                    <p class="text-zinc-600 dark:text-zinc-400 mb-8 max-w-2xl mx-auto">
                        {{ $partnership ? $partnership->description : 'Bergabunglah sebagai media partner untuk mendukung publikasi dan promosi berbagai acara dan kegiatan HMTI' }}
                    </p>

                    <div class="flex justify-center space-x-4">
                        @if($partnership && $partnership->hasDocument())
                            <a href="{{ $partnership->document_url }}" target="_blank" class="inline-flex items-center px-6 py-3 bg-pink-600 hover:bg-pink-700 text-white font-medium rounded-md transition">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Download Dokumen
                            </a>
                        @endif

                        <a href="#contact" class="inline-flex items-center px-6 py-3 bg-pink-600 hover:bg-pink-700 text-white font-medium rounded-md transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            Hubungi Kami
                        </a>
                    </div>
                </div>

                <!-- Additional Content -->
                @if($partnership && $partnership->hasContent())
                    <div class="bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-lg p-8">
                        <h3 class="text-2xl font-bold text-zinc-900 dark:text-zinc-100 mb-6">Detail Partnership</h3>
                        <div class="space-y-4">
                            @foreach($partnership->content as $index => $content)
                                <div class="flex items-start gap-4 p-4 bg-pink-50 dark:bg-pink-900/20 rounded-lg">
                                    <div class="w-8 h-8 bg-pink-500 text-white rounded-full flex items-center justify-center text-sm font-bold">
                                        {{ $index + 1 }}
                                    </div>
                                    <p class="text-zinc-700 dark:text-zinc-300 flex-1">{{ $content }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Contact Information -->
                @if($partnership && $partnership->hasContactInfo())
                    <div id="contact" class="bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-lg p-8">
                        <h3 class="text-2xl font-bold text-zinc-900 dark:text-zinc-100 mb-6">Informasi Kontak</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($partnership->contact_info as $contact)
                                <div class="p-4 bg-zinc-50 dark:bg-zinc-700 rounded-lg">
                                    @if(!empty($contact['name']))
                                        <div class="font-semibold text-zinc-900 dark:text-zinc-100">{{ $contact['name'] }}</div>
                                    @endif
                                    @if(!empty($contact['email']))
                                        <div class="text-zinc-600 dark:text-zinc-400">
                                            <a href="mailto:{{ $contact['email'] }}" class="hover:text-pink-600">{{ $contact['email'] }}</a>
                                        </div>
                                    @endif
                                    @if(!empty($contact['phone']))
                                        <div class="text-zinc-600 dark:text-zinc-400">
                                            <a href="tel:{{ $contact['phone'] }}" class="hover:text-pink-600">{{ $contact['phone'] }}</a>
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