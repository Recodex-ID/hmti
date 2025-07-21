<div>
    <header class="flex items-center justify-between mb-6">
        <div>
            <flux:heading size="xl">Community & Committee</flux:heading>
            <flux:subheading>Kelola community dan committee himpunan</flux:subheading>
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
                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Logo</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Deskripsi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Kategori</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Aksi</th>
                </tr>
                </thead>
                <tbody class="bg-white dark:bg-zinc-900 divide-y divide-zinc-200 dark:divide-zinc-700">
                @forelse ($this->communities as $community)
                    <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-zinc-900 dark:text-zinc-100">
                            @if($community->logo)
                                <img src="{{ $community->logo_url }}" alt="{{ $community->title }}" class="w-10 h-10 rounded-lg object-cover">
                            @else
                                <div class="w-10 h-10 bg-zinc-200 dark:bg-zinc-700 rounded-lg flex items-center justify-center">
                                    <flux:icon name="user-group" class="w-5 h-5 text-zinc-400" />
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-zinc-900 dark:text-zinc-100">{{ $community->title }}</td>
                        <td class="px-6 py-4 text-sm text-zinc-500 dark:text-zinc-400 max-w-xs truncate">
                            {{ $community->description ?? '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-500 dark:text-zinc-400">
                            <flux:badge
                                variant="primary"
                                size="sm"
                                color="{{ $community->category === 'Community' ? 'green' : 'purple' }}"
                            >
                                {{ $community->category }}
                            </flux:badge>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <flux:button wire:click="edit({{ $community->id }})" size="sm" variant="primary" color="blue" icon="pencil" />
                                <flux:modal.trigger name="delete-community-{{ $community->id }}">
                                    <flux:button size="sm" variant="primary" color="red" icon="trash" />
                                </flux:modal.trigger>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-zinc-500 dark:text-zinc-400">
                            Tidak ada community ditemukan
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $this->communities->links('custom.pagination') }}
    </div>

    <!-- Modal Form -->
    <flux:modal wire:model.self="showModal" name="community-form" class="min-w-2xl max-w-3xl" wire:close="resetForm">
        <form wire:submit.prevent="save">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">
                        {{ $editingCommunityId ? 'Edit Community' : 'Tambah Community Baru' }}
                    </flux:heading>
                    <flux:text class="mt-2">
                        {{ $editingCommunityId ? 'Ubah informasi community.' : 'Buat community baru dengan informasi yang lengkap.' }}
                    </flux:text>
                </div>

                <flux:field>
                    <flux:label>Nama Community</flux:label>
                    <flux:input wire:model="title" placeholder="Masukkan nama community..." />
                    <flux:error name="title" />
                </flux:field>

                <flux:field>
                    <flux:label>Deskripsi</flux:label>
                    <flux:textarea wire:model="description" placeholder="Masukkan deskripsi community..." rows="3" />
                    <flux:error name="description" />
                    <flux:description>
                        Deskripsi singkat tentang community (opsional)
                    </flux:description>
                </flux:field>

                <flux:field>
                    <flux:label>Kategori</flux:label>
                    <flux:select wire:model="category" placeholder="Pilih kategori...">
                        @foreach ($this->categories as $categoryOption)
                            <flux:select.option value="{{ $categoryOption }}">{{ $categoryOption }}</flux:select.option>
                        @endforeach
                    </flux:select>
                    <flux:error name="category" />
                    <flux:description>
                        Pilih kategori community atau committee
                    </flux:description>
                </flux:field>

                <flux:field>
                    <flux:label>Logo Community</flux:label>
                    <flux:input type="file" wire:model="logo" accept="image/*" />
                    <flux:error name="logo" />
                    <flux:description>
                        Upload logo community (maksimal 2MB, format: JPG, PNG, GIF)
                    </flux:description>
                    @if($logo)
                        <div class="mt-2">
                            <img src="{{ $logo->temporaryUrl() }}" alt="Preview" class="w-20 h-20 rounded-lg object-cover">
                        </div>
                    @elseif($editingCommunityId)
                        @php
                            $existingCommunity = App\Models\Community::find($editingCommunityId);
                        @endphp
                        @if($existingCommunity?->logo)
                            <div class="mt-2">
                                <img src="{{ $existingCommunity->logo_url }}" alt="Current Logo" class="w-20 h-20 rounded-lg object-cover">
                                <flux:text size="sm" class="text-zinc-500 mt-1">Logo saat ini</flux:text>
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
                        {{ $editingCommunityId ? 'Perbarui' : 'Simpan' }}
                    </flux:button>
                </div>
            </div>
        </form>
    </flux:modal>

    <!-- Delete Confirmation Modals -->
    @foreach ($this->communities as $community)
        <flux:modal name="delete-community-{{ $community->id }}" class="min-w-[22rem]">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Hapus Community?</flux:heading>
                    <flux:text class="mt-2">
                        <p>Anda akan menghapus community "{{ $community->title }}" dari kategori {{ $community->category }}.</p>
                        <p>Tindakan ini tidak dapat dibatalkan.</p>
                    </flux:text>
                </div>

                <div class="flex gap-2">
                    <flux:spacer />

                    <flux:modal.close>
                        <flux:button variant="ghost">Batal</flux:button>
                    </flux:modal.close>

                    <flux:button wire:click="delete({{ $community->id }})" variant="danger">
                        Hapus
                    </flux:button>
                </div>
            </div>
        </flux:modal>
    @endforeach
</div>
