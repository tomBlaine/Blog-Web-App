<style>
    .comment-container {
        display: flex;
    }

</style>
<p>Comments: </p>
    <ul>
        @foreach ($comments as $comment)

            <li><a href={{route('users.show', ['id'=>$comment->user_id])}}>{{$comment->User->username}}: </a>
            <div class="comment-container">

                <div class="comment-text">{{$comment->comment_text}}</div>
                  
            
            
            @auth
                @if($comment->user_id == auth()->user()->id || auth()->user()->privileges>1 || $comment->post->user_id == auth()->user()->id)
                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
                @endif

                @if($comment->user_id == auth()->user()->id || auth()->user()->privileges>1)
                    <a href={{route('comments.edit', ['id'=>$comment, 'id2'=>$comment->post->id])}}>Edit Comment</a>
                @endif
            @endauth
            </div>

            <br>
            </li>
        @endforeach
    </ul>