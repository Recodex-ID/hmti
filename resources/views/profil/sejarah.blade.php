<x-layouts.main>
    <div class="min-h-screen bg-zinc-50 dark:bg-zinc-900">
        <!-- Hero Section -->
        <section class="bg-gradient-to-br from-teal-600 to-teal-800 dark:from-teal-800 dark:to-teal-900 text-white">
            <div class="container mx-auto px-4 py-16">
                <div class="text-center">
                    <h1 class="text-4xl lg:text-5xl font-bold mb-6">Sejarah HMTI</h1>
                    <p class="text-teal-100 text-lg max-w-3xl mx-auto">
                        Perjalanan sejarah dan perkembangan HMTI Telkom University dari masa ke masa
                    </p>
                </div>
            </div>
        </section>

        <!-- Content Section -->
        <div class="container mx-auto px-4 py-12">
            <div class="max-w-4xl mx-auto">
                <div class="bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-lg p-8">
                    <h2 class="text-2xl font-bold text-zinc-900 dark:text-zinc-100 mb-8 text-center">Timeline Sejarah HMTI</h2>
                    
                    @if($about && $about->hasHistoryContent())
                        <div class="relative">
                            <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-teal-200 dark:bg-teal-700"></div>
                            
                            <div class="space-y-8">
                                @foreach($about->history_content as $index => $content)
                                    <div class="relative flex items-start">
                                        <div class="flex-shrink-0 w-8 h-8 bg-teal-600 rounded-full flex items-center justify-center">
                                            <div class="w-3 h-3 bg-white rounded-full"></div>
                                        </div>
                                        <div class="ml-6">
                                            <div class="text-lg font-semibold text-zinc-900 dark:text-zinc-100">Sejarah {{ $index + 1 }}</div>
                                            <p class="text-zinc-600 dark:text-zinc-400 mt-2">{{ $content }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="text-center p-8 bg-zinc-50 dark:bg-zinc-700 rounded-lg">
                            <p class="text-zinc-600 dark:text-zinc-400">Konten sejarah HMTI belum tersedia</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layouts.main>