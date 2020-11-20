<html>
    <head>
        <title>Election 2020</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">

        <style>
            [v-cloak] {
                display: none;
            }
        </style>

    </head>

<body>
<div id="app">

    <v-app>

        <v-main style="height: 100%;" v-cloak>
            <v-container fluid style="height: 100%;">
                <router-view></router-view>

            </v-container>


        </v-main>


    </v-app>

</div>


</body>

</html>
