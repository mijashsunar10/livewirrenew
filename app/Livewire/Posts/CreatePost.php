<?php

namespace App\Livewire\Posts;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreatePost extends Component
{

    public $title = 'my first title';
    public $name1 ;

    public function mount()
    {
        $this->name1 = Auth::user()->name;
        
    }
    public function render()
    {
        return view('livewire.posts.create-post')->with(['author'=>Auth::user()->name,'teacher'=>$this->name1,]);
    }
    
  
}
