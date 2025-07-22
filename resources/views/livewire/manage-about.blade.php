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

                <flux:field>
                    <flux:label>Banner</flux:label>
                    <flux:input type="file" wire:model="banner" accept="image/*" />
                    <flux:error name="banner" />
                    <flux:description>
                        Upload gambar banner (maksimal 2MB, format: JPG, PNG, GIF)
                    </flux:description>
                    @if($banner)
                        <div class="mt-2">
                            <img src="{{ $banner->temporaryUrl() }}" alt="Preview" class="max-w-xs h-auto rounded-lg object-cover">
                        </div>
                    @elseif($this->about->hasBanner())
                        <div class="mt-2">
                            <img src="{{ $this->about->banner_url }}" alt="Current Banner" class="max-w-xs h-auto rounded-lg object-cover">
                            <flux:text size="sm" class="text-zinc-500 mt-1">Gambar banner saat ini</flux:text>
                        </div>
                    @endif
                </flux:field>

                <flux:field>
                    <flux:label>Link YouTube</flux:label>
                    <flux:input wire:model="link_youtube" placeholder="https://www.youtube.com/watch?v=..." />
                    <flux:error name="link_youtube" />
                    <flux:description>
                        Masukkan URL video YouTube tentang himpunan
                    </flux:description>
                    @if($link_youtube)
                        <div class="mt-2 p-3 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg">
                            <div class="flex items-center space-x-2">
                                <flux:icon name="video-camera" class="w-5 h-5 text-red-600 dark:text-red-400" />
                                <span class="text-sm text-red-700 dark:text-red-300">{{ $link_youtube }}</span>
                            </div>
                        </div>
                    @elseif($this->about->hasYoutubeLink())
                        <div class="mt-2 p-3 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2">
                                    <flux:icon name="video-camera" class="w-5 h-5 text-green-600 dark:text-green-400" />
                                    <span class="text-sm text-green-700 dark:text-green-300">{{ $this->about->link_youtube }}</span>
                                </div>
                                <a href="{{ $this->about->link_youtube }}" target="_blank" class="text-sm text-green-600 dark:text-green-400 hover:underline">
                                    Buka Video
                                </a>
                            </div>
                            <flux:text size="sm" class="text-green-600 dark:text-green-400 mt-1">Link YouTube saat ini</flux:text>
                        </div>
                    @endif
                </flux:field>

                <flux:field>
                    <flux:label>AD/ART (Anggaran Dasar/Anggaran Rumah Tangga)</flux:label>
                    <flux:input type="file" wire:model="ad_art" accept=".pdf" />
                    <flux:error name="ad_art" />
                    <flux:description>
                        Upload file AD/ART dalam format PDF (maksimal 5MB)
                    </flux:description>
                    @if($ad_art)
                        <div class="mt-2 p-3 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg">
                            <div class="flex items-center space-x-2">
                                <flux:icon name="document-text" class="w-5 h-5 text-blue-600 dark:text-blue-400" />
                                <span class="text-sm text-blue-700 dark:text-blue-300">{{ $ad_art->getClientOriginalName() }}</span>
                            </div>
                        </div>
                    @elseif($this->about->hasAdArt())
                        <div class="mt-2 p-3 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2">
                                    <flux:icon name="document-text" class="w-5 h-5 text-green-600 dark:text-green-400" />
                                    <span class="text-sm text-green-700 dark:text-green-300">{{ $this->about->ad_art_filename }}</span>
                                </div>
                                <a href="{{ $this->about->ad_art_url }}" target="_blank" class="text-sm text-green-600 dark:text-green-400 hover:underline">
                                    Lihat PDF
                                </a>
                            </div>
                            <flux:text size="sm" class="text-green-600 dark:text-green-400 mt-1">File AD/ART saat ini</flux:text>
                        </div>
                    @endif
                </flux:field>

                <flux:field>
                    <flux:label>Panduan Logo HMTI</flux:label>
                    <flux:input type="file" wire:model="logo_guideline" accept=".pdf" />
                    <flux:error name="logo_guideline" />
                    <flux:description>
                        Upload file panduan logo dalam format PDF (maksimal 5MB)
                    </flux:description>
                    @if($logo_guideline)
                        <div class="mt-2 p-3 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg">
                            <div class="flex items-center space-x-2">
                                <flux:icon name="document-text" class="w-5 h-5 text-blue-600 dark:text-blue-400" />
                                <span class="text-sm text-blue-700 dark:text-blue-300">{{ $logo_guideline->getClientOriginalName() }}</span>
                            </div>
                        </div>
                    @elseif($this->about->hasLogoGuideline())
                        <div class="mt-2 p-3 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2">
                                    <flux:icon name="document-text" class="w-5 h-5 text-green-600 dark:text-green-400" />
                                    <span class="text-sm text-green-700 dark:text-green-300">Panduan Logo HMTI</span>
                                </div>
                                <a href="{{ $this->about->logo_guideline_url }}" target="_blank" class="text-sm text-green-600 dark:text-green-400 hover:underline">
                                    Lihat PDF
                                </a>
                            </div>
                            <flux:text size="sm" class="text-green-600 dark:text-green-400 mt-1">File panduan logo saat ini</flux:text>
                        </div>
                    @endif
                </flux:field>

                <flux:field>
                    <flux:label>Grand Design HMTI 2025</flux:label>
                    <flux:input type="file" wire:model="grand_design" accept=".pdf" />
                    <flux:error name="grand_design" />
                    <flux:description>
                        Upload file grand design dalam format PDF (maksimal 5MB)
                    </flux:description>
                    @if($grand_design)
                        <div class="mt-2 p-3 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg">
                            <div class="flex items-center space-x-2">
                                <flux:icon name="document-text" class="w-5 h-5 text-blue-600 dark:text-blue-400" />
                                <span class="text-sm text-blue-700 dark:text-blue-300">{{ $grand_design->getClientOriginalName() }}</span>
                            </div>
                        </div>
                    @elseif($this->about->hasGrandDesign())
                        <div class="mt-2 p-3 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2">
                                    <flux:icon name="document-text" class="w-5 h-5 text-green-600 dark:text-green-400" />
                                    <span class="text-sm text-green-700 dark:text-green-300">Grand Design HMTI 2025</span>
                                </div>
                                <a href="{{ $this->about->grand_design_url }}" target="_blank" class="text-sm text-green-600 dark:text-green-400 hover:underline">
                                    Lihat PDF
                                </a>
                            </div>
                            <flux:text size="sm" class="text-green-600 dark:text-green-400 mt-1">File grand design saat ini</flux:text>
                        </div>
                    @endif
                </flux:field>

                <flux:field>
                    <flux:label>Konten HUT HMTI</flux:label>
                    <div class="space-y-3">
                        <div class="flex space-x-2">
                            <flux:input wire:model="anniversaryInput" placeholder="Tambahkan konten HUT HMTI..." class="flex-1" />
                            <flux:button type="button" wire:click="addAnniversary" variant="primary" icon="plus" size="sm">
                                Tambah
                            </flux:button>
                        </div>

                        @if(count($anniversary_content) > 0)
                            <div class="space-y-2">
                                @foreach($anniversary_content as $index => $anniversaryItem)
                                    <div class="flex items-center space-x-2 p-2 bg-zinc-50 dark:bg-zinc-800 rounded">
                                        <span class="text-sm font-medium text-zinc-500 dark:text-zinc-400">{{ $index + 1 }}.</span>
                                        <span class="flex-1 text-sm">{{ $anniversaryItem }}</span>
                                        <flux:button type="button" wire:click="removeAnniversary({{ $index }})" variant="danger" icon="trash" size="sm" />
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <flux:error name="anniversary_content" />
                    <flux:error name="anniversary_content.*" />
                </flux:field>

                <flux:field>
                    <flux:label>Konten Sejarah HMTI</flux:label>
                    <div class="space-y-3">
                        <div class="flex space-x-2">
                            <flux:input wire:model="historyInput" placeholder="Tambahkan konten sejarah HMTI..." class="flex-1" />
                            <flux:button type="button" wire:click="addHistory" variant="primary" icon="plus" size="sm">
                                Tambah
                            </flux:button>
                        </div>

                        @if(count($history_content) > 0)
                            <div class="space-y-2">
                                @foreach($history_content as $index => $historyItem)
                                    <div class="flex items-center space-x-2 p-2 bg-zinc-50 dark:bg-zinc-800 rounded">
                                        <span class="text-sm font-medium text-zinc-500 dark:text-zinc-400">{{ $index + 1 }}.</span>
                                        <span class="flex-1 text-sm">{{ $historyItem }}</span>
                                        <flux:button type="button" wire:click="removeHistory({{ $index }})" variant="danger" icon="trash" size="sm" />
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <flux:error name="history_content" />
                    <flux:error name="history_content.*" />
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
