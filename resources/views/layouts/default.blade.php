<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sevent teachers - Student</title>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/morris.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/layout.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/datatables.bootstrap.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/bootstrap-fileinput.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/select2-bootstrap.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/bootstrap-wysihtml5.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/summernote.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/bootstrap-datepicker.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/dropzone.min.css') }}" rel="stylesheet"/>

    <link href="{{ asset('css/admin/components.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/admin/darkblue.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/admin/components-rounded.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/admin/style.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/simple-line-icons.min.css') }}" rel="stylesheet"/>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/dropzone.min.js') }}" type="text/javascript"></script>

    <script>
        $( window ).load(function () {
            $('.swing-preloader').css('display','none');
        });
    </script>
</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
        <div class="swing-preloader" style="display: block;">
            <div class="in-preload">
                <div class="sk-rotating-plane"></div>
            </div>
        </div>
        <div class="page-wrapper">
            <!-- BEGIN HEADER -->
            @include('admin.inc.header')
            <div class="clearfix"> </div>
            <div class="page-container">
                @include('admin.inc.side-menu')
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content" style="min-height: 1112px;">
                        @include('admin.inc.breadcrumb')
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
<!-- Scripts -->

        <script src="{{ asset('js/admin/morris.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/plugins/datatable.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/plugins/bootstrap-fileinput.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/datatables.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/datatables.bootstrap.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/select2.full.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/plugins/wysihtml5-0.3.0.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/plugins/bootstrap-wysihtml5.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/plugins/summernote.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/plugins/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/plugins/clipboard.min.js') }}" type="text/javascript"></script>


        <script src="{{ asset('js/admin/app.min.js') }}"></script>


        <script src="{{ asset('js/admin/admin.js') }}"></script>
        <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('js/additional-methods.min.js') }}"></script>
        <script src="{{ asset('js/admin/dashboard.min.js') }}"></script>
        <script src="{{ asset('js/admin/layout.min.js') }}"></script>
        <script src="{{ asset('js/plugins/table-datatables-managed.js') }}"></script>
        <script src="{{ asset('js/admin/form-validation.js') }}"></script>
        <script src="{{ asset('js/plugins/components-select2.js') }}"></script>
        <script src="{{ asset('js/plugins/components-editors.js') }}"></script>
        <script src="{{ asset('js/plugins/components-date-time-pickers.js') }}"></script>
        <script src="{{ asset('js/plugins/components-clipboard.js') }}"></script>
        <script src="{{ asset('js/plugins/components-dropzone.js') }}"></script>
</body>
</html>
