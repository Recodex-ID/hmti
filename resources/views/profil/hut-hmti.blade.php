<x-layouts.main>
    <div class="min-h-screen bg-zinc-50 dark:bg-zinc-900">
        <!-- Hero Section -->
        <section class="bg-gradient-to-br from-yellow-600 to-orange-600 dark:from-yellow-800 dark:to-orange-800 text-white">
            <div class="container mx-auto px-4 py-16">
                <div class="text-center">
                    <h1 class="text-4xl lg:text-5xl font-bold mb-6">HUT HMTI</h1>
                    <p class="text-yellow-100 text-lg max-w-3xl mx-auto">
                        Perayaan Hari Ulang Tahun HMTI Telkom University
                    </p>
                </div>
            </div>
        </section>

        <!-- Content Section -->
        <div class="container mx-auto px-4 py-12">
            <div class="max-w-4xl mx-auto space-y-8">
                <!-- Header Info -->
                <div class="bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-lg p-8 text-center">
                    <div class="w-24 h-24 bg-yellow-100 dark:bg-yellow-900 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-yellow-600 dark:text-yellow-300" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-zinc-900 dark:text-zinc-100 mb-4">HUT HMTI</h2>
                    <p class="text-zinc-600 dark:text-zinc-400 mb-8 max-w-2xl mx-auto">
                        Merayakan perjalanan HMTI dalam mengembangkan mahasiswa Teknik Industri yang unggul dan berkarakter
                    </p>
                </div>

                <!-- Anniversary Content -->
                @if($about && $about->hasAnniversaryContent())
                    <div class="bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-lg p-8">
                        <h3 class="text-2xl font-bold text-zinc-900 dark:text-zinc-100 mb-6">Sejarah HUT HMTI</h3>
                        <div class="space-y-4">
                            @foreach($about->anniversary_content as $index => $content)
                                <div class="flex items-start gap-4 p-4 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg">
                                    <div class="w-8 h-8 bg-yellow-500 text-white rounded-full flex items-center justify-center text-sm font-bold">
                                        {{ $index + 1 }}
                                    </div>
                                    <p class="text-zinc-700 dark:text-zinc-300 flex-1">{{ $content }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-lg p-8">
                        <div class="text-center p-8 bg-zinc-50 dark:bg-zinc-700 rounded-lg">
                            <p class="text-zinc-600 dark:text-zinc-400">Konten HUT HMTI belum tersedia</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.main>