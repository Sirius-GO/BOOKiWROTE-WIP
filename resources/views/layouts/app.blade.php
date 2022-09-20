<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BookSite') }}</title>
    <!-- Fonts -->
    <!-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> -->
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('css/component.css')}}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="{{asset('js/modernizr.custom.js')}}"></script>
</head>
<body class="bg">
    <div id="app">
        @include('inc.navbar')
        @include('inc.messages')
        <br><br>
        
        <main class="container py-4">
            <div class="row justify-content-left">
                <div class="col-xs-12">
                    @yield('banner')
            </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-7 col-xxl-8 mt-4">
                    @yield('content')
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-5 col-xxl-4 mt-4">
                    @yield('sidebar')
                </div>
            </div>
        </main>
        @include('inc.footer')
    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script src="{{asset('js/books1.js')}}"></script>
		<script>
			$(function() {
				Books.init();
			});
		</script>
</body>
</html>
