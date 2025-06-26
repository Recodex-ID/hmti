<?php

namespace App\Livewire;

use App\Models\ActivityInformation;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ManageActivityInformation extends Component
{
    use WithPagination, WithFileUploads;

    public $title = '';
    public $description = '';
    public $content = '';
    public $image_path;
    public $location = '';
    public $start_date = '';
    public $end_date = '';
    public $organizer = '';
    public $registration_fee = '';
    public $registration_deadline = '';
    public $requirements = '';
    public $contact_person = '';
    public $contact_phone = '';
    public $contact_email = '';
    public $is_active = true;
    public $editingActivityInformationId = null;
    public $showModal = false;
    public $search = '';

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'image_path' => 'nullable|image|max:2048',
            'location' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'organizer' => 'required|string|max:255',
            'registration_fee' => 'nullable|numeric|min:0',
            'registration_deadline' => 'nullable|date',
            'requirements' => 'nullable|string',
            'contact_person' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'is_active' => 'boolean',
        ];
    }

    #[Computed]
    public function activityInformation()
    {
        return ActivityInformation::when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%')
                      ->orWhere('location', 'like', '%' . $this->search . '%')
                      ->orWhere('organizer', 'like', '%' . $this->search . '%');
            })
            ->with('creator')
            ->latest()
            ->paginate(10);
    }

    public function create()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function edit($activityInformationId)
    {
        $activityInformation = ActivityInformation::findOrFail($activityInformationId);
        $this->editingActivityInformationId = $activityInformation->id;
        $this->title = $activityInformation->title;
        $this->description = $activityInformation->description;
        $this->content = $activityInformation->content;
        $this->location = $activityInformation->location;
        $this->start_date = $activityInformation->start_date->format('Y-m-d\TH:i');
        $this->end_date = $activityInformation->end_date->format('Y-m-d\TH:i');
        $this->organizer = $activityInformation->organizer;
        $this->registration_fee = $activityInformation->registration_fee;
        $this->registration_deadline = $activityInformation->registration_deadline?->format('Y-m-d\TH:i');
        $this->requirements = $activityInformation->requirements;
        $this->contact_person = $activityInformation->contact_person;
        $this->contact_phone = $activityInformation->contact_phone;
        $this->contact_email = $activityInformation->contact_email;
        $this->is_active = $activityInformation->is_active;
        $this->image_path = null;
        
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $activityInformationData = [
            'title' => $this->title,
            'description' => $this->description,
            'content' => $this->content,
            'location' => $this->location,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'organizer' => $this->organizer,
            'registration_fee' => $this->registration_fee,
            'registration_deadline' => $this->registration_deadline,
            'requirements' => $this->requirements,
            'contact_person' => $this->contact_person,
            'contact_phone' => $this->contact_phone,
            'contact_email' => $this->contact_email,
            'is_active' => $this->is_active,
            'created_by' => auth()->id(),
        ];

        if ($this->image_path) {
            if ($this->editingActivityInformationId) {
                $existingActivityInformation = ActivityInformation::findOrFail($this->editingActivityInformationId);
                if ($existingActivityInformation->image_path) {
                    Storage::delete($existingActivityInformation->image_path);
                }
            }
            $activityInformationData['image_path'] = $this->image_path->store('activity-information', 'public');
        }

        if ($this->editingActivityInformationId) {
            $activityInformation = ActivityInformation::findOrFail($this->editingActivityInformationId);
            $activityInformation->update($activityInformationData);
        } else {
            $activityInformation = ActivityInformation::create($activityInformationData);
        }

        $message = $this->editingActivityInformationId ? 'Informasi Kegiatan berhasil diperbarui!' : 'Informasi Kegiatan berhasil dibuat!';

        $this->resetForm();
        $this->showModal = false;

        session()->flash('message', $message);
    }

    public function delete($activityInformationId)
    {
        $activityInformation = ActivityInformation::findOrFail($activityInformationId);

        if ($activityInformation->image_path) {
            Storage::delete($activityInformation->image_path);
        }

        $activityInformation->delete();
        session()->flash('message', 'Informasi Kegiatan berhasil dihapus!');

        $this->modal("delete-activity-information-{$activityInformationId}")->close();
    }

    public function resetForm()
    {
        $this->reset([
            'title', 'description', 'content', 'image_path', 'location', 'start_date', 'end_date',
            'organizer', 'registration_fee', 'registration_deadline', 'requirements',
            'contact_person', 'contact_phone', 'contact_email', 'is_active', 'editingActivityInformationId'
        ]);
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.manage-activity-information');
    }
}