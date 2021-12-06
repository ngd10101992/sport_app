<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Ebisu') }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css" integrity="sha512-3JRrEUwaCkFUBLK1N8HehwQgu8e23jTH4np5NHOmQOobuC4ROQxFwFgBLTnhcnQRMs84muMh0PnnwXlPq5MGjg==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">

    <link href="/css/app.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.13.0/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js" integrity="sha512-k6/Bkb8Fxf/c1Tkyl39yJwcOZ1P4cRrJu77p83zJjN2Z55prbFHxPs9vN7q3l3+tSMGPDdoH51AEU8Vgo1cgAA==" crossorigin="anonymous"></script>
    

</head>
<body>
    <div id="app">
        <div class="app-background"></div>
        <nav id="navbar" class="navbar navbar-expand-md navbar-light">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Ebisu') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @guest

                        @else
                            @if (Auth::user()->role === '1')
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{ route('admin.teams.show') }}">Teams</a>
                                </li>
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{ route('admin.users.show') }}">Users</a>
                                </li>
                            @else
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{ route('user.teams.show', Auth::user()->id) }}">Teams</a>
                                </li>
                            @endif
                        @endguest
                        
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link user-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('user.profile', [Auth::user()->id]) }}">
                                        {{ __('Profile') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('user.password', [Auth::user()->id]) }}">
                                        {{ __('Password') }}
                                    </a>
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

        <main id="main" class="main">
            @yield('content')
        </main>
    </div>
    <script src="/js/app.js"></script>
    <script type="text/javascript">

        $('#datetimepicker1').datetimepicker({
            format: 'L'
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        $('.btn-update').click(function(e) {
            e.preventDefault()
            let url = $(this).data( "url")
            let elementId = $(this).data("element-id")
            let removeValue = $(this).data("remove-value")
            const data = {}
            const inputs = $(this).parent().find('input')

            inputs.each(function() {
                data[$(this).attr('name')] = $(this).val()
            })
            
            $.ajax({
                url: url,
                type: "PUT",
                data: data,
                success: function(result) {
                    $('.close').click()
                    $(`#${elementId} .td-info`).each(function() {
                        $(this).text(data[$(this).data('name')])
                    })
                    if (removeValue) {
                        if (result.status) {
                            $(`#${elementId} .form-control-password`).each(function() {
                                $(this).val('')
                            })
                            $('.show-success').text(result.message)
                            $('.show-success').css('display', 'block')
                            $('.show-error').css('display', 'none')
                        } else {
                            $('.show-error').text(result.message)
                            $('.show-error').css('display', 'block')
                            $('.show-success').css('display', 'none')
                        }
                    }
                },
                error : function(error) {
                    $('.close').click()
                    $('.show-error').text(error.responseJSON.message)
                    $('.show-error').css('display', 'block')
                }
            })
        })

        $('.btn-delete').click(function() {
            let elementId = $(this).data( "element-id");
            let url = $(this).data( "url");
            $.ajax({
                url: url,
                type: "DELETE",
                success: function(result) {
                    $('.close').click()
                    setTimeout(() => {
                        $(elementId).remove()
                    }, 300);
                }
            })
        })
    </script>
</body>
</html>
