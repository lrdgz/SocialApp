<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user" content="{{ Auth::user()  }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">

        <nav class="navbar navbar-expand-lg navbar-light bg-white navbar-socialapp">
           <div class="container">
               <a class="navbar-brand" href="{{ route('home') }}">SocialApp</a>
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                   <span class="navbar-toggler-icon"></span>
               </button>

               <div class="collapse navbar-collapse" id="navbarSupportedContent">
                   @auth
                       <ul class="navbar-nav mx-auto">
                           <li class="nav-item active">
                               <a class="nav-link" href="#">Inicio <span class="sr-only">(current)</span></a>
                           </li>
                           <li class="nav-item">
                               <a class="nav-link" href="#">Link</a>
                           </li>
                       </ul>
                   @endauth
                   <ul class="navbar-nav ml-auto">
                       @guest
                           <li class="nav-item dropdown">
                               <a class="nav-link" href="{{ route('login') }}">Login</a>
                           </li>
                       @else
                           <li class="nav-item dropdown">
                               <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                   {{ Auth::user()->name }}
                               </a>
                               <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                   <a class="dropdown-item" href="#">Action</a>
                                   <a class="dropdown-item" href="#">Another action</a>
                                   <div class="dropdown-divider"></div>
                                   <a class="dropdown-item" href="{{ route('logout') }}"
                                      onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                       {{ __('Logout') }}
                                   </a>
                                   <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                       @csrf
                                   </form>
                               </div>
                           </li>
                       @endguest
                   </ul>
               </div>
           </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</body>
</html>
