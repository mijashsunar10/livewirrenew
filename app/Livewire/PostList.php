<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class PostList extends Component
{
    public $posts;

    // public function mount()
    // {
        
    //     $this->posts = Post::latest()->get();

    // }

    public function mount()
    {
        $this->posts = Post::latest()->get(); //only active posts
    }
    //mount is like the constuctor which is intialized automatically
    // Livewire needs to load some data right at the beginning. mount() is a special method that runs automatically when the Livewire component starts.
    // as soon as the component starts, it automatically runs loadPosts() which contains $posts with active posts and $traashedposts with deleted posts
    public function delete($id)
    {
        $post = Post::find($id);

        if($post)
        {
            $post->delete();
            session()->flash('message', 'Post moved to trash');
            $this->posts = Post::latest()->get(); // Refresh the list
        }
    }


    public function render()
    {
        // return view('livewire.post-list',['posts'=>Post::latest()->get()]);
        return view('livewire.post-list');
    }
}
