<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Moca</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- DatePicker -->
    <link href="{{ asset('lib/jquery-ui-1.11.4.custom/jquery-ui.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/jquery-ui-1.11.4.custom/jquery-ui-timepicker-addon.css') }}" rel="stylesheet">

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <!-- DatePicker -->
    <script src="{{ asset('lib/jquery-ui-1.11.4.custom/jquery-ui.js') }}"></script>
    <script src="{{ asset('lib/jquery-ui-1.11.4.custom/jquery-ui-timepicker-addon.js') }}"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    <script src="{{ asset('js/bootbox.min.js') }}"></script>

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
    @yield('head')
</head>
<body id="app-layout">
<div id="noscript" class="alert-danger text-center" style="padding: 10px 0;"><?= Lang::get('commons.noscript')?></div>
<script type="text/javascript">
    document.getElementById('noscript').style.display = 'none';
</script>
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    MoCA
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}"><?= Lang::get('commons.home')?></a></li>
                    <?php /* ?>
                    @if (!Auth::guest() && Auth::user()->isAdmin())
                    <?php */ ?>
                        <li><a href="{{ url('/user') }}"><?= Lang::choice('commons.user',2)?></a></li>
                        <li><a href="{{ url('/test') }}"><?= Lang::choice('commons.test',2)?></a></li>
                    <?php /* ?>
                    @if (!Auth::guest() && Auth::user()->isDoctor())
                    <?php */ ?>
                        <li><a href="{{ url('/follow') }}"><?= Lang::choice('commons.patient',2)?></a></li>
                    <?php /* ?>
                    @endif
                    @endif
                    @if (!Auth::guest() && (Auth::user()->isDoctor() || Auth::user()->isPatient()))
                    <?php */ ?>
                        <li><a href="{{ url('/consultation') }}"><?= Lang::choice('commons.consultation',2)?></a></li>
                    <?php /* ?>
                    @endif
                    <?php */ ?>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}"><?= Lang::get('commons.login')?></a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->username }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                            <?php if (App::getLocale() == "en"): ?>
                                <li><a href="{{ url('/user/switchLang/fr') }}"><?= Lang::get('commons.french')?></a></li>
                            <?php else: ?>
                                <li><a href="{{ url('/user/switchLang/en') }}"><?= Lang::get('commons.english')?></a></li>
                            <?php endif ?>
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i><?= Lang::get('commons.logout')?></a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')
</body>
</html>
