<x-layouts.main>
    <div class="min-h-screen bg-zinc-50 dark:bg-zinc-900">
        <!-- Hero Section -->
        <section class="bg-gradient-to-br from-slate-600 to-slate-800 dark:from-slate-800 dark:to-slate-900 text-white">
            <div class="container mx-auto px-4 py-16">
                <div class="text-center">
                    <h1 class="text-4xl lg:text-5xl font-bold mb-6">BURT</h1>
                    <p class="text-slate-100 text-lg max-w-3xl mx-auto">
                        Badan Urusan Rumah Tangga HMTI
                    </p>
                </div>
            </div>
        </section>

        <!-- Content Section -->
        <div class="container mx-auto px-4 py-12">
            <div class="max-w-4xl mx-auto">
                @if($mpm)
                    <div class="bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-lg overflow-hidden">
                        @if($mpm->banner_image_url)
                            <div class="w-full h-64 bg-zinc-100 dark:bg-zinc-700">
                                <img src="{{ $mpm->banner_image_url }}" alt="{{ $mpm->title }}" class="w-full h-full object-cover">
                            </div>
                        @endif
                        
                        <div class="p-8">
                            <h2 class="text-3xl font-bold text-zinc-900 dark:text-zinc-100 mb-4">{{ $mpm->title }}</h2>
                            <p class="text-zinc-600 dark:text-zinc-400 mb-8">
                                {{ $mpm->description }}
                            </p>

                            @if($mpm->content && count($mpm->content) > 0)
                                <div class="space-y-6">
                                    @foreach($mpm->content as $content)
                                        <div class="border-l-4 border-slate-500 pl-6">
                                            <h3 class="text-xl font-semibold text-zinc-900 dark:text-zinc-100 mb-2">
                                                {{ $content['title'] }}
                                            </h3>
                                            <p class="text-zinc-600 dark:text-zinc-400">
                                                {{ $content['description'] }}
                                            </p>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            @if($mpm->attachment_file_url)
                                <div class="mt-8 pt-6 border-t border-zinc-200 dark:border-zinc-700">
                                    <a href="{{ $mpm->attachment_file_url }}" target="_blank" 
                                       class="inline-flex items-center px-4 py-2 bg-slate-600 text-white rounded-lg hover:bg-slate-700 transition-colors">
                                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                        </svg>
                                        Unduh Dokumen
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-lg p-8 text-center">
                        <div class="w-24 h-24 bg-slate-100 dark:bg-slate-900 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-12 h-12 text-slate-600 dark:text-slate-300" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <h2 class="text-3xl font-bold text-zinc-900 dark:text-zinc-100 mb-4">BURT</h2>
                        <p class="text-zinc-600 dark:text-zinc-400 mb-8 max-w-2xl mx-auto">
                            Badan Urusan Rumah Tangga bertugas mengatur dan mengelola urusan internal organisasi HMTI
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.main>