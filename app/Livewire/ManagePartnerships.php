<?php

namespace App\Livewire;

use App\Models\Partnership;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ManagePartnerships extends Component
{
    use WithFileUploads, WithPagination;

    public $type = '';
    public $title = '';
    public $description = '';
    public $content = [];
    public $contact_info = [];
    public $banner;
    public $document;
    public $is_active = true;

    public $editingPartnershipId = null;
    public $showModal = false;

    // Input helpers
    public $contentInput = '';
    public $contactName = '';
    public $contactEmail = '';
    public $contactPhone = '';

    public function rules(): array
    {
        return [
            'type' => 'required|string|in:benchmark,media_partner,mc_moderator',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'nullable|array',
            'content.*' => 'required|string',
            'contact_info' => 'nullable|array',
            'banner' => 'nullable|image|max:2048',
            'document' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'is_active' => 'boolean',
            'contentInput' => 'nullable|string',
            'contactName' => 'nullable|string|max:255',
            'contactEmail' => 'nullable|email|max:255',
            'contactPhone' => 'nullable|string|max:20',
        ];
    }

    #[Computed]
    public function partnerships()
    {
        return Partnership::latest()
            ->paginate(10);
    }

    #[Computed]
    public function partnershipTypes()
    {
        return Partnership::$types;
    }

    public function create()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function edit($partnershipId)
    {
        $partnership = Partnership::findOrFail($partnershipId);
        $this->editingPartnershipId = $partnership->id;
        $this->type = $partnership->type;
        $this->title = $partnership->title;
        $this->description = $partnership->description;
        $this->content = $partnership->content ?? [];
        $this->contact_info = $partnership->contact_info ?? [];
        $this->is_active = $partnership->is_active;
        $this->banner = null;
        $this->document = null;

        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $partnershipData = [
            'type' => $this->type,
            'title' => $this->title,
            'description' => $this->description,
            'content' => $this->content,
            'contact_info' => array_filter($this->contact_info, fn ($contact) => 
                !empty($contact['name']) || !empty($contact['email']) || !empty($contact['phone'])
            ),
            'is_active' => $this->is_active,
        ];

        if ($this->banner) {
            if ($this->editingPartnershipId) {
                $existingPartnership = Partnership::findOrFail($this->editingPartnershipId);
                if ($existingPartnership->banner) {
                    Storage::delete($existingPartnership->banner);
                }
            }
            $partnershipData['banner'] = $this->banner->store('partnerships/banners', 'public');
        }

        if ($this->document) {
            if ($this->editingPartnershipId) {
                $existingPartnership = Partnership::findOrFail($this->editingPartnershipId);
                if ($existingPartnership->document) {
                    Storage::delete($existingPartnership->document);
                }
            }
            $partnershipData['document'] = $this->document->store('partnerships/documents', 'public');
        }

        if ($this->editingPartnershipId) {
            $partnership = Partnership::findOrFail($this->editingPartnershipId);
            $partnership->update($partnershipData);
            $message = 'Partnership berhasil diperbarui!';
        } else {
            Partnership::create($partnershipData);
            $message = 'Partnership berhasil dibuat!';
        }

        $this->resetForm();
        $this->showModal = false;

        session()->flash('message', $message);
    }

    public function delete($partnershipId)
    {
        $partnership = Partnership::findOrFail($partnershipId);

        if ($partnership->banner) {
            Storage::delete($partnership->banner);
        }

        if ($partnership->document) {
            Storage::delete($partnership->document);
        }

        $partnership->delete();
        session()->flash('message', 'Partnership berhasil dihapus!');

        $this->modal("delete-partnership-{$partnershipId}")->close();
    }

    public function addContent()
    {
        if (!empty(trim($this->contentInput))) {
            $this->content[] = trim($this->contentInput);
            $this->contentInput = '';
        }
    }

    public function removeContent($index)
    {
        if (isset($this->content[$index])) {
            unset($this->content[$index]);
            $this->content = array_values($this->content);
        }
    }

    public function addContact()
    {
        if ($this->contactName || $this->contactEmail || $this->contactPhone) {
            $this->contact_info[] = [
                'name' => $this->contactName,
                'email' => $this->contactEmail,
                'phone' => $this->contactPhone,
            ];

            $this->contactName = '';
            $this->contactEmail = '';
            $this->contactPhone = '';
        }
    }

    public function removeContact($index)
    {
        if (isset($this->contact_info[$index])) {
            unset($this->contact_info[$index]);
            $this->contact_info = array_values($this->contact_info);
        }
    }

    public function resetForm()
    {
        $this->reset([
            'type', 'title', 'description', 'content', 'contact_info',
            'banner', 'document', 'is_active', 'editingPartnershipId',
            'contentInput', 'contactName', 'contactEmail', 'contactPhone',
        ]);

        $this->is_active = true;
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.manage-partnerships');
    }
}