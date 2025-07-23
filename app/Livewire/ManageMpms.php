<?php

namespace App\Livewire;

use App\Models\Mpm;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ManageMpms extends Component
{
    use WithFileUploads, WithPagination;

    public $type = '';
    public $title = '';
    public $description = '';
    public $content = [];
    public $banner_image;
    public $attachment_file;
    public $is_active = true;

    public $editingMpmId = null;
    public $showModal = false;

    // Input helpers
    public $contentTitle = '';
    public $contentDescription = '';

    public function rules(): array
    {
        return [
            'type' => 'required|string|in:komisi-a,komisi-b,komisi-c,burt',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'nullable|array',
            'banner_image' => 'nullable|image|max:2048',
            'attachment_file' => 'nullable|file|max:10240',
            'is_active' => 'boolean',
            'contentTitle' => 'nullable|string|max:255',
            'contentDescription' => 'nullable|string',
        ];
    }

    #[Computed]
    public function mpms()
    {
        return Mpm::latest()
            ->paginate(10);
    }

    #[Computed]
    public function mpmTypes()
    {
        return Mpm::getTypes();
    }

    public function create()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function edit($mpmId)
    {
        $mpm = Mpm::findOrFail($mpmId);
        $this->editingMpmId = $mpm->id;
        $this->type = $mpm->type;
        $this->title = $mpm->title;
        $this->description = $mpm->description;
        $this->content = $mpm->content ?? [];
        $this->is_active = $mpm->is_active;
        $this->banner_image = null;
        $this->attachment_file = null;

        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $mpmData = [
            'type' => $this->type,
            'title' => $this->title,
            'description' => $this->description,
            'content' => $this->content,
            'is_active' => $this->is_active,
        ];

        if ($this->banner_image) {
            if ($this->editingMpmId) {
                $existingMpm = Mpm::findOrFail($this->editingMpmId);
                if ($existingMpm->banner_image) {
                    Storage::delete($existingMpm->banner_image);
                }
            }
            $mpmData['banner_image'] = $this->banner_image->store('mpms/banners', 'public');
        }

        if ($this->attachment_file) {
            if ($this->editingMpmId) {
                $existingMpm = Mpm::findOrFail($this->editingMpmId);
                if ($existingMpm->attachment_file) {
                    Storage::delete($existingMpm->attachment_file);
                }
            }
            $mpmData['attachment_file'] = $this->attachment_file->store('mpms/attachments', 'public');
        }

        if ($this->editingMpmId) {
            $mpm = Mpm::findOrFail($this->editingMpmId);
            $mpm->update($mpmData);
            $message = 'MPM berhasil diperbarui!';
        } else {
            Mpm::create($mpmData);
            $message = 'MPM berhasil dibuat!';
        }

        $this->resetForm();
        $this->showModal = false;

        session()->flash('message', $message);
    }

    public function delete($mpmId)
    {
        $mpm = Mpm::findOrFail($mpmId);

        if ($mpm->banner_image) {
            Storage::delete($mpm->banner_image);
        }

        if ($mpm->attachment_file) {
            Storage::delete($mpm->attachment_file);
        }

        $mpm->delete();
        session()->flash('message', 'MPM berhasil dihapus!');

        $this->modal("delete-mpm-{$mpmId}")->close();
    }

    public function addContent()
    {
        if (!empty(trim($this->contentTitle)) && !empty(trim($this->contentDescription))) {
            $this->content[] = [
                'title' => trim($this->contentTitle),
                'description' => trim($this->contentDescription),
            ];
            $this->contentTitle = '';
            $this->contentDescription = '';
        }
    }

    public function removeContent($index)
    {
        if (isset($this->content[$index])) {
            unset($this->content[$index]);
            $this->content = array_values($this->content);
        }
    }

    public function resetForm()
    {
        $this->reset([
            'type', 'title', 'description', 'content',
            'banner_image', 'attachment_file', 'is_active', 'editingMpmId',
            'contentTitle', 'contentDescription',
        ]);

        $this->is_active = true;
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.manage-mpms');
    }
}