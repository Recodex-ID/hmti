<?php

namespace App\Livewire;

use App\Models\News;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ManageNews extends Component
{
    use WithPagination, WithFileUploads;

    public $title = '';
    public $excerpt = '';
    public $content = '';
    public $featured_image;
    public $category = '';
    public $tags = '';
    public $is_featured = false;
    public $is_published = true;
    public $published_at = '';
    public $editingNewsId = null;
    public $showModal = false;
    public $search = '';

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|max:2048',
            'category' => 'required|string|max:255',
            'tags' => 'nullable|string',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
        ];
    }

    #[Computed]
    public function news()
    {
        return News::when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('excerpt', 'like', '%' . $this->search . '%')
                      ->orWhere('category', 'like', '%' . $this->search . '%');
            })
            ->with('author')
            ->latest()
            ->paginate(10);
    }

    #[Computed]
    public function categories()
    {
        return ['Technology', 'Achievement', 'Environment', 'International', 'Research', 'Alumni', 'Innovation', 'Education', 'Event'];
    }

    public function create()
    {
        $this->resetForm();
        $this->published_at = now()->format('Y-m-d\TH:i');
        $this->showModal = true;
    }

    public function edit($newsId)
    {
        $news = News::findOrFail($newsId);
        $this->editingNewsId = $news->id;
        $this->title = $news->title;
        $this->excerpt = $news->excerpt;
        $this->content = $news->content;
        $this->category = $news->category;
        $this->tags = is_array($news->tags) ? implode(', ', $news->tags) : '';
        $this->is_featured = $news->is_featured;
        $this->is_published = $news->is_published;
        $this->published_at = $news->published_at?->format('Y-m-d\TH:i');
        $this->featured_image = null;
        
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $newsData = [
            'title' => $this->title,
            'excerpt' => $this->excerpt,
            'content' => $this->content,
            'category' => $this->category,
            'tags' => $this->tags ? array_map('trim', explode(',', $this->tags)) : null,
            'is_featured' => $this->is_featured,
            'is_published' => $this->is_published,
            'published_at' => $this->published_at,
            'author_id' => auth()->id(),
        ];

        if ($this->featured_image) {
            if ($this->editingNewsId) {
                $existingNews = News::findOrFail($this->editingNewsId);
                if ($existingNews->featured_image) {
                    Storage::delete($existingNews->featured_image);
                }
            }
            $newsData['featured_image'] = $this->featured_image->store('news', 'public');
        }

        if ($this->editingNewsId) {
            $news = News::findOrFail($this->editingNewsId);
            $news->update($newsData);
        } else {
            $news = News::create($newsData);
        }

        $message = $this->editingNewsId ? 'Berita berhasil diperbarui!' : 'Berita berhasil dibuat!';

        $this->resetForm();
        $this->showModal = false;

        session()->flash('message', $message);
    }

    public function delete($newsId)
    {
        $news = News::findOrFail($newsId);

        if ($news->featured_image) {
            Storage::delete($news->featured_image);
        }

        $news->delete();
        session()->flash('message', 'Berita berhasil dihapus!');

        $this->modal("delete-news-{$newsId}")->close();
    }

    public function resetForm()
    {
        $this->reset([
            'title', 'excerpt', 'content', 'featured_image', 'category', 'tags',
            'is_featured', 'is_published', 'published_at', 'editingNewsId'
        ]);
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.manage-news');
    }
}