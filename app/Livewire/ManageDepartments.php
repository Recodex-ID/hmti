<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\DepartmentFunction;
use App\Models\WorkProgram;
use App\Models\Agenda;
use App\Models\Member;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ManageDepartments extends Component
{
    use WithPagination, WithFileUploads;

    // Department properties
    public $title = '';
    public $description = '';
    public $division = '';
    public $logo;
    public $editingDepartmentId = null;
    public $showModal = false;
    public $search = '';
    
    // Tab management
    public $activeTab = 'department';
    
    // Function properties
    public $functionTitle = '';
    public $editingFunctionId = null;
    public $functions = [];
    
    // Work Program properties
    public $programTitle = '';
    public $programDescription = '';
    public $editingProgramId = null;
    public $workPrograms = [];
    
    // Agenda properties
    public $agendaTitle = '';
    public $agendaDescription = '';
    public $editingAgendaId = null;
    public $agendas = [];
    
    // Member properties
    public $memberName = '';
    public $memberPosition = '';
    public $memberPhoto;
    public $memberStartYear = '';
    public $memberEndYear = '';
    public $editingMemberId = null;
    public $members = [];

    public function rules(): array
    {
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'division' => 'required|string|in:Internal,PSTI,Eksternal',
            'logo' => 'nullable|image|max:2048',
            
            // Function rules
            'functionTitle' => 'required|string|max:255',
            
            // Work Program rules
            'programTitle' => 'required|string|max:255',
            'programDescription' => 'nullable|string',
            
            // Agenda rules
            'agendaTitle' => 'required|string|max:255',
            'agendaDescription' => 'nullable|string',
            
            // Member rules
            'memberName' => 'required|string|max:255',
            'memberPosition' => 'required|string|in:head,staff',
            'memberPhoto' => 'nullable|image|max:2048',
            'memberStartYear' => 'required|integer|min:2000|max:' . ((int)date('Y') + 10),
            'memberEndYear' => 'nullable|integer|min:2000|max:' . ((int)date('Y') + 10) . '|gte:memberStartYear',
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
            ->withCount(['departmentFunctions', 'workPrograms', 'agendas', 'members', 'activeMembers'])
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
        $this->resetDepartmentForm();
        $this->activeTab = 'department';
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
        
        // Load related data
        $this->loadRelatedData($departmentId);
        
        $this->activeTab = 'department';
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|string|max:255' . ($this->editingDepartmentId ? '|unique:departments,title,' . $this->editingDepartmentId : '|unique:departments,title'),
            'description' => 'nullable|string',
            'division' => 'required|string|in:Internal,PSTI,Eksternal',
            'logo' => 'nullable|image|max:2048',
        ]);

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
            $departmentId = $department->id;
        } else {
            $department = Department::create($departmentData);
            $departmentId = $department->id;
            $this->editingDepartmentId = $departmentId;
        }

        // Save related data
        $this->saveRelatedData($departmentId);

        $message = $this->editingDepartmentId ? 'Departemen berhasil diperbarui!' : 'Departemen berhasil dibuat!';

        $this->resetDepartmentForm();
        $this->resetRelatedData();
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
        session()->flash('message', 'Departemen berhasil dihapus!');

        $this->modal("delete-department-{$departmentId}")->close();
    }

    public function resetForm()
    {
        $this->resetDepartmentForm();
        $this->resetRelatedData();
        $this->resetValidation();
    }
    
    public function resetDepartmentForm()
    {
        $this->reset(['title', 'description', 'division', 'logo', 'editingDepartmentId']);
    }
    
    public function resetRelatedData()
    {
        $this->reset([
            'functions', 'functionTitle', 'editingFunctionId',
            'workPrograms', 'programTitle', 'programDescription', 'editingProgramId',
            'agendas', 'agendaTitle', 'agendaDescription', 'editingAgendaId',
            'members', 'memberName', 'memberPosition', 'memberPhoto', 'memberStartYear', 'memberEndYear', 'editingMemberId'
        ]);
    }
    
    public function loadRelatedData($departmentId)
    {
        $this->functions = DepartmentFunction::where('department_id', $departmentId)->get()->toArray();
        $this->workPrograms = WorkProgram::where('department_id', $departmentId)->get()->toArray();
        $this->agendas = Agenda::where('department_id', $departmentId)->get()->toArray();
        $this->members = Member::where('department_id', $departmentId)->get()->toArray();
    }
    
    // Function management methods
    public function addFunction()
    {
        $this->validateOnly('functionTitle');
        
        if (!$this->editingDepartmentId) {
            $this->addError('functionTitle', 'Simpan departemen terlebih dahulu sebelum menambah fungsi.');
            return;
        }
        
        $this->functions[] = [
            'id' => $this->editingFunctionId ?: 'new_' . count($this->functions),
            'title' => $this->functionTitle,
            'department_id' => $this->editingDepartmentId,
            'is_new' => !$this->editingFunctionId
        ];
        
        $this->reset(['functionTitle', 'editingFunctionId']);
    }
    
    public function editFunction($index)
    {
        $function = $this->functions[$index];
        $this->functionTitle = $function['title'];
        $this->editingFunctionId = $function['id'];
    }
    
    public function removeFunction($index)
    {
        if (isset($this->functions[$index]['id']) && !str_starts_with($this->functions[$index]['id'], 'new_')) {
            $this->functions[$index]['_delete'] = true;
        } else {
            unset($this->functions[$index]);
            $this->functions = array_values($this->functions);
        }
    }
    
    // Work Program management methods
    public function addWorkProgram()
    {
        $this->validateOnly('programTitle');
        
        if (!$this->editingDepartmentId) {
            $this->addError('programTitle', 'Simpan departemen terlebih dahulu sebelum menambah program kerja.');
            return;
        }
        
        $this->workPrograms[] = [
            'id' => $this->editingProgramId ?: 'new_' . count($this->workPrograms),
            'title' => $this->programTitle,
            'description' => $this->programDescription,
            'department_id' => $this->editingDepartmentId,
            'is_new' => !$this->editingProgramId
        ];
        
        $this->reset(['programTitle', 'programDescription', 'editingProgramId']);
    }
    
    public function editWorkProgram($index)
    {
        $program = $this->workPrograms[$index];
        $this->programTitle = $program['title'];
        $this->programDescription = $program['description'] ?? '';
        $this->editingProgramId = $program['id'];
    }
    
    public function removeWorkProgram($index)
    {
        if (isset($this->workPrograms[$index]['id']) && !str_starts_with($this->workPrograms[$index]['id'], 'new_')) {
            $this->workPrograms[$index]['_delete'] = true;
        } else {
            unset($this->workPrograms[$index]);
            $this->workPrograms = array_values($this->workPrograms);
        }
    }
    
    // Agenda management methods
    public function addAgenda()
    {
        $this->validateOnly('agendaTitle');
        
        if (!$this->editingDepartmentId) {
            $this->addError('agendaTitle', 'Simpan departemen terlebih dahulu sebelum menambah agenda.');
            return;
        }
        
        $this->agendas[] = [
            'id' => $this->editingAgendaId ?: 'new_' . count($this->agendas),
            'title' => $this->agendaTitle,
            'description' => $this->agendaDescription,
            'department_id' => $this->editingDepartmentId,
            'is_new' => !$this->editingAgendaId
        ];
        
        $this->reset(['agendaTitle', 'agendaDescription', 'editingAgendaId']);
    }
    
    public function editAgenda($index)
    {
        $agenda = $this->agendas[$index];
        $this->agendaTitle = $agenda['title'];
        $this->agendaDescription = $agenda['description'] ?? '';
        $this->editingAgendaId = $agenda['id'];
    }
    
    public function removeAgenda($index)
    {
        if (isset($this->agendas[$index]['id']) && !str_starts_with($this->agendas[$index]['id'], 'new_')) {
            $this->agendas[$index]['_delete'] = true;
        } else {
            unset($this->agendas[$index]);
            $this->agendas = array_values($this->agendas);
        }
    }
    
    // Member management methods
    public function addMember()
    {
        $this->validateOnly(['memberName', 'memberPosition', 'memberStartYear']);
        
        if (!$this->editingDepartmentId) {
            $this->addError('memberName', 'Simpan departemen terlebih dahulu sebelum menambah anggota.');
            return;
        }
        
        $this->members[] = [
            'id' => $this->editingMemberId ?: 'new_' . count($this->members),
            'name' => $this->memberName,
            'position' => $this->memberPosition,
            'start_year' => $this->memberStartYear,
            'end_year' => $this->memberEndYear,
            'department_id' => $this->editingDepartmentId,
            'is_new' => !$this->editingMemberId
        ];
        
        $this->reset(['memberName', 'memberPosition', 'memberPhoto', 'memberStartYear', 'memberEndYear', 'editingMemberId']);
    }
    
    public function editMember($index)
    {
        $member = $this->members[$index];
        $this->memberName = $member['name'];
        $this->memberPosition = $member['position'];
        $this->memberStartYear = $member['start_year'];
        $this->memberEndYear = $member['end_year'];
        $this->editingMemberId = $member['id'];
    }
    
    public function removeMember($index)
    {
        if (isset($this->members[$index]['id']) && !str_starts_with($this->members[$index]['id'], 'new_')) {
            $this->members[$index]['_delete'] = true;
        } else {
            unset($this->members[$index]);
            $this->members = array_values($this->members);
        }
    }
    
    private function saveRelatedData($departmentId)
    {
        // Save Functions
        foreach ($this->functions as $function) {
            if (isset($function['_delete']) && $function['_delete']) {
                if (!str_starts_with($function['id'], 'new_')) {
                    DepartmentFunction::find($function['id'])?->delete();
                }
            } elseif (isset($function['is_new']) && $function['is_new']) {
                DepartmentFunction::create([
                    'department_id' => $departmentId,
                    'title' => $function['title']
                ]);
            } elseif (!str_starts_with($function['id'], 'new_')) {
                DepartmentFunction::find($function['id'])?->update([
                    'title' => $function['title']
                ]);
            }
        }
        
        // Save Work Programs
        foreach ($this->workPrograms as $program) {
            if (isset($program['_delete']) && $program['_delete']) {
                if (!str_starts_with($program['id'], 'new_')) {
                    WorkProgram::find($program['id'])?->delete();
                }
            } elseif (isset($program['is_new']) && $program['is_new']) {
                WorkProgram::create([
                    'department_id' => $departmentId,
                    'title' => $program['title'],
                    'description' => $program['description']
                ]);
            } elseif (!str_starts_with($program['id'], 'new_')) {
                WorkProgram::find($program['id'])?->update([
                    'title' => $program['title'],
                    'description' => $program['description']
                ]);
            }
        }
        
        // Save Agendas
        foreach ($this->agendas as $agenda) {
            if (isset($agenda['_delete']) && $agenda['_delete']) {
                if (!str_starts_with($agenda['id'], 'new_')) {
                    Agenda::find($agenda['id'])?->delete();
                }
            } elseif (isset($agenda['is_new']) && $agenda['is_new']) {
                Agenda::create([
                    'department_id' => $departmentId,
                    'title' => $agenda['title'],
                    'description' => $agenda['description']
                ]);
            } elseif (!str_starts_with($agenda['id'], 'new_')) {
                Agenda::find($agenda['id'])?->update([
                    'title' => $agenda['title'],
                    'description' => $agenda['description']
                ]);
            }
        }
        
        // Save Members
        foreach ($this->members as $member) {
            if (isset($member['_delete']) && $member['_delete']) {
                if (!str_starts_with($member['id'], 'new_')) {
                    Member::find($member['id'])?->delete();
                }
            } elseif (isset($member['is_new']) && $member['is_new']) {
                Member::create([
                    'department_id' => $departmentId,
                    'name' => $member['name'],
                    'position' => $member['position'],
                    'start_year' => $member['start_year'],
                    'end_year' => $member['end_year']
                ]);
            } elseif (!str_starts_with($member['id'], 'new_')) {
                Member::find($member['id'])?->update([
                    'name' => $member['name'],
                    'position' => $member['position'],
                    'start_year' => $member['start_year'],
                    'end_year' => $member['end_year']
                ]);
            }
        }
    }

    public function render()
    {
        return view('livewire.manage-departments');
    }
}
