<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostForm extends Component
{
    use WithFileUploads;
    public $title, $description,$image; //what things you are gonne use in blade file are defined here livewire use them reactively

    public function submit()
    {
         // Validates the inputs: title is required, must be a string, and max 255 chars; description must be a string and required
         $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048', // Validate the image file
        ]);

        $imagePath = $this->image ? $this->image->store('images', 'public') : null;

            //$this->image:(wire:model="image").First of all check if its a image if yes it stored if not return null.

             // Creates a new post record in the database using the values from the form
             Post::create([
                'title' => $this->title,
                'description' => $this->description,
                'image' => $imagePath,  // Save the image path
            ]);

             // Resets the form fields (clears the inputs)
             $this->reset(['title', 'description', 'image']);  // Reset the correct properties

             // Set a success message
             session()->flash('message', 'Post created successfully!');
         
             // Redirect after form submission
             return redirect()->route('posts.view');

                
            // Sets a temporary success message that can be shown in the view
            // session()->flash('message', 'Post created successfully!');  
            // return redirect()->route('posts.view');
            // return redirect()->route('posts.view')->with('message','Post created successfully');

    }
    public function render()
    {
        return view('livewire.post-form');
    }
}
