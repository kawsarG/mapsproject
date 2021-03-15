<!DOCTYPE html>
<html>

<head>
    <title>YMap</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <link rel="stylesheet" href="css/app.css" />
    <link rel="stylesheet" href="css/map.css" />
    <style type="text/css">
    #map {
        height: 100%;
    }

    /* Optional: Makes the sample page fill the window. */
    html,
    body {
        height: 100%;
        margin: 0;
        padding: 0;
    }
    </style>
</head>

<body>
    <div id="map"></div>

    <div class="container form1">
        <div class="row">
            <div class="col">
                <h1 class="text-center text-white" style="margin: 30px 0;"> Welcome to YMaps</h1>
                <form>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Email address</label>
                        <input type="email" class="form-control" id="email">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Comment</label>
                        <input type="text" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Email address</label>
                        <input type="email" class="form-control" id="sp">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Comment</label>
                        <input type="text" class="form-control" />
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-block">Submit</button>
                    </div>

                </form>
            </div>
        </div>
        <div class="logout">
            <div id="app">
                <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                    <div class="container">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
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

                                @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
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
        </div>
    </div>
    <div class="search">
        <input id="origin-input" class="controls" type="text" placeholder="Enter an origin location" />

        <input id="destination-input" class="controls" type="text" placeholder="Enter a destination location" />

        <div id="mode-selector" class="controls">
            <input type="radio" name="type" id="changemode-walking" checked="checked" />
            <label for="changemode-walking">Walking</label>

            <input type="radio" name="type" id="changemode-transit" />
            <label for="changemode-transit">Transit</label>

            <input type="radio" name="type" id="changemode-driving" />
            <label for="changemode-driving">Driving</label>
        </div>
    </div>
    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->


    <script src="https://maps.googleapis.com/maps/api/js?key=Youkeywillbehere&libraries=places" async></script>
    <script src="js/map.js"></script>
    <script src="js/app.js"></script>


</body>

</html>