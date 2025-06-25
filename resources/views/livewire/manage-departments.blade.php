<div>
    <header class="flex items-center justify-between mb-6">
        <div>
            <flux:heading size="xl">Departemen & Biro</flux:heading>
            <flux:subheading>Kelola departemen dan biro himpunan</flux:subheading>
        </div>

        <flux:button wire:click="create" variant="primary" icon="plus">
            Buat
        </flux:button>
    </header>

    @if (session()->has('message'))
        <flux:callout variant="success" icon="check-circle" heading="{{ session('message') }}" class="mb-6" />
    @endif

    <div class="mb-6">
        <flux:input wire:model.live.debounce.300ms="search" placeholder="Cari department..." icon="magnifying-glass" />
    </div>

    <div class="border border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900 rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-zinc-200 dark:divide-zinc-700">
                <thead class="bg-zinc-50 dark:bg-zinc-800">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Logo</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Deskripsi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Divisi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Aksi</th>
                </tr>
                </thead>
                <tbody class="bg-white dark:bg-zinc-900 divide-y divide-zinc-200 dark:divide-zinc-700">
                @forelse ($this->departments as $department)
                    <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-zinc-900 dark:text-zinc-100">
                            @if($department->logo)
                                <img src="{{ $department->logo_url }}" alt="{{ $department->title }}" class="w-10 h-10 rounded-lg object-cover">
                            @else
                                <div class="w-10 h-10 bg-zinc-200 dark:bg-zinc-700 rounded-lg flex items-center justify-center">
                                    <flux:icon name="building-office" class="w-5 h-5 text-zinc-400" />
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-zinc-900 dark:text-zinc-100">{{ $department->title }}</td>
                        <td class="px-6 py-4 text-sm text-zinc-500 dark:text-zinc-400 max-w-xs truncate">
                            {{ $department->description ?? '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-500 dark:text-zinc-400">
                            <flux:badge
                                variant="primary"
                                size="sm"
                                color="{{ $department->division === 'Internal' ? 'blue' : ($department->division === 'PSTI' ? 'green' : 'purple') }}"
                            >
                                {{ $department->division }}
                            </flux:badge>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <flux:button wire:click="edit({{ $department->id }})" size="sm" variant="primary" color="blue" icon="pencil" />
                                <flux:modal.trigger name="delete-department-{{ $department->id }}">
                                    <flux:button size="sm" variant="primary" color="red" icon="trash" />
                                </flux:modal.trigger>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-zinc-500 dark:text-zinc-400">
                            Tidak ada department ditemukan
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $this->departments->links('custom.pagination') }}
    </div>

    <!-- Modal Form -->
    <flux:modal wire:model.self="showModal" name="department-form" class="min-w-2xl max-w-3xl" wire:close="resetForm">
        <form wire:submit.prevent="save">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">
                        {{ $editingDepartmentId ? 'Edit Department' : 'Tambah Department Baru' }}
                    </flux:heading>
                    <flux:text class="mt-2">
                        {{ $editingDepartmentId ? 'Ubah informasi department.' : 'Buat department baru dengan informasi yang lengkap.' }}
                    </flux:text>
                </div>

                <flux:field>
                    <flux:label>Nama Department</flux:label>
                    <flux:input wire:model="title" placeholder="Masukkan nama department..." />
                    <flux:error name="title" />
                </flux:field>

                <flux:field>
                    <flux:label>Deskripsi</flux:label>
                    <flux:textarea wire:model="description" placeholder="Masukkan deskripsi department..." rows="3" />
                    <flux:error name="description" />
                    <flux:description>
                        Deskripsi singkat tentang department (opsional)
                    </flux:description>
                </flux:field>

                <flux:field>
                    <flux:label>Divisi</flux:label>
                    <flux:select wire:model="division" placeholder="Pilih divisi...">
                        @foreach ($this->divisions as $divisionOption)
                            <flux:select.option value="{{ $divisionOption }}">{{ $divisionOption }}</flux:select.option>
                        @endforeach
                    </flux:select>
                    <flux:error name="division" />
                    <flux:description>
                        Pilih divisi tempat department ini berada
                    </flux:description>
                </flux:field>

                <flux:field>
                    <flux:label>Logo Department</flux:label>
                    <flux:input type="file" wire:model="logo" accept="image/*" />
                    <flux:error name="logo" />
                    <flux:description>
                        Upload logo department (maksimal 2MB, format: JPG, PNG, GIF)
                    </flux:description>
                    @if($logo)
                        <div class="mt-2">
                            <img src="{{ $logo->temporaryUrl() }}" alt="Preview" class="w-20 h-20 rounded-lg object-cover">
                        </div>
                    @elseif($editingDepartmentId)
                        @php
                            $existingDepartment = App\Models\Department::find($editingDepartmentId);
                        @endphp
                        @if($existingDepartment?->logo)
                            <div class="mt-2">
                                <img src="{{ $existingDepartment->logo_url }}" alt="Current Logo" class="w-20 h-20 rounded-lg object-cover">
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
                        {{ $editingDepartmentId ? 'Perbarui' : 'Simpan' }}
                    </flux:button>
                </div>
            </div>
        </form>
    </flux:modal>

    <!-- Delete Confirmation Modals -->
    @foreach ($this->departments as $department)
        <flux:modal name="delete-department-{{ $department->id }}" class="min-w-[22rem]">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Hapus Department?</flux:heading>
                    <flux:text class="mt-2">
                        <p>Anda akan menghapus department "{{ $department->title }}" dari divisi {{ $department->division }}.</p>
                        <p>Tindakan ini tidak dapat dibatalkan.</p>
                    </flux:text>
                </div>

                <div class="flex gap-2">
                    <flux:spacer />

                    <flux:modal.close>
                        <flux:button variant="ghost">Batal</flux:button>
                    </flux:modal.close>

                    <flux:button wire:click="delete({{ $department->id }})" variant="danger">
                        Hapus
                    </flux:button>
                </div>
            </div>
        </flux:modal>
    @endforeach
</div>
