<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;


class Search extends Component
{

    public $search = '';

    public function render()
    {

        if($this->search) {
            $users =  User::where('username', 'like', "%{$this->search}%")->get();
		} else {
            $users = collect();
        }
        
        return view('livewire.search',[ 'users' => $users]);
    }


}
