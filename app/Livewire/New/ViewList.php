<?php

namespace App\Livewire\New;

use App\Models\NewPost;
use Livewire\Component;

class ViewList extends Component
{
    public $posts;
    public function mount()
    {
       $this->posts = NewPost::latest()->get();
    }
    public function render()
    {
        return view('livewire.new.view-list');
    }
}
