<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class TrashPosts extends Component
{
    public $trashedPosts;
   
    public function mount() //It runs automatically when the component is initialized
    {
        $this->trashedPosts = Post::onlyTrashed()->latest()->get()->map(function ($post) { 
            //This fetches soft-deleted posts,sorts them by the most recently deleted,retrieves the results as a collection
            $autoDeleteTime = $post->deleted_at->addMinutes(1);
            //For each trashed post, it calculates the time at which the post will be automatically permanently deleted, assumed here to be 1 minute after it was soft-deleted.


            $post->time_left = now()->diffForHumans($autoDeleteTime, true);//This calculates the remaining time until the post is permanently deleted
            $post->will_be_deleted_at = $autoDeleteTime; // This saves the calculated auto-delete time into the post object as a new property will_be_deleted_at
            return $post;//After modifying the post with new properties (time_left, will_be_deleted_at), it returns it back into the collection.
        });
    }

            public function checkAndDeleteExpiredPosts() //This function checks if any trashed (soft-deleted) posts are older than 1 minute and permanently deletes them.
        {
            $now = now(); //now() returns the current date and time using Laravel’s Carbon helper.
            $expiredPosts = Post::onlyTrashed()//Post::onlyTrashed() gets only soft-deleted posts.
                ->where('deleted_at', '<=', $now->subMinutes(1)) //filters posts where deleted_at is 1 minute ago or more.
                //subMinutes(1) subtracts 1 minute from the current time.


                ->get();

            foreach ($expiredPosts as $post) { //Loop through every expired post (that is older than 1 minute and still soft-deleted).
                        // Delete the associated image file if it exists
                if ($post->image) { //Check if this post has an associated image file
                    $path = storage_path('app/public/' . $post->image);
                if (file_exists($path)) {
                    unlink($path); //Check if the image file actually exists on the disk. If it does, delete it using PHP’s unlink() function
                }
                }
                $post->forceDelete();//This permanently deletes the post from the database.//Unlike delete(), forceDelete() bypasses soft deletion and removes the record completely.


            }

            // Refresh the list
            $this->trashedPosts = Post::onlyTrashed()->latest()->get()->map(function ($post) { //After deleting the expired posts, refresh the list of remaining trashed posts.
                //map() is used to add extra information to each post before passing it to the frontend.
                $autoDeleteTime = $post->deleted_at->addMinutes(1); //Calculate the future time when the post will be permanently deleted (1 minute after soft deletion).
                $post->time_left = now()->diffForHumans($autoDeleteTime, true); //Calculate how much time is left before deletion, in human-readable format (like “30 seconds”).
                $post->will_be_deleted_at = $autoDeleteTime; //Save the auto-deletion time as a property so it can be displayed or used later.
                return $post; //Return the updated post with the new properties added 
            });
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
             // Delete the associated image file if it exists
        if ($post->image) {
            $path = storage_path('app/public/' . $post->image);
            if (file_exists($path)) {
                unlink($path);
            }
        }
            $post->forceDelete(); //This line permanently deletes the post from the database (bypassing soft deletes).
            session()->flash('message', 'Post permanently deleted!');
            $this->trashedPosts=Post::onlyTrashed()->latest()->get();
        }
    }
    public function render()
    {
        $this->checkAndDeleteExpiredPosts();//Before rendering the view, this line calls your custom method checkAndDeleteExpiredPosts().
        return view('livewire.trash-posts');
    }
}
