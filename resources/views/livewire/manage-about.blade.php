<div>
    <header class="flex items-center justify-between mb-6">
        <div>
            <flux:heading size="xl">Tentang Himpunan</flux:heading>
            <flux:subheading>Kelola informasi tentang himpunan</flux:subheading>
        </div>
    </header>

    @if (session()->has('message'))
        <flux:callout variant="success" icon="check-circle" heading="{{ session('message') }}" class="mb-6" />
    @endif

    <div class="border border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900 rounded-lg p-6">
        <!-- Form -->
        <form wire:submit.prevent="save">
            <div class="space-y-6">
                <flux:field>
                    <flux:label>Definisi</flux:label>
                    <flux:textarea wire:model="definition" placeholder="Masukkan definisi himpunan..." rows="4" />
                    <flux:error name="definition" />
                </flux:field>

                <flux:field>
                    <flux:label>Kedudukan dan Peran</flux:label>
                    <flux:textarea wire:model="position_role" placeholder="Masukkan kedudukan dan peran himpunan..." rows="3" />
                    <flux:error name="position_role" />
                </flux:field>

                <flux:field>
                    <flux:label>Visi</flux:label>
                    <flux:textarea wire:model="vision" placeholder="Masukkan visi himpunan..." rows="3" />
                    <flux:error name="vision" />
                </flux:field>

                <flux:field>
                    <flux:label>Misi</flux:label>
                    <div class="space-y-3">
                        <div class="flex space-x-2">
                            <flux:input wire:model="missionInput" placeholder="Tambahkan poin misi..." class="flex-1" />
                            <flux:button type="button" wire:click="addMission" variant="primary" icon="plus" size="sm">
                                Tambah
                            </flux:button>
                        </div>

                        @if(count($mission) > 0)
                            <div class="space-y-2">
                                @foreach($mission as $index => $missionItem)
                                    <div class="flex items-center space-x-2 p-2 bg-zinc-50 dark:bg-zinc-800 rounded">
                                        <span class="text-sm font-medium text-zinc-500 dark:text-zinc-400">{{ $index + 1 }}.</span>
                                        <span class="flex-1 text-sm">{{ $missionItem }}</span>
                                        <flux:button type="button" wire:click="removeMission({{ $index }})" variant="danger" icon="trash" size="sm" />
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <flux:error name="mission" />
                    <flux:error name="mission.*" />
                </flux:field>

                <flux:field>
                    <flux:label>Struktural</flux:label>
                    <flux:input type="file" wire:model="structural" accept="image/*" />
                    <flux:error name="structural" />
                    <flux:description>
                        Upload gambar struktural (maksimal 2MB, format: JPG, PNG, GIF)
                    </flux:description>
                    @if($structural)
                        <div class="mt-2">
                            <img src="{{ $structural->temporaryUrl() }}" alt="Preview" class="max-w-xs h-auto rounded-lg object-cover">
                        </div>
                    @elseif($this->about->hasStructuralImage())
                        <div class="mt-2">
                            <img src="{{ $this->about->structural_url }}" alt="Current Structural" class="max-w-xs h-auto rounded-lg object-cover">
                            <flux:text size="sm" class="text-zinc-500 mt-1">Gambar struktur saat ini</flux:text>
                        </div>
                    @endif
                </flux:field>

                <div class="flex gap-2">
                    <flux:spacer />

                    <flux:button type="submit" variant="primary">
                        Simpan
                    </flux:button>
                </div>
            </div>
        </form>
    </div>
</div>
