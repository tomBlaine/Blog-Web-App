<div>
    <input wire:model="search-users" type="text" placeholder="Search users and posts..."/>
    <ul>
        @if($users)
        @foreach($users as $user)
            <li>{{ $user->username }}</li>
        @endforeach
        @endif
    </ul>
</div>