<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class PostList extends Component
{
    public $posts;

    public function mount()
    {
        
        $this->posts = Post::latest()->get();

    }
    public function delete($id)
    {
        $post = Post::find($id);

        if($post)
        {
            $post->delete();
            session()->flash('message', 'Post deleted successfully');
            $this->posts = Post::latest()->get(); // Refresh the list
        }
    }


    public function render()
    {
        // return view('livewire.post-list',['posts'=>Post::latest()->get()]);
        return view('livewire.post-list');
    }
}
