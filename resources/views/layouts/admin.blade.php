<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Finder.lk') }}</title>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/morris.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/layout.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/admin/darkblue.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/admin/components-rounded.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/admin/style.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/simple-line-icons.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet"/>

</head>
<body>
    @yield('content')
<!-- Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/admin/morris.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/admin/app.min.js') }}"></script>


    <script src="{{ asset('js/admin/admin.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/additional-methods.min.js') }}"></script>
    <script src="{{ asset('js/admin/dashboard.min.js') }}"></script>
    <script src="{{ asset('js/admin/layout.min.js') }}"></script>
    <script src="{{ asset('js/admin/login.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>

</body>
</html>
