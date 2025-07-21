<?php

namespace App\Livewire;

use App\Models\CircularLetter;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ManageCircularLetters extends Component
{
    use WithPagination, WithFileUploads;

    public $title = '';
    public $description = '';
    public $content = '';
    public $file_path;
    public $number = '';
    public $letter_date = '';
    public $is_active = true;
    public $editingCircularLetterId = null;
    public $showModal = false;

    public function rules(): array
    {
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'file_path' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'number' => 'required|string|max:255',
            'letter_date' => 'required|date',
            'is_active' => 'boolean',
        ];

        if ($this->editingCircularLetterId) {
            $rules['number'] .= '|unique:circular_letters,number,' . $this->editingCircularLetterId;
        } else {
            $rules['number'] .= '|unique:circular_letters,number';
        }

        return $rules;
    }

    #[Computed]
    public function circularLetters()
    {
        return CircularLetter::with('creator')
            ->latest()
            ->paginate(10);
    }

    public function create()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function edit($circularLetterId)
    {
        $circularLetter = CircularLetter::findOrFail($circularLetterId);
        $this->editingCircularLetterId = $circularLetter->id;
        $this->title = $circularLetter->title;
        $this->description = $circularLetter->description;
        $this->content = $circularLetter->content;
        $this->number = $circularLetter->number;
        $this->letter_date = $circularLetter->letter_date->format('Y-m-d');
        $this->is_active = $circularLetter->is_active;
        $this->file_path = null;

        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $circularLetterData = [
            'title' => $this->title,
            'description' => $this->description,
            'content' => $this->content,
            'number' => $this->number,
            'letter_date' => $this->letter_date,
            'is_active' => $this->is_active,
            'created_by' => auth()->id(),
        ];

        if ($this->file_path) {
            if ($this->editingCircularLetterId) {
                $existingCircularLetter = CircularLetter::findOrFail($this->editingCircularLetterId);
                if ($existingCircularLetter->file_path) {
                    Storage::delete($existingCircularLetter->file_path);
                }
            }
            $circularLetterData['file_path'] = $this->file_path->store('circular-letters', 'public');
        }

        if ($this->editingCircularLetterId) {
            $circularLetter = CircularLetter::findOrFail($this->editingCircularLetterId);
            $circularLetter->update($circularLetterData);
        } else {
            $circularLetter = CircularLetter::create($circularLetterData);
        }

        $message = $this->editingCircularLetterId ? 'Surat Edaran berhasil diperbarui!' : 'Surat Edaran berhasil dibuat!';

        $this->resetForm();
        $this->showModal = false;

        session()->flash('message', $message);
    }

    public function delete($circularLetterId)
    {
        $circularLetter = CircularLetter::findOrFail($circularLetterId);

        if ($circularLetter->file_path) {
            Storage::delete($circularLetter->file_path);
        }

        $circularLetter->delete();
        session()->flash('message', 'Surat Edaran berhasil dihapus!');

        $this->modal("delete-circular-letter-{$circularLetterId}")->close();
    }

    public function resetForm()
    {
        $this->reset(['title', 'description', 'content', 'file_path', 'number', 'letter_date', 'is_active', 'editingCircularLetterId']);
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.manage-circular-letters');
    }
}
