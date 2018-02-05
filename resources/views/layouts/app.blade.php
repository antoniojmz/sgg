<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <!-- CSS -->
    <!--ico Fonts-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/assets/icon/icofont/css/icofont.css') }}">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/bower_components/bootstrap/css/bootstrap.min.css') }}">
    <!-- Material icons -->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/assets/icon/material-design/css/material-design-iconic-font.min.css') }}">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/assets/css/main.css') }}">
    <!-- Responsive.css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/assets/css/responsive.css') }}">
    <!--color css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/assets/css/color/color-1.css') }}" id="color"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/validator/formValidation.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login/login.css') }}">
    <!-- JS -->
    <!-- Required Jqurey -->
    <script type="text/javascript" src="{{ asset('theme/bower_components/jquery/js/jquery.min.js') }}"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script> -->
    <!-- <script src="{{ asset('theme/assets/plugins/forms-wizard-validation/js/validate.js') }}"></script> -->
    <script src="{{ asset('js/utils/utils.js') }}"></script>
    <script src="{{ asset('plugins/validator/formValidation.js') }}"></script>
    <script src="{{ asset('plugins/validator/fvbootstrap.js') }}"></script>
    <script src="{{ asset('plugins/validator/es_ES.js') }}"></script>
    <!-- <script type="text/javascript" src="{{ asset('theme/bower_components/jquery-ui/js/jquery-ui.min.js') }}"></script> -->
    <!-- tether.js -->
    <!-- <script type="text/javascript" src="{{ asset('theme/bower_components/popper.js/js/popper.min.js') }}"></script> -->
    <!-- waves effects.js -->
    <!-- <script src="{{ asset('theme/assets/plugins/waves/js/waves.min.js') }}"></script> -->
    <!-- Required Framework -->
    <!-- <script type="text/javascript" src="{{ asset('theme/bower_components/bootstrap/js/bootstrap.min.js') }}"></script> -->
    <!-- waves effects.js -->
    <!-- <script src="{{ asset('theme/assets/plugins/waves/js/waves.min.js') }}"></script> -->
    <!-- Scrollbar JS-->
    <!-- <script type="text/javascript" src="{{ asset('theme/bower_components/jquery-slimscroll/js/jquery.slimscroll.js') }}"></script> -->
    <!-- <script type="text/javascript" src="{{ asset('theme/assets/plugins/jquery.nicescroll/js/jquery.nicescroll.min.js') }}"></script> -->
    <!--classic JS-->
    <!-- <script type="text/javascript" src="{{ asset('theme/bower_components/classie/js/classie.js') }}"></script> -->
    <!-- notification -->
    <script type="text/javascript" src="{{ asset('theme/assets/plugins/notification/js/bootstrap-growl.min.js') }}"></script>
    <!-- custom js -->
    <!-- <script type="text/javascript" src="{{ asset('theme/assets/js/main.min.js') }}"></script> -->
    <!-- <script type="text/javascript" src="{{ asset('theme/assets/pages/elements.js') }}"></script> -->
    <!-- <script src="{{ asset('theme/assets/js/menu-horizontal.min.js') }}"></script> -->
</head>
<body>
    <div id="app">
        @yield('content')
    </div>
</body>
</html>