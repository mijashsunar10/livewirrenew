<?php

namespace App\Livewire;

use Livewire\Component;

class CreatePost extends Component
{
    public $title = 'First Title....';
    public function render()
    {
        return view('livewire.create-post');
    }
}
