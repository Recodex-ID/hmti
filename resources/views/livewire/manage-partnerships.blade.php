<div>
    <header class="flex items-center justify-between mb-6">
        <div>
            <flux:heading size="xl">Partnership Management</flux:heading>
            <flux:subheading>Kelola konten partnership untuk berbagai jenis kerjasama</flux:subheading>
        </div>
        <flux:button wire:click="create" variant="primary" icon="plus">
            Tambah Partnership
        </flux:button>
    </header>

    @if (session()->has('message'))
        <flux:callout variant="success" icon="check-circle" heading="{{ session('message') }}" class="mb-6" />
    @endif

    <!-- Partnership List -->
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
                    @forelse($this->partnerships as $partnership)
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <flux:badge size="sm" variant="solid" class="capitalize">
                                    {{ $partnership->formatted_type }}
                                </flux:badge>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-zinc-900 dark:text-zinc-100">{{ $partnership->title }}</div>
                                <div class="text-sm text-zinc-500 dark:text-zinc-400">
                                    {{ Str::limit($partnership->description, 100) }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($partnership->is_active)
                                    <flux:badge size="sm" variant="solid" class="bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">Aktif</flux:badge>
                                @else
                                    <flux:badge size="sm" variant="solid" class="bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">Tidak Aktif</flux:badge>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($partnership->content && count($partnership->content) > 0)
                                    <span class="text-sm text-zinc-500 dark:text-zinc-400">{{ count($partnership->content) }} item</span>
                                @else
                                    <span class="text-sm text-zinc-400 dark:text-zinc-500">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-2">
                                    @if($partnership->banner_url)
                                        <flux:badge size="sm" variant="ghost">Banner</flux:badge>
                                    @endif
                                    @if($partnership->document_url)
                                        <flux:badge size="sm" variant="ghost">Document</flux:badge>
                                    @endif
                                    @if(!$partnership->banner_url && !$partnership->document_url)
                                        <span class="text-sm text-zinc-400 dark:text-zinc-500">-</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <flux:button size="sm" variant="ghost" wire:click="edit({{ $partnership->id }})">
                                        Edit
                                    </flux:button>
                                    <flux:modal name="delete-partnership-{{ $partnership->id }}">
                                        <div class="space-y-6">
                                            <div>
                                                <flux:heading size="lg">Hapus Partnership</flux:heading>
                                                <flux:text>Apakah Anda yakin ingin menghapus partnership "{{ $partnership->title }}"? Tindakan ini tidak dapat dibatalkan.</flux:text>
                                            </div>
                                        </div>

                                        <div class="flex gap-2 mt-6">
                                            <flux:spacer />
                                            <flux:modal.close>
                                                <flux:button variant="ghost">Batal</flux:button>
                                            </flux:modal.close>
                                            <flux:button variant="danger" wire:click="delete({{ $partnership->id }})">Hapus</flux:button>
                                        </div>
                                    </flux:modal>

                                    <flux:modal.trigger name="delete-partnership-{{ $partnership->id }}">
                                        <flux:button size="sm" variant="danger">Hapus</flux:button>
                                    </flux:modal.trigger>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-zinc-500 dark:text-zinc-400">
                                Belum ada data partnership. <a href="#" wire:click="create" class="text-indigo-600 hover:text-indigo-500">Buat sekarang</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $this->partnerships->links('custom.pagination') }}
    </div>

    <!-- Create/Edit Modal -->
    <flux:modal name="partnership-modal" variant="flyout" :show="$showModal">
        <form wire:submit.prevent="save">
            <div class="flex items-center justify-between mb-6">
                <flux:heading size="lg">
                    {{ $editingPartnershipId ? 'Edit Partnership' : 'Tambah Partnership' }}
                </flux:heading>
                <flux:button wire:click="resetForm" variant="ghost" size="sm" icon="x-mark" />
            </div>

            <div class="space-y-6">
                <flux:field>
                    <flux:label>Tipe Partnership</flux:label>
                    <flux:select wire:model="type" placeholder="Pilih tipe partnership">
                        @foreach($this->partnershipTypes as $key => $label)
                            <flux:select.option value="{{ $key }}">{{ $label }}</flux:select.option>
                        @endforeach
                    </flux:select>
                    <flux:error name="type" />
                </flux:field>

                <flux:field>
                    <flux:label>Judul</flux:label>
                    <flux:input wire:model="title" placeholder="Masukkan judul partnership" />
                    <flux:error name="title" />
                </flux:field>

                <flux:field>
                    <flux:label>Deskripsi</flux:label>
                    <flux:textarea wire:model="description" rows="4" placeholder="Masukkan deskripsi partnership" />
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
                                        <flux:text class="text-sm">{{ Str::limit($item, 100) }}</flux:text>
                                        <flux:button type="button" size="sm" variant="danger" wire:click="removeContent({{ $index }})">
                                            Hapus
                                        </flux:button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div class="p-4 border border-zinc-200 dark:border-zinc-700 rounded-lg bg-zinc-50 dark:bg-zinc-900">
                        <flux:subheading size="sm" class="mb-3">Tambah Konten Baru</flux:subheading>
                        <div class="flex gap-2">
                            <flux:input wire:model="contentInput" placeholder="Masukkan konten baru" class="flex-1" />
                            <flux:button type="button" size="sm" wire:click="addContent">
                                Tambah
                            </flux:button>
                        </div>
                        <flux:error name="contentInput" />
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <flux:subheading>Informasi Kontak</flux:subheading>
                    </div>

                    @if(!empty($contact_info))
                        <div class="space-y-3">
                            @foreach($contact_info as $index => $contact)
                                <div class="p-4 border border-zinc-200 dark:border-zinc-700 rounded-lg bg-zinc-50 dark:bg-zinc-900">
                                    <div class="flex items-start justify-between mb-2">
                                        <div>
                                            @if($contact['name'])
                                                <flux:text class="font-medium">{{ $contact['name'] }}</flux:text>
                                            @endif
                                            @if($contact['email'])
                                                <flux:text class="text-sm text-zinc-500">{{ $contact['email'] }}</flux:text>
                                            @endif
                                            @if($contact['phone'])
                                                <flux:text class="text-sm text-zinc-500">{{ $contact['phone'] }}</flux:text>
                                            @endif
                                        </div>
                                        <flux:button type="button" size="sm" variant="danger" wire:click="removeContact({{ $index }})">
                                            Hapus
                                        </flux:button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div class="p-4 border border-zinc-200 dark:border-zinc-700 rounded-lg bg-zinc-50 dark:bg-zinc-900">
                        <flux:subheading size="sm" class="mb-3">Tambah Kontak Baru</flux:subheading>
                        <div class="space-y-3">
                            <flux:input wire:model="contactName" placeholder="Nama kontak" />
                            <flux:input wire:model="contactEmail" placeholder="Email kontak" type="email" />
                            <flux:input wire:model="contactPhone" placeholder="Nomor telepon" />
                            <flux:button type="button" size="sm" wire:click="addContact">
                                Tambah Kontak
                            </flux:button>
                        </div>
                        <flux:error name="contactName" />
                        <flux:error name="contactEmail" />
                        <flux:error name="contactPhone" />
                    </div>
                </div>

                <!-- File Uploads -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <flux:field>
                        <flux:label>Banner Image</flux:label>
                        <flux:input type="file" wire:model="banner" accept="image/*" />
                        <flux:error name="banner" />
                        @if($editingPartnershipId)
                            @php
                                $existingPartnership = App\Models\Partnership::find($editingPartnershipId);
                            @endphp
                            @if($existingPartnership?->banner_url)
                                <div class="mt-2">
                                    <img src="{{ $existingPartnership->banner_url }}" alt="Current Banner" class="w-20 h-20 rounded-lg object-cover">
                                    <flux:text size="sm" class="text-zinc-500 mt-1">Banner saat ini</flux:text>
                                </div>
                            @endif
                        @endif
                    </flux:field>

                    <flux:field>
                        <flux:label>Dokumen</flux:label>
                        <flux:input type="file" wire:model="document" accept=".pdf,.doc,.docx" />
                        <flux:error name="document" />
                        @if($editingPartnershipId)
                            @php
                                $existingPartnership = App\Models\Partnership::find($editingPartnershipId);
                            @endphp
                            @if($existingPartnership?->document_url)
                                <div class="mt-2">
                                    <a href="{{ $existingPartnership->document_url }}" target="_blank" class="text-blue-600 hover:underline text-sm">
                                        Lihat dokumen saat ini
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
                        {{ $editingPartnershipId ? 'Perbarui' : 'Simpan' }}
                    </flux:button>
                </div>
            </div>
        </form>
    </flux:modal>
</div>