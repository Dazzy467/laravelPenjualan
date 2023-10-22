<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Style -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <script src="https://kit.fontawesome.com/0181a7fc6f.js" crossorigin="anonymous"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm position-fixed z-2 w-100">
            <div class="container">
                <a class="navbar-brand d-flex" href="{{ url('/') }}">
                    <div><img src="{{__('/img/logo.png')}}" style="height: 30px; border-right: 1px solid;" class="pe-3"></img></div>
                    <div class="ps-3">
                        {{ config('app.name', 'Laravel') }}
                    </div>
                    
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
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
            <div style="margin-top: 33px;">
                @yield('sidebar')
            </div>                    
            

            <div id="adminpanel">
                @yield('adminpanel')
                
            </div>

            <div id="userpanel">
                @yield('content')
            </div>
            

            <script>
                const sidebar = document.getElementById('sidebar');
                const toggleButton = document.getElementById('toggleSidebar');
                const sidebarCollapse = document.getElementById('sidebarCollapse');
                const labels = document.getElementsByClassName('nav-label');
                const content = document.getElementById('adminpanel');
                const sidebarToggleDiv = document.getElementById('sidebarToggleDiv');

                toggleButton.addEventListener('click', () => {
                    if (sidebar.classList.contains('sidebar-open')) {
                        sidebar.classList.remove('sidebar-open');
                        sidebar.classList.add('sidebar-collapsed');

                        for (let i = 0; i < labels.length; i++) {
                            labels[i].style.display = 'none';
                            
                            
                        }
                        sidebarToggleDiv.classList.remove('justify-content-end');
                        sidebarToggleDiv.classList.add('justify-content-center');
                        content.style.marginLeft = '90px';
                        
                        
                    } else {
                        sidebar.classList.remove('sidebar-collapsed');
                        sidebar.classList.add('sidebar-open');
                        for (let i = 0; i < labels.length; i++) {
                            labels[i].style.display = 'block';
                            
                        }
                        content.style.marginLeft = '320px';
                        sidebarToggleDiv.classList.remove('justify-content-center');
                        sidebarToggleDiv.classList.add('justify-content-end');
                    }
                });
            </script>
        </main>
    </div>
</body>
</html>
