<?php

namespace App\Livewire;

use App\Models\Hero;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ManageHeroes extends Component
{
    use WithFileUploads, WithPagination;

    public $title = '';

    public $subtitle = '';

    public $image;

    public $editingHeroId = null;

    public $showModal = false;

    public function rules(): array
    {
        $rules = [
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ];

        return $rules;
    }

    #[Computed]
    public function heroes()
    {
        return Hero::latest()
            ->paginate(10);
    }

    public function create()
    {
        $this->reset(['title', 'subtitle', 'image', 'editingHeroId']);
        $this->showModal = true;
    }

    public function edit($heroId)
    {
        $hero = Hero::findOrFail($heroId);
        $this->editingHeroId = $hero->id;
        $this->title = $hero->title;
        $this->subtitle = $hero->subtitle;
        $this->image = null;

        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $heroData = [
            'title' => $this->title,
            'subtitle' => $this->subtitle,
        ];

        if ($this->image) {
            if ($this->editingHeroId) {
                $existingHero = Hero::findOrFail($this->editingHeroId);
                if ($existingHero->image) {
                    Storage::delete($existingHero->image);
                }
            }
            $heroData['image'] = $this->image->store('heroes', 'public');
        }

        if ($this->editingHeroId) {
            $hero = Hero::findOrFail($this->editingHeroId);
            $hero->update($heroData);
        } else {
            $hero = Hero::create($heroData);
        }

        $message = $this->editingHeroId ? 'Hero berhasil diperbarui!' : 'Hero berhasil dibuat!';

        $this->reset(['title', 'subtitle', 'image', 'editingHeroId']);
        $this->showModal = false;

        session()->flash('message', $message);
    }

    public function delete($heroId)
    {
        $hero = Hero::findOrFail($heroId);

        if ($hero->image) {
            Storage::delete($hero->image);
        }

        $hero->delete();
        session()->flash('message', 'Hero berhasil dihapus!');

        $this->modal("delete-hero-{$heroId}")->close();
    }

    public function resetForm()
    {
        $this->reset(['title', 'subtitle', 'image', 'editingHeroId']);
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.manage-heroes');
    }
}
