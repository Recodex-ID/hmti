<div>
    <header class="flex items-center justify-between mb-6">
        <div>
            <flux:heading size="xl">Pengurus Inti</flux:heading>
            <flux:subheading>Kelola pengurus inti himpunan</flux:subheading>
        </div>

        @if(false)
            <flux:button wire:click="create" variant="primary" icon="plus">
                Buat
            </flux:button>
        @endif
    </header>

    @if (session()->has('message'))
        <flux:callout variant="success" icon="check-circle" heading="{{ session('message') }}" class="mb-6" />
    @endif

    <div class="mb-6">
        <flux:input wire:model.live.debounce.300ms="search" placeholder="Cari pengurus..." icon="magnifying-glass" />
    </div>

    <div class="border border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900 rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-zinc-200 dark:divide-zinc-700">
                <thead class="bg-zinc-50 dark:bg-zinc-800">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Foto</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Jabatan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Aksi</th>
                </tr>
                </thead>
                <tbody class="bg-white dark:bg-zinc-900 divide-y divide-zinc-200 dark:divide-zinc-700">
                @forelse ($this->cores as $core)
                    <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-zinc-900 dark:text-zinc-100">
                            @if($core->photo)
                                <img src="{{ $core->photo_url }}" alt="{{ $core->name }}" class="w-12 h-12 rounded-full object-cover">
                            @else
                                <div class="w-12 h-12 bg-zinc-200 dark:bg-zinc-700 rounded-full flex items-center justify-center">
                                    <span class="text-sm font-medium text-zinc-600 dark:text-zinc-300">{{ $core->initials }}</span>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-zinc-900 dark:text-zinc-100">{{ $core->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-500 dark:text-zinc-400">
                            <flux:badge
                                variant="primary"
                                size="sm"
                                color="{{ $core->isChairman() ? 'red' : ($core->isViceChairman() ? 'orange' : ($core->isSecretary() ? 'blue' : 'green')) }}"
                            >
                                {{ $core->position }}
                            </flux:badge>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <flux:button wire:click="edit({{ $core->id }})" size="sm" variant="primary" color="blue" icon="pencil" />
                                @if(false)
                                    <flux:modal.trigger name="delete-core-{{ $core->id }}">
                                        <flux:button size="sm" variant="primary" color="red" icon="trash" />
                                    </flux:modal.trigger>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-zinc-500 dark:text-zinc-400">
                            Tidak ada pengurus ditemukan
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $this->cores->links('custom.pagination') }}
    </div>

    <!-- Modal Form -->
    <flux:modal wire:model.self="showModal" name="core-form" class="min-w-2xl max-w-3xl" wire:close="resetForm">
        <form wire:submit.prevent="save">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">
                        {{ $editingCoreId ? 'Edit Pengurus' : 'Tambah Pengurus Baru' }}
                    </flux:heading>
                    <flux:text class="mt-2">
                        {{ $editingCoreId ? 'Ubah informasi pengurus.' : 'Buat pengurus baru dengan informasi yang lengkap.' }}
                    </flux:text>
                </div>

                <flux:field>
                    <flux:label>Nama Pengurus</flux:label>
                    <flux:input wire:model="name" placeholder="Masukkan nama pengurus..." />
                    <flux:error name="name" />
                </flux:field>

                <flux:field>
                    <flux:label>Jabatan</flux:label>
                    <flux:select wire:model="position" placeholder="Pilih jabatan...">
                        @foreach ($this->positions as $positionOption)
                            <flux:select.option value="{{ $positionOption }}">{{ $positionOption }}</flux:select.option>
                        @endforeach
                    </flux:select>
                    <flux:error name="position" />
                    <flux:description>
                        Pilih jabatan pengurus inti
                    </flux:description>
                </flux:field>

                <flux:field>
                    <flux:label>Foto Pengurus</flux:label>
                    <flux:input type="file" wire:model="photo" accept="image/*" />
                    <flux:error name="photo" />
                    <flux:description>
                        Upload foto pengurus (maksimal 2MB, format: JPG, PNG, GIF)
                    </flux:description>
                    @if($photo)
                        <div class="mt-2">
                            <img src="{{ $photo->temporaryUrl() }}" alt="Preview" class="w-20 h-20 rounded-full object-cover">
                        </div>
                    @elseif($editingCoreId)
                        @php
                            $existingCore = App\Models\Core::find($editingCoreId);
                        @endphp
                        @if($existingCore?->photo)
                            <div class="mt-2">
                                <img src="{{ $existingCore->photo_url }}" alt="Current Photo" class="w-20 h-20 rounded-full object-cover">
                                <flux:text size="sm" class="text-zinc-500 mt-1">Foto saat ini</flux:text>
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
                        {{ $editingCoreId ? 'Perbarui' : 'Simpan' }}
                    </flux:button>
                </div>
            </div>
        </form>
    </flux:modal>

    <!-- Delete Confirmation Modals -->
    @foreach ($this->cores as $core)
        <flux:modal name="delete-core-{{ $core->id }}" class="min-w-[22rem]">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Hapus Pengurus?</flux:heading>
                    <flux:text class="mt-2">
                        <p>Anda akan menghapus pengurus "{{ $core->name }}" dengan jabatan {{ $core->position }}.</p>
                        <p>Tindakan ini tidak dapat dibatalkan.</p>
                    </flux:text>
                </div>

                <div class="flex gap-2">
                    <flux:spacer />

                    <flux:modal.close>
                        <flux:button variant="ghost">Batal</flux:button>
                    </flux:modal.close>

                    <flux:button wire:click="delete({{ $core->id }})" variant="danger">
                        Hapus
                    </flux:button>
                </div>
            </div>
        </flux:modal>
    @endforeach
</div>
