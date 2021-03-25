<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting Poll</title>
    <link rel="stylesheet" href="/css/materialize.min.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/index.css">
</head>
<body>
    <nav class="cyan darken-1">
        <div class="nav-wrapper container">
            <a href="{{ route('index') }}" class="brand-logo">Voting Poll</a>
            <a href="#" data-activates="mobile-demo" class="button-collapse">
                <i class="fa fa-bars"></i>
            </a>
          <ul class="right hide-on-med-and-down">
                @guest
                    <li><a href="{{ route('register') }}">Register</a></li>
                @endguest

                @auth
                    @if(auth()->user()->role == 'admin')
                        <li><a href="{{ route('question_list') }}">Admin Panel</a></li>
                    @endif
                    <li><a href="{{ route('questions') }}">Questions</a></li>
                    <li><a href="#" onclick="$('#logout_form').submit()">Logout</a></li>
                @endauth
          </ul>
            <ul class="side-nav" id="mobile-demo">
                @guest
                    <li><a href="{{ route('register') }}">Register</a></li>
                @endguest
                
                @auth
                    @if(auth()->user()->role == 'admin')
                        <li><a href="{{ route('dashboard') }}">Admin Panel</a></li>
                    @endif
                    <li><a href="{{ route('questions') }}">Questions</a></li>
                    <li><a href="#" onclick="$('#logout_form').submit()">Logout</a></li>
                    <form action="/user/logout" method="post" id="logout_form">
                        {{ @csrf_field() }}
                    </form>
                @endauth
            </ul>
        </div>
    </nav>
    <div id="app">
        @yield('content')
    </div>
</body>
    <script src="/js/jquery-3.2.1.min.js"></script>
    <script src="/js/materialize.min.js"></script>
    <script src="/js/sweetalert.min.js"></script>
    <script src="/js/index.js"></script>
    @yield('scripts')
</html>