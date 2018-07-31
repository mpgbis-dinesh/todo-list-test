<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="robots" content="noindex, nofollow">
    <link rel="icon" type="image/png" sizes="96x96" href="img/favicon.png">
    <meta name="theme-color" content="#ffffff">


    <title>To-Do List</title>

    <!-- Web Fonts -->
    {!! Html::style('assets/css/font-family-class.css') !!}
    {!! Html::style('assets/css/bootstrap.min.css') !!}
    {!! Html::style('assets/css/animate.css') !!}
    {!! Html::style('assets/css/style.css') !!}
    {!! Html::style('assets/css/admin-custom.css') !!}
    {!! Html::style('assets/js/plugins/parsley/parsley.css') !!}
</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>
                <h1 class="logo-name">T+</h1>
            </div>
            @if(Session::has('confirmEmailPassword'))
                <div class="alert alert-danger alert-dismissable text-center">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    {{ Session::get('confirmEmailPassword') }}
                </div>
            @endif

            <form class="m-t" role="form" method="POST" action="{{ URL::to('user/login') }}">
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="Email address" required="" data-parsley-error-message="Please enter your email address">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" name="password" required="" data-parsley-error-message="Please enter your password">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
                
            </form>
            <p class="m-t"> <small>Copyrights &copy; {!! date('Y') !!}. All rights reserved.</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    {!! Html::script('assets/js/jquery-2.1.1.js') !!}
    {!! Html::script('assets/js/bootstrap.min.js') !!}
    {!! Html::script('assets/js/plugins/parsley/parsley.js') !!}
    <script type="text/javascript">
        $('form').parsley();
    </script>
</body>
</html>