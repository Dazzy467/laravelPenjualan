<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
        
        
        

        <!-- Scripts -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>
    <body>
        @section('sidebar')
            <!-- Sidebar -->
            <nav id="sidebar" class="sidebar-open position-fixed z-1 container bg-primary h-100">
                <div id="sidebarToggleDiv" class="d-flex justify-content-end pt-2">
                    <button id="toggleSidebar" class="btn btn-primary toggle-button">
                        <i class="fa-solid fa-bars text-white" style="font-size: 24px;"></i>
                    </button>
                </div>

                <div class=" pt-2" id="sidebarCollapse">
                    <!-- Title/logo -->
                    <!-- <a role="button" class="d-flex justify-content-end" data-target="#sidebar" data-toggle="collapse" aria-controls="sidebar" aria-expanded="true" ><i class="fa-solid fa-bars text-white" style="font-size: 24px;"></i></a> -->
                    <div>
                        <div class="text-center text-white nav-label"><h1>Admin</h1></div>
                    </div>
                    <!-- Nav link -->
                    <ul class="container">
                        <li class="row">
                            <a href="#" class="btn btn-primary d-flex align-items-center mt-5" style="text-decoration: none;">
                                <span class="text-white col nav-label" style="text-align: start;font-weight: bolder; font-size:24px;">Dashboard</span>
                                <i class="fa-solid fa-table-columns text-white col-2 nav-icon" style="font-size: 32px;"></i>
                            </a>
                        </li>
                        <li class="row">
                            <a href="#" class="btn btn-primary d-flex align-items-center mt-3" style="text-decoration: none;">
                                <span class="text-white col nav-label" style="text-align: start;font-weight: bolder; font-size:24px;">Manage user</span>
                                <i class="fa-solid fa-user text-white col-2 nav-icon" style="font-size: 32px; padding-left: 2px;"></i>
                            </a>
                        </li>
                        <li class="row">
                            <a href="#" class="btn btn-primary d-flex align-items-center mt-3" style="text-decoration: none;">
                                <span class="text-white col nav-label" style="text-align: start; font-weight: bolder; font-size:24px;">Manage inquiry</span>
                                <i class="fa-solid fa-clipboard-question text-white col-2 nav-icon" style="font-size: 32px; padding-left: 4px;"></i>
                            </a>
                        </li>
                    </ul>
                </div>

            </nav>

            <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> -->
        @endsection
        
    </body>
</html>
