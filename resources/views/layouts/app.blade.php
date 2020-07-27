<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://www.gstatic.com/firebasejs/7.15.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.15.1/firebase-database.js"></script>
    <script>
        // Your web app's Firebase configuration
        var firebaseConfig = {
            apiKey: "AIzaSyDrmv4GqNndSAMWoHkgN0eZXKd0KxTFrwY",
            authDomain: "sos-ph-6bbbb.firebaseapp.com",
            databaseURL: "https://sos-ph-6bbbb.firebaseio.com",
            projectId: "sos-ph-6bbbb",
            storageBucket: "sos-ph-6bbbb.appspot.com",
            messagingSenderId: "598502100694",
            appId: "1:598502100694:web:6a741cbfa271eb641c4377",
            measurementId: "G-SHHJY267Q1"
        };
        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);

        firebase.database().ref('reports').on("child_added", function (snapshot){
            var reportId = snapshot.val().report_id;

            /* ajax here */
            
        });
    </script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    {{ config('app.name', 'Emergency Ph') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
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
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('user.edit') }}" >           
                                        {{ __('Edit Profile') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('password.edit') }}" >           
                                        {{ __('Change Password') }}
                                    </a>

                                    @if (Auth::user()->user_type === 'Police Station')
                                        <a class="dropdown-item" href="{{ route('register.officer') }}" >           
                                            {{ __('Register Police Officer') }}
                                        </a>

                                        <a class="dropdown-item" href="{{ route('officers.index') }}" >           
                                            {{ __('Management') }}
                                        </a>
                                    @endif

                                    @if (Auth::user()->user_type === 'Hospital')
                                        <a class="dropdown-item" href="{{ route('register.ambulance') }}" >           
                                            {{ __('Register Ambulance') }}
                                        </a>

                                        <a class="dropdown-item" href="{{ route('ambulances.index') }}" >           
                                            {{ __('Management') }}
                                        </a>
                                    @endif

                                    @if (Auth::user()->user_type === 'Fire Station')
                                        <a class="dropdown-item" href="{{ route('register.fireman') }}" >           
                                            {{ __('Register Fireman') }}
                                        </a>

                                        <a class="dropdown-item" href="{{ route('firemans.index') }}" >           
                                            {{ __('Management') }}
                                        </a>
                                    @endif

                                    @if (Auth::user()->user_type === 'admin')
                                        <a class="dropdown-item" href="{{ route('register.station') }}" >           
                                            {{ __('Register Station') }}
                                        </a>

                                        <a class="dropdown-item" href="{{ route('users.index') }}" >           
                                            {{ __('Management') }}
                                        </a>
                                    @endif                                  
                                                                    
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
</body>
</html>
