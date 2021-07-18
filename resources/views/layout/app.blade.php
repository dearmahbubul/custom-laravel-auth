<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') - {{env('APP_NAME')}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="{{URL::asset('custom/styles.css')}}">
    <link rel="stylesheet" href="{{URL::asset('custom/parsley.css')}}">
    @stack('header_scripts')
</head>
<body>
<div class="container pt-3">
    <div class="row">
        <div class="col-md-8">
            <a href="{{route('home')}}"><img src="{{asset('custom/logo.png')}}" alt="Logo" /></a>
        </div>
        <div class="col-md-4 text-right">
            @auth
                <button class="btn btn-danger logout-user">Logout</button>
            @else
            <a href="{{route('login')}}" class="btn btn-primary">Sign In</a>
            @endauth
            <a href="{{route('signup')}}" class="btn btn-primary">Sign Up</a>
        </div>
    </div>
</div>
@yield('main')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="{{URL::asset('custom/parsley.min.js')}}"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click','.logout-user', function(event){
        event.preventDefault();
        $.ajax({
            url: "{!! route('logout') !!}",
            type: "get",
            success:function(response){
                console.log(response);
                if (response && response.status) {
                    window.setTimeout(function(){
                        window.location.href = "{!! route('home') !!}";
                    }, 1000);
                } else {
                    alert('User not logged out')
                }
            },
            error: function(response) {
                alert('User not logged out')
            }
        });
    });
</script>
@stack('footer_scripts')
</body>
</html>
