<!doctype html>

<html lang="{{str_replace('_', '-', app()->getLocale()) }}" >
<head>
    <meta  charset = " utf-8 ">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{csrf_token() }}" >

    <title>Login</title> 

    <!-- Scripts -->
    <script src="{{asset('js/app.js') }}"  defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->

    <link href="{{asset('css/app.css') }}"  rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body  style="min-height:90vh;">
    <div id="app">


        <main class="py-4 mt-lg-2">
            <a href="/">
                <img src="{{asset('style/assets/shrimp.png')}}" class="d-block mx-auto my-5 " style="max-width: 10%">
            </a>
            
            @yield('content')
        </main>
    </div>

    <footer id="sticky-footer" class="flex-shrink-0 py-4 text-blue-50">
      <div class="container text-center">
        <small>Made with  by <a href="/" style="text-decoration: none;">Pens-2022</a></small>
      </div>
    </footer>
</body>

</html>

