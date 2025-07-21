<div>
    <header class="flex items-center justify-between mb-6">
        <div>
            <flux:heading size="xl">Informasi Kegiatan</flux:heading>
            <flux:subheading>Kelola informasi kegiatan himpunan</flux:subheading>
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
                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Tanggal & Waktu</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Lokasi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Aksi</th>
                </tr>
                </thead>
                <tbody class="bg-white dark:bg-zinc-900 divide-y divide-zinc-200 dark:divide-zinc-700">
                @forelse ($this->activityInformation as $activity)
                    <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-zinc-900 dark:text-zinc-100">
                            @if($activity->image_path)
                                <img src="{{ Storage::url($activity->image_path) }}" alt="{{ $activity->title }}" class="w-16 h-10 rounded-lg object-cover">
                            @else
                                <div class="w-16 h-10 bg-zinc-200 dark:bg-zinc-700 rounded-lg flex items-center justify-center">
                                    <flux:icon name="photo" class="w-5 h-5 text-zinc-400" />
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-zinc-900 dark:text-zinc-100 max-w-xs">
                            <div class="truncate">{{ $activity->title }}</div>
                            <div class="text-xs text-zinc-500 dark:text-zinc-400 truncate">{{ $activity->organizer }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-500 dark:text-zinc-400">
                            <div>{{ $activity->start_date->translatedFormat('d F Y') }}</div>
                            <div class="text-xs">{{ $activity->start_date->format('H:i') }} - {{ $activity->end_date->format('H:i') }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm text-zinc-500 dark:text-zinc-400 max-w-xs truncate">
                            {{ $activity->location }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($activity->is_active)
                                <flux:badge color="green" size="sm">Aktif</flux:badge>
                            @else
                                <flux:badge color="red" size="sm">Tidak Aktif</flux:badge>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <flux:button wire:click="edit({{ $activity->id }})" size="sm" variant="primary" color="blue" icon="pencil" />
                                <flux:modal.trigger name="delete-activity-information-{{ $activity->id }}">
                                    <flux:button size="sm" variant="primary" color="red" icon="trash" />
                                </flux:modal.trigger>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-zinc-500 dark:text-zinc-400">
                            Tidak ada informasi kegiatan ditemukan
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $this->activityInformation->links('custom.pagination') }}
    </div>

    <!-- Modal Form -->
    <flux:modal wire:model.self="showModal" name="activity-information-form" class="min-w-2xl max-w-5xl max-h-[90vh] overflow-y-auto" wire:close="resetForm">
        <form wire:submit.prevent="save">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">
                        {{ $editingActivityInformationId ? 'Edit Informasi Kegiatan' : 'Tambah Informasi Kegiatan Baru' }}
                    </flux:heading>
                    <flux:text class="mt-2">
                        {{ $editingActivityInformationId ? 'Ubah informasi kegiatan.' : 'Buat informasi kegiatan baru.' }}
                    </flux:text>
                </div>

                <flux:field>
                    <flux:label>Judul Kegiatan</flux:label>
                    <flux:input wire:model="title" placeholder="Masukkan judul kegiatan..." />
                    <flux:error name="title" />
                </flux:field>

                <flux:field>
                    <flux:label>Deskripsi Singkat</flux:label>
                    <flux:textarea wire:model="description" placeholder="Masukkan deskripsi singkat kegiatan..." rows="3" />
                    <flux:error name="description" />
                </flux:field>

                <flux:field>
                    <flux:label>Konten Detail</flux:label>
                    <flux:textarea wire:model="content" placeholder="Masukkan konten detail kegiatan..." rows="5" />
                    <flux:error name="content" />
                </flux:field>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <flux:field>
                        <flux:label>Lokasi</flux:label>
                        <flux:input wire:model="location" placeholder="Masukkan lokasi kegiatan..." />
                        <flux:error name="location" />
                    </flux:field>

                    <flux:field>
                        <flux:label>Penyelenggara</flux:label>
                        <flux:input wire:model="organizer" placeholder="Masukkan nama penyelenggara..." />
                        <flux:error name="organizer" />
                    </flux:field>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <flux:field>
                        <flux:label>Tanggal & Waktu Mulai</flux:label>
                        <flux:input type="datetime-local" wire:model="start_date" />
                        <flux:error name="start_date" />
                    </flux:field>

                    <flux:field>
                        <flux:label>Tanggal & Waktu Selesai</flux:label>
                        <flux:input type="datetime-local" wire:model="end_date" />
                        <flux:error name="end_date" />
                    </flux:field>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <flux:field>
                        <flux:label>Biaya Pendaftaran</flux:label>
                        <flux:input type="number" wire:model="registration_fee" placeholder="0" step="0.01" />
                        <flux:error name="registration_fee" />
                        <flux:description>Kosongkan jika gratis</flux:description>
                    </flux:field>

                    <flux:field>
                        <flux:label>Batas Waktu Pendaftaran</flux:label>
                        <flux:input type="datetime-local" wire:model="registration_deadline" />
                        <flux:error name="registration_deadline" />
                    </flux:field>
                </div>

                <flux:field>
                    <flux:label>Persyaratan</flux:label>
                    <flux:textarea wire:model="requirements" placeholder="Masukkan persyaratan kegiatan..." rows="3" />
                    <flux:error name="requirements" />
                </flux:field>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <flux:field>
                        <flux:label>Nama Kontak</flux:label>
                        <flux:input wire:model="contact_person" placeholder="Nama contact person..." />
                        <flux:error name="contact_person" />
                    </flux:field>

                    <flux:field>
                        <flux:label>Nomor Telepon</flux:label>
                        <flux:input wire:model="contact_phone" placeholder="+62xxx..." />
                        <flux:error name="contact_phone" />
                    </flux:field>

                    <flux:field>
                        <flux:label>Email Kontak</flux:label>
                        <flux:input type="email" wire:model="contact_email" placeholder="email@contoh.com" />
                        <flux:error name="contact_email" />
                    </flux:field>
                </div>

                <flux:field>
                    <flux:label>Gambar Kegiatan</flux:label>
                    <flux:input type="file" wire:model="image_path" accept="image/*" />
                    <flux:error name="image_path" />
                    <flux:description>
                        Upload gambar kegiatan (maksimal 2MB, format: JPG, PNG, GIF)
                    </flux:description>
                    @if($image_path)
                        <div class="mt-2">
                            <img src="{{ $image_path->temporaryUrl() }}" alt="Preview" class="w-32 h-20 rounded-lg object-cover">
                        </div>
                    @elseif($editingActivityInformationId)
                        @php
                            $existingActivity = App\Models\ActivityInformation::find($editingActivityInformationId);
                        @endphp
                        @if($existingActivity?->image_path)
                            <div class="mt-2">
                                <img src="{{ Storage::url($existingActivity->image_path) }}" alt="Current Image" class="w-32 h-20 rounded-lg object-cover">
                                <flux:text size="sm" class="text-zinc-500 mt-1">Gambar saat ini</flux:text>
                            </div>
                        @endif
                    @endif
                </flux:field>

                <flux:field>
                    <flux:checkbox wire:model="is_active">Status Aktif</flux:checkbox>
                    <flux:error name="is_active" />
                    <flux:description>
                        Kegiatan yang aktif akan ditampilkan di website
                    </flux:description>
                </flux:field>

                <div class="flex gap-2">
                    <flux:spacer />

                    <flux:modal.close>
                        <flux:button variant="ghost">Batal</flux:button>
                    </flux:modal.close>

                    <flux:button type="submit" variant="primary">
                        {{ $editingActivityInformationId ? 'Perbarui' : 'Simpan' }}
                    </flux:button>
                </div>
            </div>
        </form>
    </flux:modal>

    <!-- Delete Confirmation Modals -->
    @foreach ($this->activityInformation as $activity)
        <flux:modal name="delete-activity-information-{{ $activity->id }}" class="min-w-[22rem]">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Hapus Informasi Kegiatan?</flux:heading>
                    <flux:text class="mt-2">
                        <p>Anda akan menghapus informasi kegiatan "{{ $activity->title }}".</p>
                        <p>Tindakan ini tidak dapat dibatalkan.</p>
                    </flux:text>
                </div>

                <div class="flex gap-2">
                    <flux:spacer />

                    <flux:modal.close>
                        <flux:button variant="ghost">Batal</flux:button>
                    </flux:modal.close>

                    <flux:button wire:click="delete({{ $activity->id }})" variant="danger">
                        Hapus
                    </flux:button>
                </div>
            </div>
        </flux:modal>
    @endforeach
</div>
