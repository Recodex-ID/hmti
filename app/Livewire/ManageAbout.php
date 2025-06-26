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
    public $missionInput = '';

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
        ];
    }

    #[Computed]
    public function about()
    {
        return About::current() ?? new About();
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
        }

        $this->structural = null;
        $this->banner = null;
        $this->ad_art = null;
    }


    public function addMission()
    {
        if (!empty(trim($this->missionInput))) {
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

    public function save()
    {
        $this->validate();

        $aboutData = [
            'definition' => $this->definition,
            'position_role' => $this->position_role,
            'vision' => $this->vision,
            'mission' => $this->mission,
            'link_youtube' => $this->link_youtube,
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
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.manage-about');
    }
}
