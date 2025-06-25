<?php

namespace App\Livewire;

use App\Models\Department;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ManageDepartments extends Component
{
    use WithPagination, WithFileUploads;

    public $title = '';
    public $description = '';
    public $division = '';
    public $logo;
    public $editingDepartmentId = null;
    public $showModal = false;
    public $search = '';

    public function rules(): array
    {
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'division' => 'required|string|in:Internal,PSTI,Eksternal',
            'logo' => 'nullable|image|max:2048',
        ];

        if ($this->editingDepartmentId) {
            $rules['title'] .= '|unique:departments,title,' . $this->editingDepartmentId;
        } else {
            $rules['title'] .= '|unique:departments,title';
        }

        return $rules;
    }

    #[Computed]
    public function departments()
    {
        return Department::when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%')
                      ->orWhere('division', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);
    }

    #[Computed]
    public function divisions()
    {
        return ['Internal', 'PSTI', 'Eksternal'];
    }

    public function create()
    {
        $this->reset(['title', 'description', 'division', 'logo', 'editingDepartmentId']);
        $this->showModal = true;
    }

    public function edit($departmentId)
    {
        $department = Department::findOrFail($departmentId);
        $this->editingDepartmentId = $department->id;
        $this->title = $department->title;
        $this->description = $department->description;
        $this->division = $department->division;
        $this->logo = null;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $departmentData = [
            'title' => $this->title,
            'description' => $this->description,
            'division' => $this->division,
        ];

        if ($this->logo) {
            if ($this->editingDepartmentId) {
                $existingDepartment = Department::findOrFail($this->editingDepartmentId);
                if ($existingDepartment->logo) {
                    Storage::delete($existingDepartment->logo);
                }
            }
            $departmentData['logo'] = $this->logo->store('departments', 'public');
        }

        if ($this->editingDepartmentId) {
            $department = Department::findOrFail($this->editingDepartmentId);
            $department->update($departmentData);
        } else {
            $department = Department::create($departmentData);
        }

        $message = $this->editingDepartmentId ? 'Department berhasil diperbarui!' : 'Department berhasil dibuat!';

        $this->reset(['title', 'description', 'division', 'logo', 'editingDepartmentId']);
        $this->showModal = false;

        session()->flash('message', $message);
    }

    public function delete($departmentId)
    {
        $department = Department::findOrFail($departmentId);

        if ($department->logo) {
            Storage::delete($department->logo);
        }

        $department->delete();
        session()->flash('message', 'Department berhasil dihapus!');

        $this->modal("delete-department-{$departmentId}")->close();
    }

    public function resetForm()
    {
        $this->reset(['title', 'description', 'division', 'logo', 'editingDepartmentId']);
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.manage-departments');
    }
}
