<?php

namespace App\Livewire;

use App\Models\Core;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ManageCores extends Component
{
    use WithFileUploads, WithPagination;

    public $name = '';

    public $position = '';

    public $photo;

    public $editingCoreId = null;

    public $showModal = false;

    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'position' => 'required|string|in:Ketua Himpunan,Wakil Ketua Himpunan,Sekretaris Jenderal,Sekretaris,Bendahara',
            'photo' => 'nullable|image|max:2048',
        ];

        return $rules;
    }

    #[Computed]
    public function cores()
    {
        return Core::orderedByPosition()
            ->paginate(10);
    }

    #[Computed]
    public function positions()
    {
        return array_keys(Core::$positionHierarchy);
    }

    public function create()
    {
        $this->reset(['name', 'position', 'photo', 'editingCoreId']);
        $this->showModal = true;
    }

    public function edit($coreId)
    {
        $core = Core::findOrFail($coreId);
        $this->editingCoreId = $core->id;
        $this->name = $core->name;
        $this->position = $core->position;
        $this->photo = null;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $coreData = [
            'name' => $this->name,
            'position' => $this->position,
        ];

        if ($this->photo) {
            if ($this->editingCoreId) {
                $existingCore = Core::findOrFail($this->editingCoreId);
                if ($existingCore->photo) {
                    Storage::delete($existingCore->photo);
                }
            }
            $coreData['photo'] = $this->photo->store('cores', 'public');
        }

        if ($this->editingCoreId) {
            $core = Core::findOrFail($this->editingCoreId);
            $core->update($coreData);
        } else {
            $core = Core::create($coreData);
        }

        $message = $this->editingCoreId ? 'Inti berhasil diperbarui!' : 'Inti berhasil dibuat!';

        $this->reset(['name', 'position', 'photo', 'editingCoreId']);
        $this->showModal = false;

        session()->flash('message', $message);
    }

    public function delete($coreId)
    {
        $core = Core::findOrFail($coreId);

        if ($core->photo) {
            Storage::delete($core->photo);
        }

        $core->delete();
        session()->flash('message', 'Inti berhasil dihapus!');

        $this->modal("delete-core-{$coreId}")->close();
    }

    public function resetForm()
    {
        $this->reset(['name', 'position', 'photo', 'editingCoreId']);
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.manage-cores');
    }
}
