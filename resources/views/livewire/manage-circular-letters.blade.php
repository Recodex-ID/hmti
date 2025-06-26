<div>
    <header class="flex items-center justify-between mb-6">
        <div>
            <flux:heading size="xl">Informasi Surat Edaran</flux:heading>
            <flux:subheading>Kelola informasi surat edaran himpunan</flux:subheading>
        </div>

        <flux:button wire:click="create" variant="primary" icon="plus">
            Buat
        </flux:button>
    </header>

    @if (session()->has('message'))
        <flux:callout variant="success" icon="check-circle" heading="{{ session('message') }}" class="mb-6" />
    @endif

    <div class="mb-6">
        <flux:input wire:model.live.debounce.300ms="search" placeholder="Cari surat edaran..." icon="magnifying-glass" />
    </div>

    <div class="border border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900 rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-zinc-200 dark:divide-zinc-700">
                <thead class="bg-zinc-50 dark:bg-zinc-800">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Nomor</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Judul</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Pembuat</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Aksi</th>
                </tr>
                </thead>
                <tbody class="bg-white dark:bg-zinc-900 divide-y divide-zinc-200 dark:divide-zinc-700">
                @forelse ($this->circularLetters as $circularLetter)
                    <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-zinc-900 dark:text-zinc-100">
                            {{ $circularLetter->number }}
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-zinc-900 dark:text-zinc-100 max-w-xs">
                            <div class="truncate">{{ $circularLetter->title }}</div>
                            <div class="text-xs text-zinc-500 dark:text-zinc-400 truncate">{{ $circularLetter->description }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-500 dark:text-zinc-400">
                            {{ $circularLetter->letter_date->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($circularLetter->is_active)
                                <flux:badge color="green" size="sm">Aktif</flux:badge>
                            @else
                                <flux:badge color="red" size="sm">Tidak Aktif</flux:badge>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-500 dark:text-zinc-400">
                            {{ $circularLetter->creator?->name ?? '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                @if($circularLetter->file_path)
                                    <flux:button size="sm" variant="ghost" color="green" icon="document-arrow-down" 
                                                onclick="window.open('{{ Storage::url($circularLetter->file_path) }}', '_blank')" />
                                @endif
                                <flux:button wire:click="edit({{ $circularLetter->id }})" size="sm" variant="primary" color="blue" icon="pencil" />
                                <flux:modal.trigger name="delete-circular-letter-{{ $circularLetter->id }}">
                                    <flux:button size="sm" variant="primary" color="red" icon="trash" />
                                </flux:modal.trigger>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-zinc-500 dark:text-zinc-400">
                            Tidak ada surat edaran ditemukan
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $this->circularLetters->links('custom.pagination') }}
    </div>

    <!-- Modal Form -->
    <flux:modal wire:model.self="showModal" name="circular-letter-form" class="min-w-2xl max-w-4xl" wire:close="resetForm">
        <form wire:submit.prevent="save">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">
                        {{ $editingCircularLetterId ? 'Edit Surat Edaran' : 'Tambah Surat Edaran Baru' }}
                    </flux:heading>
                    <flux:text class="mt-2">
                        {{ $editingCircularLetterId ? 'Ubah informasi surat edaran.' : 'Buat informasi surat edaran baru.' }}
                    </flux:text>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <flux:field>
                        <flux:label>Nomor Surat</flux:label>
                        <flux:input wire:model="number" placeholder="Contoh: CL/HMTI/2024/001" />
                        <flux:error name="number" />
                    </flux:field>

                    <flux:field>
                        <flux:label>Tanggal Surat</flux:label>
                        <flux:input type="date" wire:model="letter_date" />
                        <flux:error name="letter_date" />
                    </flux:field>
                </div>

                <flux:field>
                    <flux:label>Judul</flux:label>
                    <flux:input wire:model="title" placeholder="Masukkan judul surat edaran..." />
                    <flux:error name="title" />
                </flux:field>

                <flux:field>
                    <flux:label>Deskripsi Singkat</flux:label>
                    <flux:textarea wire:model="description" placeholder="Masukkan deskripsi singkat..." rows="3" />
                    <flux:error name="description" />
                </flux:field>

                <flux:field>
                    <flux:label>Konten</flux:label>
                    <flux:textarea wire:model="content" placeholder="Masukkan konten lengkap surat edaran..." rows="6" />
                    <flux:error name="content" />
                </flux:field>

                <flux:field>
                    <flux:label>File Lampiran</flux:label>
                    <flux:input type="file" wire:model="file_path" accept=".pdf,.doc,.docx" />
                    <flux:error name="file_path" />
                    <flux:description>
                        Upload file surat edaran (maksimal 10MB, format: PDF, DOC, DOCX)
                    </flux:description>
                    @if($editingCircularLetterId)
                        @php
                            $existingCircularLetter = App\Models\CircularLetter::find($editingCircularLetterId);
                        @endphp
                        @if($existingCircularLetter?->file_path)
                            <div class="mt-2">
                                <flux:text size="sm" class="text-zinc-500">
                                    File saat ini: {{ basename($existingCircularLetter->file_path) }}
                                </flux:text>
                            </div>
                        @endif
                    @endif
                </flux:field>

                <flux:field>
                    <flux:checkbox wire:model="is_active">Status Aktif</flux:checkbox>
                    <flux:error name="is_active" />
                    <flux:description>
                        Surat edaran yang aktif akan ditampilkan di website
                    </flux:description>
                </flux:field>

                <div class="flex gap-2">
                    <flux:spacer />

                    <flux:modal.close>
                        <flux:button variant="ghost">Batal</flux:button>
                    </flux:modal.close>

                    <flux:button type="submit" variant="primary">
                        {{ $editingCircularLetterId ? 'Perbarui' : 'Simpan' }}
                    </flux:button>
                </div>
            </div>
        </form>
    </flux:modal>

    <!-- Delete Confirmation Modals -->
    @foreach ($this->circularLetters as $circularLetter)
        <flux:modal name="delete-circular-letter-{{ $circularLetter->id }}" class="min-w-[22rem]">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Hapus Surat Edaran?</flux:heading>
                    <flux:text class="mt-2">
                        <p>Anda akan menghapus surat edaran "{{ $circularLetter->title }}".</p>
                        <p>Tindakan ini tidak dapat dibatalkan.</p>
                    </flux:text>
                </div>

                <div class="flex gap-2">
                    <flux:spacer />

                    <flux:modal.close>
                        <flux:button variant="ghost">Batal</flux:button>
                    </flux:modal.close>

                    <flux:button wire:click="delete({{ $circularLetter->id }})" variant="danger">
                        Hapus
                    </flux:button>
                </div>
            </div>
        </flux:modal>
    @endforeach
</div>