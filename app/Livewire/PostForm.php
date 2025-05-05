<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class PostForm extends Component
{
    public $title, $description; //what things you are gonne use in blade file are defined here livewire use them reactively

    public function submit()
    {
         // Validates the inputs: title is required, must be a string, and max 255 chars; description must be a string and required
        $this->validate(
            [
                'title'=>'required|string|max:255',
                'description'=>'required|string|',

            ]
            );

             // Creates a new post record in the database using the values from the form
            Post::create([
                'title' => $this->title,
                'description' => $this->description,
            ]);

             // Resets the form fields (clears the inputs)
                $this->reset(['title', 'description']);

                
            // Sets a temporary success message that can be shown in the view
            // session()->flash('message', 'Post created successfully!');  
            // return redirect()->route('posts.view');
            return redirect()->route('posts.view')->with('message','Post created successfully');

    }
    public function render()
    {
        return view('livewire.post-form');
    }
}
