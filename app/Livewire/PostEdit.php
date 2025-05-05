<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class PostEdit extends Component
{
    // These public properties are used to bind data to the form fields in the Blade file.
// Livewire automatically keeps them in sync with the UI via wire:model.
    public $postId, $title, $description;

     //The mount() method is called when the component is first loaded.

    public function mount($id)
    {
         // Tries to find the post by its ID.
        $post = Post::find($id);

        if ($post) {

        $this->postId = $post->id;
        $this->title = $post->title;
        $this->description = $post->description;

        } else {
            // If no post is found, flash an error message and redirect the user back to the view page.
            session()->flash('message', 'Post not found!');
            return redirect()->route('posts.view');
        }
    }

    public function update()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        $post = Post::find($this->postId);
         
        if ($post)

        {
            $post->update([
                'title'=>$this->title,
                'description'=>$this->description,
            ]);
            session()->flash('message', 'Post updated successfully!');
            return redirect()->route('posts.view');
        }
        else
        {

        session()->flash('message', 'Post not found!');
        return redirect()->route('posts.view');
        }


    }

   
    public function render()
    {
        return view('livewire.post-edit');
    }
}
