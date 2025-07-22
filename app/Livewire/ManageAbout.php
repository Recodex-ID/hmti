<?php

namespace App\Livewire;

use App\Models\About;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;

class ManageAbout extends Component
{
    use WithFileUploads;

    public $definition = '';

    public $position_role = '';

    public $vision = '';

    public $mission = [];

    public $structural;

    public $banner;

    public $link_youtube = '';

    public $ad_art;

    public $logo_guideline;

    public $grand_design;

    public $anniversary_content = [];

    public $history_content = [];

    public $missionInput = '';

    public $anniversaryInput = '';

    public $historyInput = '';

    public function mount()
    {
        $this->loadAboutData();
    }

    public function rules(): array
    {
        return [
            'definition' => 'required|string',
            'position_role' => 'required|string',
            'vision' => 'required|string',
            'mission' => 'required|array|min:1',
            'mission.*' => 'required|string',
            'structural' => 'nullable|image|max:2048',
            'banner' => 'nullable|image|max:2048',
            'link_youtube' => 'nullable|url',
            'ad_art' => 'nullable|file|mimes:pdf|max:5120', // 5MB max for PDF
            'logo_guideline' => 'nullable|file|mimes:pdf|max:5120',
            'grand_design' => 'nullable|file|mimes:pdf|max:5120',
            'anniversary_content' => 'nullable|array',
            'anniversary_content.*' => 'required|string',
            'history_content' => 'nullable|array',
            'history_content.*' => 'required|string',
        ];
    }

    #[Computed]
    public function about()
    {
        return About::current() ?? new About;
    }

    public function loadAboutData()
    {
        $about = $this->about;

        if ($about->exists) {
            $this->definition = $about->definition ?? '';
            $this->position_role = $about->position_role ?? '';
            $this->vision = $about->vision ?? '';
            $this->mission = $about->mission ?? [];
            $this->link_youtube = $about->link_youtube ?? '';
            $this->anniversary_content = $about->anniversary_content ?? [];
            $this->history_content = $about->history_content ?? [];
        }

        $this->structural = null;
        $this->banner = null;
        $this->ad_art = null;
        $this->logo_guideline = null;
        $this->grand_design = null;
    }

    public function addMission()
    {
        if (! empty(trim($this->missionInput))) {
            $this->mission[] = trim($this->missionInput);
            $this->missionInput = '';
        }
    }

    public function removeMission($index)
    {
        if (isset($this->mission[$index])) {
            unset($this->mission[$index]);
            $this->mission = array_values($this->mission);
        }
    }

    public function addAnniversary()
    {
        if (! empty(trim($this->anniversaryInput))) {
            $this->anniversary_content[] = trim($this->anniversaryInput);
            $this->anniversaryInput = '';
        }
    }

    public function removeAnniversary($index)
    {
        if (isset($this->anniversary_content[$index])) {
            unset($this->anniversary_content[$index]);
            $this->anniversary_content = array_values($this->anniversary_content);
        }
    }

    public function addHistory()
    {
        if (! empty(trim($this->historyInput))) {
            $this->history_content[] = trim($this->historyInput);
            $this->historyInput = '';
        }
    }

    public function removeHistory($index)
    {
        if (isset($this->history_content[$index])) {
            unset($this->history_content[$index]);
            $this->history_content = array_values($this->history_content);
        }
    }

    public function save()
    {
        $this->validate();

        $aboutData = [
            'definition' => $this->definition,
            'position_role' => $this->position_role,
            'vision' => $this->vision,
            'mission' => $this->mission,
            'link_youtube' => $this->link_youtube,
            'anniversary_content' => $this->anniversary_content,
            'history_content' => $this->history_content,
        ];

        if ($this->structural) {
            $existingAbout = About::current();
            if ($existingAbout && $existingAbout->structural) {
                Storage::delete($existingAbout->structural);
            }
            $aboutData['structural'] = $this->structural->store('about', 'public');
        }

        if ($this->banner) {
            $existingAbout = About::current();
            if ($existingAbout && $existingAbout->banner) {
                Storage::delete($existingAbout->banner);
            }
            $aboutData['banner'] = $this->banner->store('about', 'public');
        }

        if ($this->ad_art) {
            $existingAbout = About::current();
            if ($existingAbout && $existingAbout->ad_art) {
                Storage::delete($existingAbout->ad_art);
            }
            $aboutData['ad_art'] = $this->ad_art->store('about/ad-art', 'public');
        }

        if ($this->logo_guideline) {
            $existingAbout = About::current();
            if ($existingAbout && $existingAbout->logo_guideline) {
                Storage::delete($existingAbout->logo_guideline);
            }
            $aboutData['logo_guideline'] = $this->logo_guideline->store('about/logo-guideline', 'public');
        }

        if ($this->grand_design) {
            $existingAbout = About::current();
            if ($existingAbout && $existingAbout->grand_design) {
                Storage::delete($existingAbout->grand_design);
            }
            $aboutData['grand_design'] = $this->grand_design->store('about/grand-design', 'public');
        }

        $about = About::current();
        if ($about) {
            $about->update($aboutData);
            $message = 'Informasi berhasil diperbarui!';
        } else {
            About::create($aboutData);
            $message = 'Informasi berhasil dibuat!';
        }

        $this->loadAboutData();

        session()->flash('message', $message);
    }

    public function resetForm()
    {
        $this->loadAboutData();
        $this->missionInput = '';
        $this->anniversaryInput = '';
        $this->historyInput = '';
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.manage-about');
    }
}
