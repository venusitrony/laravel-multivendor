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
<!-- Include Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav m-auto">
                 
                            <li class="nav-item">
                                <a class="nav-link @if (Request::segment(1) == 'home')text-success @endif"  href="{{ route('home') }}"><strong>{{ __('Deshbord') }}</strong> </a>
                            </li>
                   
                            <li class="nav-item">
                                <a class="nav-link @if (Request::segment(1) == 'admin')text-success @endif" href="{{ route('admin.index') }}"><strong>{{ __('Admin') }}</strong></a>
                            </li>
                      
                            <li class="nav-item">
                                <a class="nav-link @if (Request::segment(1) == 'role')text-success @endif" href="{{ route('role.index') }}"><strong>{{ __('Role') }}</strong></a>
                            </li>
                 
                            <li class="nav-item">
                                <a class="nav-link @if (Request::segment(1) == 'category')text-success @endif" href="{{ url('category') }}"><strong>{{ __('Category') }}</strong></a>
                            </li>
                   
                            <li class="nav-item">
                                <a class="nav-link @if (Request::segment(1) == 'sub/category')text-success @endif" href="{{ url('sub/category') }}"><strong>{{ __('Sub category') }}</strong></a>
                            </li>
         
                            <li class="nav-item">
                                <a class="nav-link @if (Request::segment(1) == 'product')text-success @endif" href="{{ url('product') }}"><strong>{{ __('Product') }}</strong></a>
                            </li>
                    
                
                            <li class="nav-item">
                                <a class="nav-link @if (Request::segment(1) == 'setting')text-success @endif" href="{{ url('setting') }}"><strong>{{ __('Setting') }}</strong></a>
                            </li>
                  



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
                             @if (Route::has('admin.login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.login') }}">{{ __('Admin Login') }}</a>
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
            @yield('content')
        </main>
    </div>
    
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <!-- Include JQuery + Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Initialize Select2 -->
      @yield('javacontent')

</body>
</html>
