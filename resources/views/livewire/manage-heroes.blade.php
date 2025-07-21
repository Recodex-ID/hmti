<div>
    <header class="flex items-center justify-between mb-6">
        <div>
            <flux:heading size="xl">Hero Section</flux:heading>
            <flux:subheading>Kelola konten hero di halaman utama</flux:subheading>
        </div>

        <flux:button wire:click="create" variant="primary" icon="plus">
            Buat
        </flux:button>
    </header>

    @if (session()->has('message'))
        <flux:callout variant="success" icon="check-circle" heading="{{ session('message') }}" class="mb-6" />
    @endif

    <div class="border border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900 rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-zinc-200 dark:divide-zinc-700">
                <thead class="bg-zinc-50 dark:bg-zinc-800">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Gambar</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Judul</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Subjudul</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Aksi</th>
                </tr>
                </thead>
                <tbody class="bg-white dark:bg-zinc-900 divide-y divide-zinc-200 dark:divide-zinc-700">
                @forelse ($this->heroes as $hero)
                    <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-zinc-900 dark:text-zinc-100">
                            @if($hero->image)
                                <img src="{{ $hero->image_url }}" alt="{{ $hero->title }}" class="w-16 h-10 rounded-lg object-cover">
                            @else
                                <div class="w-16 h-10 bg-zinc-200 dark:bg-zinc-700 rounded-lg flex items-center justify-center">
                                    <flux:icon name="photo" class="w-5 h-5 text-zinc-400" />
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-zinc-900 dark:text-zinc-100">{{ $hero->title }}</td>
                        <td class="px-6 py-4 text-sm text-zinc-500 dark:text-zinc-400 max-w-xs truncate">
                            {{ $hero->subtitle }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <flux:button wire:click="edit({{ $hero->id }})" size="sm" variant="primary" color="blue" icon="pencil" />
                                <flux:modal.trigger name="delete-hero-{{ $hero->id }}">
                                    <flux:button size="sm" variant="primary" color="red" icon="trash" />
                                </flux:modal.trigger>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-zinc-500 dark:text-zinc-400">
                            Tidak ada hero ditemukan
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $this->heroes->links('custom.pagination') }}
    </div>

    <!-- Modal Form -->
    <flux:modal wire:model.self="showModal" name="hero-form" class="min-w-2xl max-w-3xl" wire:close="resetForm">
        <form wire:submit.prevent="save">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">
                        {{ $editingHeroId ? 'Edit Hero' : 'Tambah Hero Baru' }}
                    </flux:heading>
                    <flux:text class="mt-2">
                        {{ $editingHeroId ? 'Ubah konten hero section.' : 'Buat konten hero section baru.' }}
                    </flux:text>
                </div>

                <flux:field>
                    <flux:label>Judul</flux:label>
                    <flux:input wire:model="title" placeholder="Masukkan judul hero..." />
                    <flux:error name="title" />
                </flux:field>

                <flux:field>
                    <flux:label>Subjudul</flux:label>
                    <flux:input wire:model="subtitle" placeholder="Masukkan subjudul hero..." />
                    <flux:error name="subtitle" />
                    <flux:description>
                        Subjudul yang menjelaskan lebih detail tentang konten hero
                    </flux:description>
                </flux:field>

                <flux:field>
                    <flux:label>Gambar Hero</flux:label>
                    <flux:input type="file" wire:model="image" accept="image/*" />
                    <flux:error name="image" />
                    <flux:description>
                        Upload gambar hero (maksimal 2MB, format: JPG, PNG, GIF)
                    </flux:description>
                    @if($image)
                        <div class="mt-2">
                            <img src="{{ $image->temporaryUrl() }}" alt="Preview" class="w-20 h-20 rounded-lg object-cover">
                        </div>
                    @elseif($editingHeroId)
                        @php
                            $existingHero = App\Models\Hero::find($editingHeroId);
                        @endphp
                        @if($existingHero?->image)
                            <div class="mt-2">
                                <img src="{{ $existingHero->image_url }}" alt="Current Image" class="w-20 h-20 rounded-lg object-cover">
                                <flux:text size="sm" class="text-zinc-500 mt-1">Gambar saat ini</flux:text>
                            </div>
                        @endif
                    @endif
                </flux:field>

                <div class="flex gap-2">
                    <flux:spacer />

                    <flux:modal.close>
                        <flux:button variant="ghost">Batal</flux:button>
                    </flux:modal.close>

                    <flux:button type="submit" variant="primary">
                        {{ $editingHeroId ? 'Perbarui' : 'Simpan' }}
                    </flux:button>
                </div>
            </div>
        </form>
    </flux:modal>

    <!-- Delete Confirmation Modals -->
    @foreach ($this->heroes as $hero)
        <flux:modal name="delete-hero-{{ $hero->id }}" class="min-w-[22rem]">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Hapus Hero?</flux:heading>
                    <flux:text class="mt-2">
                        <p>Anda akan menghapus hero "{{ $hero->title }}".</p>
                        <p>Tindakan ini tidak dapat dibatalkan.</p>
                    </flux:text>
                </div>

                <div class="flex gap-2">
                    <flux:spacer />

                    <flux:modal.close>
                        <flux:button variant="ghost">Batal</flux:button>
                    </flux:modal.close>

                    <flux:button wire:click="delete({{ $hero->id }})" variant="danger">
                        Hapus
                    </flux:button>
                </div>
            </div>
        </flux:modal>
    @endforeach
</div>
