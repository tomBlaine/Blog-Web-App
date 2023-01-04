<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;

class SearchUsers extends Component
{
    
    public $search = '';

    public function render()
    {


        return view('livewire.search', [
            'users' => User::where('username', 'like', '%'. $this->search .'%')->get(),
        ]);
    }
}
