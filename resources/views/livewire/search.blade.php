
<div class="search-container">
    <input wire:model="search" wire:key="search" type="text" placeholder="Search users and posts..." style="width: 30%; font-size: 16px; font-family: sans-serif; background: none; color: black; font-weight: bold;" "/>
    
        @if($users)
        <ul class="search-results">
        @foreach($users as $user)
            <li wire:key="{{$user->id }}"><a href={{route('users.show', ['id'=>$user->id])}}>@ {{ $user->username }}</a></li>
        @endforeach
        @foreach($posts as $post)
            <li wire:key="{{$post->id }}"><a href={{route('posts.show', ['id'=>$post->id])}}>{{ $post->title }}</a></li>
        @endforeach
        </ul>
        @endif
    
</div>



