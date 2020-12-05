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
                <a class="navbar-brand" href="{{ url('/house') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                @if(auth()->check())
                @if(auth()->user()->email==='polls@mtv.com')

                        <ul class="navbar-nav">

                            <li class="nav-item">
                                <a class="nav-link" href="{{route('createuser')}}">
                                    Create User
                                </a>
                            </li>
                        </ul>


                    <ul class="navbar-nav">

                        <li class="nav-item">
                            <a class="nav-link" href="{{route('createconstituency')}}">
                                Create Constituency
                            </a>
                        </li>
                    </ul>

                    @endif


                    <ul class="navbar-nav">

                        <li class="nav-item">
                            <a class="nav-link" href="{{route('createpollingstation')}}">
                                Polling Station
                            </a>
                        </li>
                    </ul>





                    <ul class="navbar-nav">

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Create Candidate</a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{route('createpaliarmentarycandidate')}}">Parliamentary Candidate</a>
                                <a class="dropdown-item" href="{{route('SelectConstituencyPresidential')}}">Presidential Candidate</a>

                            </div>

                        </li>
                    </ul>



                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Record Results</a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{route('SelectConstituency')}}">Parliamentary Results</a>
                                <a class="dropdown-item" href="{{route('SelectConstituencyPresidential')}}">Presidential Results</a>

                            </div>

                        </li>

                    </ul>
            @endif


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
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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

        <main class="py-4 container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    @if (session()->has('error'))
                        <div class="alert alert-danger">
                            <ul>
                                <li>

                                    {{ session()->get('error') }}
                                </li>

                            </ul>
                        </div>
                    @endif

                        @if (session()->has('success'))
                        <div class="alert alert-success">
                            <ul>
                                <li>

                                    {{ session()->get('success') }}
                                </li>

                            </ul>
                        </div>
                    @endif

                </div>

            </div>

            @yield('content')
        </main>
    </div>
    <script src="/assets/js/core/popper.min.js"></script>
    <script src="/assets/js/core/bootstrap.min.js"></script>
    <script src="/assets/js/plugin/chart.js/chart.min.js"></script>
    <script src="/assets/js/atlantis.min.js"></script>
    @if(isset($parties))

<script>

    var preschart = document.getElementById('presChart').getContext('2d');

    var presidential_chart = new Chart(preschart, {
        type: 'line',
        data: {
            labels: [
                <?php
                    foreach ($parties ?? '' as $party){
                        echo "'".$party->acronym."',";
                    }
                ?>
                ],
            datasets: [

                <?php
                    foreach ($parties ?? '' as $party){
                    ?>


                {
                label: "<?=$party->acronym?>",
                borderColor: '<?=$party->color?>',
                pointBackgroundColor: '<?=$party->color?>',
                pointRadius: 0,
                backgroundColor: '<?=$party->color?>',
                legendColor: '<?=$party->color?>',
                fill: true,
                borderWidth: 2,
                data:[<?php
                    foreach ($parties as $p)
                    echo   \App\Http\Controllers\HomeController::partypresvotes($p->id).",";

                    ?>]


            },


                <?php
                    }
                    ?>
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                display: false,
            },
            scales: {
                yAxes: [{
                    ticks: {
                        display: true //this will remove only the label
                    },
                    gridLines : {
                        drawBorder: false,
                        display : false
                    }
                }],
                xAxes : [ {
                    gridLines : {
                        drawBorder: false,
                        display : false
                    }
                }]
            },
        }
    });
</script>
@endif
</body>
</html>
