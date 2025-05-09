<?php

namespace App\Livewire\New;

use App\Models\NewPost;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreatePost extends Component
{
    use WithFileUploads;
     protected $listeners = ['tinymce:refresh' => '$refresh'];

    public $title;
    public $description;
    public $image;
    public $message;

    // protected $listeners = ['tinymce:refresh' => '$refresh'];

    public function submit()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|max:2048',
        ]);

        $imagePath = $this->image->store('images1', 'public');

        NewPost::create([
            'title' => $this->title,
            'description' => $this->description,
            'image' => $imagePath,
        ]);

        // Reset form fields
        $this->reset(['title', 'description', 'image']);
        
        // Dispatch event to refresh TinyMCE
        $this->dispatch('tinymce:refresh');
         
        session()->flash('message', 'Post created successfully');
        return redirect()->route('new.view');
    }

    public function render()
    {
        return view('livewire.new.create-post');
    }
}