<x-layouts.main title="Home | HMTI Telkom University">
    <!-- Hero Section with Carousel -->
    <div x-data="{
    activeSlide: 0,
    slides: [
        {
            image: '{{ asset('images/gedung.jpg') }}',
            title: 'Industrial Engineering Student Association',
            subtitle: 'Building the future engineers of tomorrow'
        },
        {
            image: 'https://picsum.photos/id/2/1920/1080',
            title: 'Join Our Community',
            subtitle: 'Connect with fellow students and industry professionals'
        },
        {
            image: 'https://picsum.photos/id/3/1920/1080',
            title: 'Excellence in Engineering',
            subtitle: 'Developing skills, knowledge, and innovation'
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

    <!-- Video Profil Section -->
    <section class="py-8 md:py-12 lg:py-16 bg-zinc-900">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="mb-12 text-center">
                <h2 class="text-4xl font-bold text-zinc-50 mb-4">Watch Our Video</h2>
                <p class="text-2xl text-zinc-50/90 max-w-2xl mx-auto">Learn about our association's history, mission, and impact on industrial engineering students.</p>
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
                        <span class="whitespace-nowrap">Subscribe to our YouTube channel</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-layouts.main>
