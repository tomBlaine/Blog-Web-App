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
            //$users =  User::where('username', 'like', "%{$this->search}%")->get();
            $users = User::where('username', 'like', "{$this->search}%")
                ->orWhere('username', 'like', "%{$this->search}")
                ->orderByRaw("CASE
                    WHEN username LIKE '{$this->search}%' THEN 1
                    ELSE 2
                    END")
                    ->get();

            $posts = Post::where('title', 'like', "{$this->search}%")
                ->orWhere('title', 'like', "%{$this->search}")
                ->orderByRaw("CASE
                    WHEN title LIKE '{$this->search}%' THEN 1
                    ELSE 2
                    END")
                    ->get();
		} else {
            $users = collect();
            $posts = collect();
        }
        
        return view('livewire.search',[ 'users' => $users, 'posts'=>$posts]);
    }


}
