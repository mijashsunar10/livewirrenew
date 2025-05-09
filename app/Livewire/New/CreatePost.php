<?php

namespace App\Livewire\New;

use App\Models\NewPost;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreatePost extends Component
{
    use WithFileUploads;

    public $title, $description, $image;

    public function submit()
    {
        $this->validate([
            'title'=>'required|string|max:255',
            'description'=>'required|string',
            'image'=>'required|image|max:2048',
        ]);

        $imagePath = $this->image?$this->image->store('images1','public'):null;

        NewPost::create(
            [
                'title'=>$this->title,
                'description'=>$this->description,
                'image'=>$imagePath,
            ]
            );
        $this->reset(['title','description','image']);
         
        session()->flash('message','Post created successfully');
        return redirect()->route('new.view');

    }


    public function render()
    {
        return view('livewire.new.create-post');
    }
}
