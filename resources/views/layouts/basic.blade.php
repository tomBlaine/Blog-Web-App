<!DOCTYPE html>

<head>
    <title>Blog Application - @yield('title')</title>
    @livewireStyles
</head>

<body>
    @livewireScripts
    <h1>Toms Blog App - @yield('title')</h1>


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