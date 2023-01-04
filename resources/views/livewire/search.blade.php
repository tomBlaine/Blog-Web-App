<div>
    <input wire:model="search" wire:key="search" type="text" placeholder="Search users and posts..."/>
    <ul>
        @if($users)
        @foreach($users as $user)
            <li wire:key="{{$user->id }}">{{ $user->username }}</li>
        @endforeach
        @endif
    </ul>
</div>
