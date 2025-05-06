<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostEdit extends Component
{
     use WithFileUploads;
    // These public properties are used to bind data to the form fields in the Blade file.
    // Livewire automatically keeps them in sync with the UI via wire:model.
    public $postId, $title, $description,$image,$oldImage;

     //The mount() method is called when the component is first loaded.

    public function mount($id)
    {
         // Tries to find the post by its ID.
        $post = Post::find($id);

        if ($post) {

        $this->postId = $post->id;
        $this->title = $post->title;
        $this->description = $post->description;
        $this->oldImage = $post->image;

        } 
        else {
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
            'image' => 'nullable|image|max:2048',
        ]);
        $post = Post::find($this->postId);  

        if (!$post) {
            session()->flash('message', 'Post not found!');
            return redirect()->route('posts.view');
        }

        // // If a new image is uploaded, store it and update the path
        if ($this->image) { //This checks if a new image file has been uploaded , wire:model="image"
            // Store the new image and get the path
            if ($this->oldImage && Storage::disk('public')->exists($this->oldImage)) {    //The image file actually exists in the public disk (which maps to storage/app/public).
                Storage::disk('public')->delete($this->oldImage);  //If both conditions above are true, this line deletes the old image from the storage/app/public folder to free up space and avoid leaving unused files.
            }
            $imagePath = $this->image->store('images', 'public'); //After deleting the old image, this line stores the new uploaded image in the storage/app/public/images directory.
        } 
        else 
        {
             // Keep the old image if no new image is uploaded
             $imagePath = $this->oldImage;
        }
      
        
            $post->update([
                'title'=>$this->title,
                'description'=>$this->description,
                'image' => $imagePath,  
            ]);
            session()->flash('message', 'Post updated successfully!');
            return redirect()->route('posts.view');
       

    }

   
    public function render()
    {
        return view('livewire.post-edit');
    }
}
