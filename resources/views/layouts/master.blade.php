<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>
    </head>
    <body>
        <nav class="top-nav">
            @section('main-nav')
               {{link_to('/', 'Home')}}
            @show
        </nav>
        <div clas="logout">{{link_to('logout', 'Logout')}}</div>
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>