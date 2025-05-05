<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class TrashPosts extends Component
{
    public $trashedPosts;
   
    public function mount()
    {
        $this->trashedPosts = Post::onlyTrashed()->latest()->get();

    }

    public function restore($id)
    {
        $post = Post::onlyTrashed()->find($id); //This line looks for a soft-deleted post onlyTrashed() tells Laravel to search only among soft-deleted records.find($id) tries to get the post with the specified $id.
        if ($post) { //checks if a post was found.
        $post->restore();
        session()->flash('message','yess the message is restored succesflly');
        $this->trashedPosts = Post::onlyTrashed()->latest()->get(); //refreshes the list of soft-deleted posts.
        }
    }

    public function forceDelete($id)
    {
        $post = Post::onlyTrashed()->find($id);
        if($post)
        {
            $post->forceDelete(); //This line permanently deletes the post from the database (bypassing soft deletes).
            session()->flash('message', 'Post permanently deleted!');
            $this->trashedPosts=Post::onlyTrashed()->latest()->get();
        }
    }
    public function render()
    {
        return view('livewire.trash-posts');
    }
}
