<?php

namespace App\Livewire\Posts;

use Livewire\Component;

class CreatePost extends Component
{

    public $title = 'my first title';
    public function render()
    {
        return view('livewire.posts.create-post');
    }
}
