<!DOCTYPE html>
<style>
.menu-bar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  height: 60px;
  background-color: rgba(0, 0, 0, 0.378);
  color: #fff;
}

.menu-item {
  padding: 0 20px;
  font-size: 16px;
  cursor: pointer;
  font-family: "Helvetica", sans-serif;
  flex-grow:1;
}
.right-menu {
  display: flex;
  align-items: center;
}

.menu-item:hover {
  background-color: #444;
}

.custom-link {
    color: rgb(255, 255, 255);
    text-decoration: none;
}
body {

    background-image: linear-gradient(to right, #ddd6f3, #faaca8);
}
ul {
    list-style-type:circle;
}
li {
    font-family:Verdana, Geneva, Tahoma, sans-serif;
    font-size: 14px;
}
p {
    font-family:Verdana, Geneva, Tahoma, sans-serif;
    }
a{
    color: rgb(0, 0, 0);
    text-decoration: none;
    font-weight:bold; 
    line-height: 20px;
}
button{
        background-color: transparent;
        font-weight: bold;
}



</style>
<head>
    <title> - @yield('title')</title>
    @livewireStyles
    
</head>

<div class="menu-bar">
    <div class="menu-item"><a href={{route('posts.index')}} class="custom-link">Timeline</a></div>
    <div class="menu-item create-post"><a href={{route('posts.create')}} class="custom-link">Create Post</a></div>
    <div class="right-menu">
    @Auth
    <div class="menu-item"><a href={{route('profile.edit')}} class="custom-link">View profile</a></div>
    <div class="menu-item">
        <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button style="color: white">Log out</button>
    </form></div>
    @endauth
    @guest
        <div class="menu-item"><a href={{route('login')}} class="custom-link">Sign in</a></div>
        <div class="menu-item"><a href={{route('register')}} class="custom-link">Register</a></div>
    @endguest
    
    </div>
</div>
<body>
    @livewireScripts



    @if($errors->any())
        <div>
            Errors:
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div>
        @yield('content')
    </div>

</html>