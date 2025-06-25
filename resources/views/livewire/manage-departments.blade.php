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
                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Data</th>
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
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-500 dark:text-zinc-400">
                            <div class="space-y-1">
                                <div class="flex items-center space-x-2">
                                    <flux:icon name="cog" class="w-3 h-3 text-zinc-400" />
                                    <span class="text-xs">{{ $department->department_functions_count }} Fungsi</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <flux:icon name="clipboard-document-list" class="w-3 h-3 text-zinc-400" />
                                    <span class="text-xs">{{ $department->work_programs_count }} Program Kerja</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <flux:icon name="calendar" class="w-3 h-3 text-zinc-400" />
                                    <span class="text-xs">{{ $department->agendas_count }} Agenda</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <flux:icon name="users" class="w-3 h-3 text-zinc-400" />
                                    <span class="text-xs">{{ $department->active_members_count }}/{{ $department->members_count }} Anggota</span>
                                </div>
                            </div>
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
                        <td colspan="6" class="px-6 py-4 text-center text-zinc-500 dark:text-zinc-400">
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
    <flux:modal wire:model.self="showModal" name="department-form" class="min-w-4xl max-w-6xl" wire:close="resetForm">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">
                    {{ $editingDepartmentId ? 'Edit Departemen' : 'Tambah Departemen Baru' }}
                </flux:heading>
                <flux:text class="mt-2">
                    {{ $editingDepartmentId ? 'Ubah informasi departemen dan data terkait.' : 'Buat departemen baru dengan informasi yang lengkap.' }}
                </flux:text>
            </div>

            <!-- Manual Tab Navigation -->
            <div class="border-b border-zinc-200 dark:border-zinc-700">
                <nav class="-mb-px flex space-x-8">
                    <button type="button"
                        wire:click="$set('activeTab', 'department')"
                        class="py-2 px-1 border-b-2 font-medium text-sm {{ $activeTab === 'department' ? 'border-blue-500 text-blue-600' : 'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300' }}">
                        Info Departemen
                    </button>
                    <button type="button"
                        wire:click="$set('activeTab', 'functions')"
                        class="py-2 px-1 border-b-2 font-medium text-sm {{ $activeTab === 'functions' ? 'border-blue-500 text-blue-600' : 'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300' }}">
                        Fungsi
                    </button>
                    <button type="button"
                        wire:click="$set('activeTab', 'programs')"
                        class="py-2 px-1 border-b-2 font-medium text-sm {{ $activeTab === 'programs' ? 'border-blue-500 text-blue-600' : 'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300' }}">
                        Program Kerja
                    </button>
                    <button type="button"
                        wire:click="$set('activeTab', 'agendas')"
                        class="py-2 px-1 border-b-2 font-medium text-sm {{ $activeTab === 'agendas' ? 'border-blue-500 text-blue-600' : 'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300' }}">
                        Agenda
                    </button>
                    <button type="button"
                        wire:click="$set('activeTab', 'members')"
                        class="py-2 px-1 border-b-2 font-medium text-sm {{ $activeTab === 'members' ? 'border-blue-500 text-blue-600' : 'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300' }}">
                        Anggota
                    </button>
                </nav>
            </div>

            <form wire:submit.prevent="save">
                <div class="space-y-6">

                    <!-- Department Tab Content -->
                    @if($activeTab === 'department')
                        <flux:field>
                            <flux:label>Nama Departemen</flux:label>
                            <flux:input wire:model="title" placeholder="Masukkan nama departemen..." />
                            <flux:error name="title" />
                        </flux:field>

                        <flux:field>
                            <flux:label>Deskripsi</flux:label>
                            <flux:textarea wire:model="description" placeholder="Masukkan deskripsi departemen..." rows="3" />
                            <flux:error name="description" />
                            <flux:description>
                                Deskripsi singkat tentang departemen (opsional)
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
                                Pilih divisi tempat departemen ini berada
                            </flux:description>
                        </flux:field>

                        <flux:field>
                            <flux:label>Logo Departemen</flux:label>
                            <flux:input type="file" wire:model="logo" accept="image/*" />
                            <flux:error name="logo" />
                            <flux:description>
                                Upload logo departemen (maksimal 2MB, format: JPG, PNG, GIF)
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
                    @endif

                    <!-- Functions Tab Content -->
                    @if($activeTab === 'functions')
                        <div class="space-y-4">
                            <div>
                                <flux:heading size="md">Fungsi Departemen</flux:heading>
                                <flux:text class="text-zinc-500">Kelola fungsi-fungsi departemen</flux:text>
                            </div>

                            <div class="flex gap-2">
                                <flux:input wire:model="functionTitle" placeholder="Nama fungsi..." class="flex-1" />
                                <flux:button wire:click="addFunction" variant="primary" size="sm">{{ $editingFunctionId ? 'Perbarui' : 'Tambah' }}</flux:button>
                            </div>
                            <flux:error name="functionTitle" />

                            @if(!empty($functions))
                                <div class="space-y-2">
                                    @foreach($functions as $index => $function)
                                        @if(!isset($function['_delete']))
                                            <div class="flex items-center justify-between p-3 border rounded-lg">
                                                <span>{{ $function['title'] }}</span>
                                                <div class="flex gap-2">
                                                    <flux:button wire:click="editFunction({{ $index }})" size="xs" variant="outline">Ubah</flux:button>
                                                    <flux:button wire:click="removeFunction({{ $index }})" size="xs" variant="danger">Hapus</flux:button>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endif

                    <!-- Work Programs Tab Content -->
                    @if($activeTab === 'programs')
                        <div class="space-y-4">
                            <div>
                                <flux:heading size="md">Program Kerja</flux:heading>
                                <flux:text class="text-zinc-500">Kelola program kerja departemen</flux:text>
                            </div>

                            <div class="space-y-3">
                                <flux:input wire:model="programTitle" placeholder="Nama program kerja..." />
                                <flux:textarea wire:model="programDescription" placeholder="Deskripsi program kerja..." rows="2" />
                                <flux:button wire:click="addWorkProgram" variant="primary" size="sm">{{ $editingProgramId ? 'Perbarui' : 'Tambah' }}</flux:button>
                            </div>
                            <flux:error name="programTitle" />

                            @if(!empty($workPrograms))
                                <div class="space-y-2">
                                    @foreach($workPrograms as $index => $program)
                                        @if(!isset($program['_delete']))
                                            <div class="p-3 border rounded-lg">
                                                <div class="flex items-start justify-between">
                                                    <div class="flex-1">
                                                        <h4 class="font-medium">{{ $program['title'] }}</h4>
                                                        @if(!empty($program['description']))
                                                            <p class="text-sm text-zinc-500 mt-1">{{ $program['description'] }}</p>
                                                        @endif
                                                    </div>
                                                    <div class="flex gap-2 ml-3">
                                                        <flux:button wire:click="editWorkProgram({{ $index }})" size="xs" variant="outline">Ubah</flux:button>
                                                        <flux:button wire:click="removeWorkProgram({{ $index }})" size="xs" variant="danger">Hapus</flux:button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endif

                    <!-- Agendas Tab Content -->
                    @if($activeTab === 'agendas')
                        <div class="space-y-4">
                            <div>
                                <flux:heading size="md">Agenda</flux:heading>
                                <flux:text class="text-zinc-500">Kelola agenda departemen</flux:text>
                            </div>

                            <div class="space-y-3">
                                <flux:input wire:model="agendaTitle" placeholder="Judul agenda..." />
                                <flux:textarea wire:model="agendaDescription" placeholder="Deskripsi agenda..." rows="2" />
                                <flux:button wire:click="addAgenda" variant="primary" size="sm">{{ $editingAgendaId ? 'Perbarui' : 'Tambah' }}</flux:button>
                            </div>
                            <flux:error name="agendaTitle" />

                            @if(!empty($agendas))
                                <div class="space-y-2">
                                    @foreach($agendas as $index => $agenda)
                                        @if(!isset($agenda['_delete']))
                                            <div class="p-3 border rounded-lg">
                                                <div class="flex items-start justify-between">
                                                    <div class="flex-1">
                                                        <h4 class="font-medium">{{ $agenda['title'] }}</h4>
                                                        @if(!empty($agenda['description']))
                                                            <p class="text-sm text-zinc-500 mt-1">{{ $agenda['description'] }}</p>
                                                        @endif
                                                    </div>
                                                    <div class="flex gap-2 ml-3">
                                                        <flux:button wire:click="editAgenda({{ $index }})" size="xs" variant="outline">Ubah</flux:button>
                                                        <flux:button wire:click="removeAgenda({{ $index }})" size="xs" variant="danger">Hapus</flux:button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endif

                    <!-- Members Tab Content -->
                    @if($activeTab === 'members')
                        <div class="space-y-4">
                            <div>
                                <flux:heading size="md">Anggota</flux:heading>
                                <flux:text class="text-zinc-500">Kelola anggota departemen</flux:text>
                            </div>

                            <div class="grid grid-cols-2 gap-3">
                                <flux:input wire:model="memberName" placeholder="Nama lengkap..." />
                                <flux:select wire:model="memberPosition" placeholder="Pilih jabatan...">
                                    <flux:select.option value="head">Kepala</flux:select.option>
                                    <flux:select.option value="staff">Anggota</flux:select.option>
                                </flux:select>
                                <flux:input type="number" wire:model="memberStartYear" placeholder="Tahun mulai..." min="2000" max="{{ (int)date('Y') + 10 }}" />
                                <flux:input type="number" wire:model="memberEndYear" placeholder="Tahun selesai (opsional)..." min="2000" max="{{ (int)date('Y') + 10 }}" />
                            </div>
                            <flux:button wire:click="addMember" variant="primary" size="sm">{{ $editingMemberId ? 'Perbarui' : 'Tambah' }}</flux:button>
                            <flux:error name="memberName" />
                            <flux:error name="memberPosition" />
                            <flux:error name="memberStartYear" />

                            @if(!empty($members))
                                <div class="space-y-2">
                                    @foreach($members as $index => $member)
                                        @if(!isset($member['_delete']))
                                            <div class="flex items-center justify-between p-3 border rounded-lg">
                                                <div>
                                                    <div class="font-medium">{{ $member['name'] }}</div>
                                                    <div class="text-sm text-zinc-500">
                                                        {{ ucfirst($member['position']) }} •
                                                        {{ $member['start_year'] }} - {{ $member['end_year'] ?? 'Sekarang' }}
                                                    </div>
                                                </div>
                                                <div class="flex gap-2">
                                                    <flux:button wire:click="editMember({{ $index }})" size="xs" variant="outline">Ubah</flux:button>
                                                    <flux:button wire:click="removeMember({{ $index }})" size="xs" variant="danger">Hapus</flux:button>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endif

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
        </div>
    </flux:modal>

    <!-- Delete Confirmation Modals -->
    @foreach ($this->departments as $department)
        <flux:modal name="delete-department-{{ $department->id }}" class="min-w-[22rem]">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Hapus Departemen?</flux:heading>
                    <flux:text class="mt-2">
                        <p>Anda akan menghapus departemen "{{ $department->title }}" dari divisi {{ $department->division }}.</p>
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
