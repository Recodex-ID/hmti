<div>
    <header class="flex items-center justify-between mb-6">
        <div>
            <flux:heading size="xl">MPM Management</flux:heading>
            <flux:subheading>Kelola konten Majelis Permusyawaratan Mahasiswa untuk berbagai komisi</flux:subheading>
        </div>
        <flux:button wire:click="create" variant="primary" icon="plus">
            Tambah MPM
        </flux:button>
    </header>

    @if (session()->has('message'))
        <flux:callout variant="success" icon="check-circle" heading="{{ session('message') }}" class="mb-6" />
    @endif

    <!-- MPM List -->
    <div class="border border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900 rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-zinc-200 dark:divide-zinc-700">
                <thead class="bg-zinc-50 dark:bg-zinc-800">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Tipe</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Judul</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Content</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Files</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-zinc-900 divide-y divide-zinc-200 dark:divide-zinc-700">
                    @forelse($this->mpms as $mpm)
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <flux:badge size="sm" variant="solid" class="capitalize">
                                    {{ $this->mpmTypes[$mpm->type] }}
                                </flux:badge>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-zinc-900 dark:text-zinc-100">{{ $mpm->title }}</div>
                                <div class="text-sm text-zinc-500 dark:text-zinc-400">
                                    {{ Str::limit($mpm->description, 100) }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($mpm->is_active)
                                    <flux:badge size="sm" variant="solid" class="bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">Aktif</flux:badge>
                                @else
                                    <flux:badge size="sm" variant="solid" class="bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">Tidak Aktif</flux:badge>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($mpm->content && count($mpm->content) > 0)
                                    <span class="text-sm text-zinc-500 dark:text-zinc-400">{{ count($mpm->content) }} item</span>
                                @else
                                    <span class="text-sm text-zinc-400 dark:text-zinc-500">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-2">
                                    @if($mpm->banner_image_url)
                                        <flux:badge size="sm" variant="ghost">Banner</flux:badge>
                                    @endif
                                    @if($mpm->attachment_file_url)
                                        <flux:badge size="sm" variant="ghost">Document</flux:badge>
                                    @endif
                                    @if(!$mpm->banner_image_url && !$mpm->attachment_file_url)
                                        <span class="text-sm text-zinc-400 dark:text-zinc-500">-</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <flux:button size="sm" variant="ghost" wire:click="edit({{ $mpm->id }})">
                                        Edit
                                    </flux:button>
                                    <flux:modal name="delete-mpm-{{ $mpm->id }}">
                                        <div class="space-y-6">
                                            <div>
                                                <flux:heading size="lg">Hapus MPM</flux:heading>
                                                <flux:text>Apakah Anda yakin ingin menghapus MPM "{{ $mpm->title }}"? Tindakan ini tidak dapat dibatalkan.</flux:text>
                                            </div>
                                        </div>

                                        <div class="flex gap-2 mt-6">
                                            <flux:spacer />
                                            <flux:modal.close>
                                                <flux:button variant="ghost">Batal</flux:button>
                                            </flux:modal.close>
                                            <flux:button variant="danger" wire:click="delete({{ $mpm->id }})">Hapus</flux:button>
                                        </div>
                                    </flux:modal>

                                    <flux:modal.trigger name="delete-mpm-{{ $mpm->id }}">
                                        <flux:button size="sm" variant="danger">Hapus</flux:button>
                                    </flux:modal.trigger>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-zinc-500 dark:text-zinc-400">
                                Belum ada data MPM. <a href="#" wire:click="create" class="text-indigo-600 hover:text-indigo-500">Buat sekarang</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $this->mpms->links('custom.pagination') }}
    </div>

    <!-- Create/Edit Modal -->
    <flux:modal name="mpm-modal" variant="flyout" :show="$showModal">
        <form wire:submit.prevent="save">
            <div class="flex items-center justify-between mb-6">
                <flux:heading size="lg">
                    {{ $editingMpmId ? 'Edit MPM' : 'Tambah MPM' }}
                </flux:heading>
                <flux:button wire:click="resetForm" variant="ghost" size="sm" icon="x-mark" />
            </div>

            <div class="space-y-6">
                <flux:field>
                    <flux:label>Tipe MPM</flux:label>
                    <flux:select wire:model="type" placeholder="Pilih tipe MPM">
                        @foreach($this->mpmTypes as $key => $label)
                            <flux:select.option value="{{ $key }}">{{ $label }}</flux:select.option>
                        @endforeach
                    </flux:select>
                    <flux:error name="type" />
                </flux:field>

                <flux:field>
                    <flux:label>Judul</flux:label>
                    <flux:input wire:model="title" placeholder="Masukkan judul MPM" />
                    <flux:error name="title" />
                </flux:field>

                <flux:field>
                    <flux:label>Deskripsi</flux:label>
                    <flux:textarea wire:model="description" rows="4" placeholder="Masukkan deskripsi MPM" />
                    <flux:error name="description" />
                </flux:field>

                <flux:field>
                    <flux:checkbox wire:model="is_active" label="Status Aktif" />
                </flux:field>

                <!-- Dynamic Content -->
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <flux:subheading>Konten Tambahan</flux:subheading>
                    </div>

                    @if(!empty($content))
                        <div class="space-y-3">
                            @foreach($content as $index => $item)
                                <div class="p-4 border border-zinc-200 dark:border-zinc-700 rounded-lg bg-zinc-50 dark:bg-zinc-900">
                                    <div class="flex items-start justify-between mb-2">
                                        <flux:subheading size="sm">{{ $item['title'] ?: 'Konten ' . ($index + 1) }}</flux:subheading>
                                        <flux:button type="button" size="sm" variant="danger" wire:click="removeContent({{ $index }})">
                                            Hapus
                                        </flux:button>
                                    </div>
                                    <flux:text class="text-sm">{{ Str::limit($item['description'], 100) }}</flux:text>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div class="p-4 border border-zinc-200 dark:border-zinc-700 rounded-lg bg-zinc-50 dark:bg-zinc-900">
                        <flux:subheading size="sm" class="mb-3">Tambah Konten Baru</flux:subheading>
                        <div class="space-y-3">
                            <flux:field>
                                <flux:label>Judul Konten</flux:label>
                                <flux:input wire:model="contentTitle" placeholder="Masukkan judul konten" />
                                <flux:error name="contentTitle" />
                            </flux:field>
                            <flux:field>
                                <flux:label>Isi Konten</flux:label>
                                <flux:textarea wire:model="contentDescription" rows="3" placeholder="Masukkan isi konten" />
                                <flux:error name="contentDescription" />
                            </flux:field>
                            <flux:button type="button" size="sm" wire:click="addContent">
                                Tambah Konten
                            </flux:button>
                        </div>
                    </div>
                </div>

                <!-- File Uploads -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <flux:field>
                        <flux:label>Banner Image</flux:label>
                        <flux:input type="file" wire:model="banner_image" accept="image/*" />
                        <flux:error name="banner_image" />
                        @if($editingMpmId)
                            @php
                                $existingMpm = App\Models\Mpm::find($editingMpmId);
                            @endphp
                            @if($existingMpm?->banner_image_url)
                                <div class="mt-2">
                                    <img src="{{ $existingMpm->banner_image_url }}" alt="Current Banner" class="w-20 h-20 rounded-lg object-cover">
                                    <flux:text size="sm" class="text-zinc-500 mt-1">Banner saat ini</flux:text>
                                </div>
                            @endif
                        @endif
                    </flux:field>

                    <flux:field>
                        <flux:label>File Lampiran</flux:label>
                        <flux:input type="file" wire:model="attachment_file" accept=".pdf,.doc,.docx" />
                        <flux:error name="attachment_file" />
                        @if($editingMpmId)
                            @php
                                $existingMpm = App\Models\Mpm::find($editingMpmId);
                            @endphp
                            @if($existingMpm?->attachment_file_url)
                                <div class="mt-2">
                                    <a href="{{ $existingMpm->attachment_file_url }}" target="_blank" class="text-blue-600 hover:underline text-sm">
                                        Lihat file saat ini
                                    </a>
                                </div>
                            @endif
                        @endif
                    </flux:field>
                </div>

                <div class="flex gap-2 pt-6">
                    <flux:spacer />
                    <flux:button type="button" variant="ghost" wire:click="resetForm">
                        Batal
                    </flux:button>
                    <flux:button type="submit" variant="primary">
                        {{ $editingMpmId ? 'Perbarui' : 'Simpan' }}
                    </flux:button>
                </div>
            </div>
        </form>
    </flux:modal>
</div>