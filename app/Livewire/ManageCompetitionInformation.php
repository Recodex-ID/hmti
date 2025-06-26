<?php

namespace App\Livewire;

use App\Models\CompetitionInformation;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ManageCompetitionInformation extends Component
{
    use WithPagination, WithFileUploads;

    public $title = '';
    public $description = '';
    public $content = '';
    public $image_path;
    public $category = '';
    public $level = 'Local';
    public $start_date = '';
    public $end_date = '';
    public $organizer = '';
    public $registration_fee = '';
    public $registration_deadline = '';
    public $rules_regulations = '';
    public $prizes = '';
    public $requirements = '';
    public $contact_person = '';
    public $contact_phone = '';
    public $contact_email = '';
    public $website_url = '';
    public $is_active = true;
    public $editingCompetitionInformationId = null;
    public $showModal = false;
    public $search = '';

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'image_path' => 'nullable|image|max:2048',
            'category' => 'required|string|max:255',
            'level' => 'required|string|in:Local,National,International',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'organizer' => 'required|string|max:255',
            'registration_fee' => 'nullable|numeric|min:0',
            'registration_deadline' => 'required|date',
            'rules_regulations' => 'required|string',
            'prizes' => 'nullable|string',
            'requirements' => 'required|string',
            'contact_person' => 'required|string|max:255',
            'contact_phone' => 'required|string|max:255',
            'contact_email' => 'required|email|max:255',
            'website_url' => 'nullable|url|max:255',
            'is_active' => 'boolean',
        ];
    }

    #[Computed]
    public function competitionInformation()
    {
        return CompetitionInformation::when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%')
                      ->orWhere('category', 'like', '%' . $this->search . '%')
                      ->orWhere('organizer', 'like', '%' . $this->search . '%');
            })
            ->with('creator')
            ->latest()
            ->paginate(10);
    }

    #[Computed]
    public function levels()
    {
        return ['Local', 'National', 'International'];
    }

    public function create()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function edit($competitionInformationId)
    {
        $competitionInformation = CompetitionInformation::findOrFail($competitionInformationId);
        $this->editingCompetitionInformationId = $competitionInformation->id;
        $this->title = $competitionInformation->title;
        $this->description = $competitionInformation->description;
        $this->content = $competitionInformation->content;
        $this->category = $competitionInformation->category;
        $this->level = $competitionInformation->level;
        $this->start_date = $competitionInformation->start_date->format('Y-m-d\TH:i');
        $this->end_date = $competitionInformation->end_date->format('Y-m-d\TH:i');
        $this->organizer = $competitionInformation->organizer;
        $this->registration_fee = $competitionInformation->registration_fee;
        $this->registration_deadline = $competitionInformation->registration_deadline->format('Y-m-d\TH:i');
        $this->rules_regulations = $competitionInformation->rules_regulations;
        $this->prizes = $competitionInformation->prizes;
        $this->requirements = $competitionInformation->requirements;
        $this->contact_person = $competitionInformation->contact_person;
        $this->contact_phone = $competitionInformation->contact_phone;
        $this->contact_email = $competitionInformation->contact_email;
        $this->website_url = $competitionInformation->website_url;
        $this->is_active = $competitionInformation->is_active;
        $this->image_path = null;
        
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $competitionInformationData = [
            'title' => $this->title,
            'description' => $this->description,
            'content' => $this->content,
            'category' => $this->category,
            'level' => $this->level,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'organizer' => $this->organizer,
            'registration_fee' => $this->registration_fee,
            'registration_deadline' => $this->registration_deadline,
            'rules_regulations' => $this->rules_regulations,
            'prizes' => $this->prizes,
            'requirements' => $this->requirements,
            'contact_person' => $this->contact_person,
            'contact_phone' => $this->contact_phone,
            'contact_email' => $this->contact_email,
            'website_url' => $this->website_url,
            'is_active' => $this->is_active,
            'created_by' => auth()->id(),
        ];

        if ($this->image_path) {
            if ($this->editingCompetitionInformationId) {
                $existingCompetitionInformation = CompetitionInformation::findOrFail($this->editingCompetitionInformationId);
                if ($existingCompetitionInformation->image_path) {
                    Storage::delete($existingCompetitionInformation->image_path);
                }
            }
            $competitionInformationData['image_path'] = $this->image_path->store('competition-information', 'public');
        }

        if ($this->editingCompetitionInformationId) {
            $competitionInformation = CompetitionInformation::findOrFail($this->editingCompetitionInformationId);
            $competitionInformation->update($competitionInformationData);
        } else {
            $competitionInformation = CompetitionInformation::create($competitionInformationData);
        }

        $message = $this->editingCompetitionInformationId ? 'Informasi Lomba berhasil diperbarui!' : 'Informasi Lomba berhasil dibuat!';

        $this->resetForm();
        $this->showModal = false;

        session()->flash('message', $message);
    }

    public function delete($competitionInformationId)
    {
        $competitionInformation = CompetitionInformation::findOrFail($competitionInformationId);

        if ($competitionInformation->image_path) {
            Storage::delete($competitionInformation->image_path);
        }

        $competitionInformation->delete();
        session()->flash('message', 'Informasi Lomba berhasil dihapus!');

        $this->modal("delete-competition-information-{$competitionInformationId}")->close();
    }

    public function resetForm()
    {
        $this->reset([
            'title', 'description', 'content', 'image_path', 'category', 'level', 'start_date', 'end_date',
            'organizer', 'registration_fee', 'registration_deadline', 'rules_regulations', 'prizes',
            'requirements', 'contact_person', 'contact_phone', 'contact_email', 'website_url',
            'is_active', 'editingCompetitionInformationId'
        ]);
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.manage-competition-information');
    }
}