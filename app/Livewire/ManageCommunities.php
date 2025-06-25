<?php

namespace App\Livewire;

use App\Models\Community;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ManageCommunities extends Component
{
    use WithPagination, WithFileUploads;

    public $title = '';
    public $description = '';
    public $category = '';
    public $logo;
    public $editingCommunityId = null;
    public $showModal = false;
    public $search = '';

    public function rules(): array
    {
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|in:Community,Committee',
            'logo' => 'nullable|image|max:2048',
        ];

        if ($this->editingCommunityId) {
            $rules['title'] .= '|unique:communities,title,' . $this->editingCommunityId;
        } else {
            $rules['title'] .= '|unique:communities,title';
        }

        return $rules;
    }

    #[Computed]
    public function communities()
    {
        return Community::when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%')
                      ->orWhere('category', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);
    }

    #[Computed]
    public function categories()
    {
        return ['Community', 'Committee'];
    }

    public function create()
    {
        $this->reset(['title', 'description', 'category', 'logo', 'editingCommunityId']);
        $this->showModal = true;
    }

    public function edit($communityId)
    {
        $community = Community::findOrFail($communityId);
        $this->editingCommunityId = $community->id;
        $this->title = $community->title;
        $this->description = $community->description;
        $this->category = $community->category;
        $this->logo = null;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $communityData = [
            'title' => $this->title,
            'description' => $this->description,
            'category' => $this->category,
        ];

        if ($this->logo) {
            if ($this->editingCommunityId) {
                $existingCommunity = Community::findOrFail($this->editingCommunityId);
                if ($existingCommunity->logo) {
                    Storage::delete($existingCommunity->logo);
                }
            }
            $communityData['logo'] = $this->logo->store('communities', 'public');
        }

        if ($this->editingCommunityId) {
            $community = Community::findOrFail($this->editingCommunityId);
            $community->update($communityData);
        } else {
            $community = Community::create($communityData);
        }

        $message = $this->editingCommunityId ? 'Community berhasil diperbarui!' : 'Community berhasil dibuat!';

        $this->reset(['title', 'description', 'category', 'logo', 'editingCommunityId']);
        $this->showModal = false;

        session()->flash('message', $message);
    }

    public function delete($communityId)
    {
        $community = Community::findOrFail($communityId);

        if ($community->logo) {
            Storage::delete($community->logo);
        }

        $community->delete();
        session()->flash('message', 'Community berhasil dihapus!');

        $this->modal("delete-community-{$communityId}")->close();
    }

    public function resetForm()
    {
        $this->reset(['title', 'description', 'category', 'logo', 'editingCommunityId']);
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.manage-communities');
    }
}
