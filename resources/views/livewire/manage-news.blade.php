<div>
    <header class="flex items-center justify-between mb-6">
        <div>
            <flux:heading size="xl">Berita</flux:heading>
            <flux:subheading>Kelola berita dan artikel himpunan</flux:subheading>
        </div>

        <flux:button wire:click="create" variant="primary" icon="plus">
            Buat
        </flux:button>
    </header>

    @if (session()->has('message'))
        <flux:callout variant="success" icon="check-circle" heading="{{ session('message') }}" class="mb-6" />
    @endif

    <div class="mb-6">
        <flux:input wire:model.live.debounce.300ms="search" placeholder="Cari berita..." icon="magnifying-glass" />
    </div>

    <div class="border border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900 rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-zinc-200 dark:divide-zinc-700">
                <thead class="bg-zinc-50 dark:bg-zinc-800">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Gambar</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Judul</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Kategori</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Views</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Aksi</th>
                </tr>
                </thead>
                <tbody class="bg-white dark:bg-zinc-900 divide-y divide-zinc-200 dark:divide-zinc-700">
                @forelse ($this->news as $newsItem)
                    <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-zinc-900 dark:text-zinc-100">
                            @if($newsItem->featured_image)
                                <img src="{{ Storage::url($newsItem->featured_image) }}" alt="{{ $newsItem->title }}" class="w-16 h-10 rounded-lg object-cover">
                            @else
                                <div class="w-16 h-10 bg-zinc-200 dark:bg-zinc-700 rounded-lg flex items-center justify-center">
                                    <flux:icon name="photo" class="w-5 h-5 text-zinc-400" />
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-zinc-900 dark:text-zinc-100 max-w-xs">
                            <div class="truncate">
                                {{ $newsItem->title }}
                                @if($newsItem->is_featured)
                                    <flux:badge color="yellow" size="sm" class="ml-1">Featured</flux:badge>
                                @endif
                            </div>
                            <div class="text-xs text-zinc-500 dark:text-zinc-400 truncate">{{ $newsItem->excerpt }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <flux:badge color="blue" size="sm">{{ $newsItem->category }}</flux:badge>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($newsItem->is_published)
                                <flux:badge color="green" size="sm">Published</flux:badge>
                            @else
                                <flux:badge color="gray" size="sm">Draft</flux:badge>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-500 dark:text-zinc-400">
                            {{ number_format($newsItem->views_count) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-500 dark:text-zinc-400">
                            <div>{{ $newsItem->published_at?->format('d M Y') ?? '-' }}</div>
                            <div class="text-xs">{{ $newsItem->author?->name ?? '-' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <flux:button wire:click="edit({{ $newsItem->id }})" size="sm" variant="primary" color="blue" icon="pencil" />
                                <flux:modal.trigger name="delete-news-{{ $newsItem->id }}">
                                    <flux:button size="sm" variant="primary" color="red" icon="trash" />
                                </flux:modal.trigger>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-zinc-500 dark:text-zinc-400">
                            Tidak ada berita ditemukan
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $this->news->links('custom.pagination') }}
    </div>

    <!-- Modal Form -->
    <flux:modal wire:model.self="showModal" name="news-form" class="min-w-2xl max-w-5xl max-h-[90vh] overflow-y-auto" wire:close="resetForm">
        <form wire:submit.prevent="save">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">
                        {{ $editingNewsId ? 'Edit Berita' : 'Tambah Berita Baru' }}
                    </flux:heading>
                    <flux:text class="mt-2">
                        {{ $editingNewsId ? 'Ubah informasi berita.' : 'Buat berita baru.' }}
                    </flux:text>
                </div>

                <flux:field>
                    <flux:label>Judul Berita</flux:label>
                    <flux:input wire:model="title" placeholder="Masukkan judul berita..." />
                    <flux:error name="title" />
                </flux:field>

                <flux:field>
                    <flux:label>Ringkasan</flux:label>
                    <flux:textarea wire:model="excerpt" placeholder="Masukkan ringkasan berita..." rows="3" />
                    <flux:error name="excerpt" />
                    <flux:description>
                        Ringkasan singkat yang akan ditampilkan di halaman utama dan daftar berita
                    </flux:description>
                </flux:field>

                <flux:field>
                    <flux:label>Konten Berita</flux:label>
                    <flux:textarea wire:model="content" placeholder="Masukkan konten lengkap berita..." rows="8" />
                    <flux:error name="content" />
                </flux:field>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <flux:field>
                        <flux:label>Kategori</flux:label>
                        <flux:select wire:model="category">
                            <flux:select.option value="">Pilih Kategori</flux:select.option>
                            @foreach($this->categories as $categoryOption)
                                <flux:select.option value="{{ $categoryOption }}">{{ $categoryOption }}</flux:select.option>
                            @endforeach
                        </flux:select>
                        <flux:error name="category" />
                    </flux:field>

                    <flux:field>
                        <flux:label>Tanggal Publikasi</flux:label>
                        <flux:input type="datetime-local" wire:model="published_at" />
                        <flux:error name="published_at" />
                    </flux:field>
                </div>

                <flux:field>
                    <flux:label>Tags</flux:label>
                    <flux:input wire:model="tags" placeholder="Contoh: teknologi, mahasiswa, kompetisi" />
                    <flux:error name="tags" />
                    <flux:description>
                        Pisahkan tags dengan koma. Contoh: teknologi, mahasiswa, kompetisi
                    </flux:description>
                </flux:field>

                <flux:field>
                    <flux:label>Gambar Featured</flux:label>
                    <flux:input type="file" wire:model="featured_image" accept="image/*" />
                    <flux:error name="featured_image" />
                    <flux:description>
                        Upload gambar utama berita (maksimal 2MB, format: JPG, PNG, GIF)
                    </flux:description>
                    @if($featured_image)
                        <div class="mt-2">
                            <img src="{{ $featured_image->temporaryUrl() }}" alt="Preview" class="w-32 h-20 rounded-lg object-cover">
                        </div>
                    @elseif($editingNewsId)
                        @php
                            $existingNews = App\Models\News::find($editingNewsId);
                        @endphp
                        @if($existingNews?->featured_image)
                            <div class="mt-2">
                                <img src="{{ Storage::url($existingNews->featured_image) }}" alt="Current Image" class="w-32 h-20 rounded-lg object-cover">
                                <flux:text size="sm" class="text-zinc-500 mt-1">Gambar saat ini</flux:text>
                            </div>
                        @endif
                    @endif
                </flux:field>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <flux:field>
                        <flux:checkbox wire:model="is_featured">Berita Featured</flux:checkbox>
                        <flux:error name="is_featured" />
                        <flux:description>
                            Berita featured akan ditampilkan di bagian utama website
                        </flux:description>
                    </flux:field>

                    <flux:field>
                        <flux:checkbox wire:model="is_published">Status Published</flux:checkbox>
                        <flux:error name="is_published" />
                        <flux:description>
                            Berita yang dipublish akan tampil di website publik
                        </flux:description>
                    </flux:field>
                </div>

                <div class="flex gap-2">
                    <flux:spacer />

                    <flux:modal.close>
                        <flux:button variant="ghost">Batal</flux:button>
                    </flux:modal.close>

                    <flux:button type="submit" variant="primary">
                        {{ $editingNewsId ? 'Perbarui' : 'Simpan' }}
                    </flux:button>
                </div>
            </div>
        </form>
    </flux:modal>

    <!-- Delete Confirmation Modals -->
    @foreach ($this->news as $newsItem)
        <flux:modal name="delete-news-{{ $newsItem->id }}" class="min-w-[22rem]">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Hapus Berita?</flux:heading>
                    <flux:text class="mt-2">
                        <p>Anda akan menghapus berita "{{ $newsItem->title }}".</p>
                        <p>Tindakan ini tidak dapat dibatalkan.</p>
                    </flux:text>
                </div>

                <div class="flex gap-2">
                    <flux:spacer />

                    <flux:modal.close>
                        <flux:button variant="ghost">Batal</flux:button>
                    </flux:modal.close>

                    <flux:button wire:click="delete({{ $newsItem->id }})" variant="danger">
                        Hapus
                    </flux:button>
                </div>
            </div>
        </flux:modal>
    @endforeach
</div>
