<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="{{ asset('css/css.css') }}" rel="stylesheet">

</head>
<body>
<div class="flex-center position-ref full-height">

    <nav class="navbar  navbar-inverse  navbar-fixed-top">
        <div class="container">
            <button type="button" class="navbar-toggle"
                    data-toggle="collapse"
                    data-target=".navbar-collapse">
                <span class="sr-only"> Toggle navigation</span>
                <span class="icon-bar"> </span>
                <span class="icon-bar"> </span>
                <span class="icon-bar"> </span>
            </button>

            <a class="navbar-brand" href="#"> NEWS TASK</a>

            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::check())
                        <li class=""><a href="{{ route('administrator') }}">ADMINISTRATOR</a></li>
                    @else
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>


    <div class="navbar  navbar-inverse navbar-fixed-bottom">
        <div class="container">
            <div class="navbar-text pull=left">
                <p>news task.</p>
            </div>

        </div>
    </div>


    </nav>


    @yield('content')
    @yield('javascript')


</div>
</body>
</html>
