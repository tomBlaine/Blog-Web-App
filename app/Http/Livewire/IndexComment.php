<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use App\Models\Tag;

class IndexComment extends Component
{
    public $comments;
    public $postId;

    public function mount($postId)
    {
        $this->postId = $postId;
        $this->comments = Comment::where('post_id', $postId)->get();

    }

    public function render()
    {
        return view('livewire.index-comment');
    }

}
