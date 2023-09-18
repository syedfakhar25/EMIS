<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{config('app.name')}}</title>

    <!-- Scripts -->
    <script src="{{ asset('assets/js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
    <!-- Styles -->
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
{{--    @livewireStyles--}}

    @yield('customScripts')
</head>
<body style="background-color: #777777;
 background-image: url('https://biz30.timedoctor.com/images/2020/01/employee-management-tips.jpg');
/*background-repeat: no-repeat;*/
/*background-color: white;*/
background-size: cover;
">
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-light shadow-sm">
        <div class="container">

            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="https://upload.wikimedia.org/wikipedia/commons/8/88/AzadKashmirSeal.png"
                     height="40" width="40">
                <span class="d-none d-sm-inline-block">{{config('app.name')}}</span>
                <span class="d-inline-block d-sm-none">GoAJ&K EMIS </span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}"
                               style="color: black"><b>{{ __('Login') }}</b></a>
                        </li>

                        @if (Route::has('register'))
                            <li class="nav-item" style="padding-left: 30px">
                                <a class="nav-link btn btn-info" href="{{route('register')}}"
                                   style="color: black"><b>{{ __('Register') }}</b></a>
                            </li>
                        @endif

                        <li class="nav-item pl-4">
                            <a class="nav-link  btn btn-success" href="https://www.youtube.com/watch?v=WLspzGNP5DA"
                               target="_blank" style="color: black"><b>{{ __('How to register') }}</b></a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
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
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="{{asset('assets/js/jquery.mask.js')}}" defer></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js" defer></script>
@yield('customJsCode')
<script>
    $(document).ready(function () {
        $('.select2').select2();
        $('.cnic_mask').mask('00000-0000000-0');
    });
</script>
{{--@livewireScripts--}}
{{--@stack('scripts')--}}
</body>
</html>
