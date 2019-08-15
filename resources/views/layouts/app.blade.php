<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ mosqueName() }} | @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <meta name="description"
          content="Elephant is an admin template that helps you build modern Admin Applications, professionally fast! Built on top of Bootstrap, it includes a large collection of HTML, CSS and JS components that are simple to use and easy to customize.">
    <meta property="og:url" content="http://demo.madebytilde.com/elephant">
    <meta property="og:type" content="website">
    <meta property="og:title"
          content="The fastest way to build Modern Admin APPS for any platform, browser, or device.">
    <meta property="og:description"
          content="Elephant is an admin template that helps you build modern Admin Applications, professionally fast! Built on top of Bootstrap, it includes a large collection of HTML, CSS and JS components that are simple to use and easy to customize.">
    <meta property="og:image" content="http://demo.madebytilde.com/elephant.jpg">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@madebytilde">
    <meta name="twitter:creator" content="@madebytilde">
    <meta name="twitter:title"
          content="The fastest way to build Modern Admin APPS for any platform, browser, or device.">
    <meta name="twitter:description"
          content="Elephant is an admin template that helps you build modern Admin Applications, professionally fast! Built on top of Bootstrap, it includes a large collection of HTML, CSS and JS components that are simple to use and easy to customize.">
    <meta name="twitter:image" content="http://demo.madebytilde.com/elephant.jpg">
    <link rel="icon" type="image/png" href="{{ asset('img/icon-mjd.png') }}" sizes="32x32">
    <meta name="theme-color" content="#1d2a39">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,700">
    <link rel="stylesheet" href="{{ asset('css/vendor.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/elephant.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/application.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
    <style>
        /* scroller browser */
        ::-webkit-scrollbar {
            width: 7px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.1);
            -webkit-border-radius: 10px;
            border-radius: 10px;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            -webkit-border-radius: 10px;
            border-radius: 10px;
            background: #a6a5a5;
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
        }

        ::-webkit-scrollbar-thumb:window-inactive {
            background: rgba(0, 0, 0, 0.4);
        }
    </style>
</head>
<body class="layout layout-header-fixed layout-sidebar-fixed">
{{-- Header --}}
@include('layouts.header')

{{-- Sidebar --}}
@include('layouts.sidebar')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/vendor.min.js') }}"></script>
<script src="{{ asset('js/elephant.min.js') }}"></script>
<script src="{{ asset('js/application.min.js') }}"></script>
<script src="{{ asset('js/demo.min.js') }}"></script>
<script src="{{ asset('js/jquery-confirm.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>
<script src="{{ asset('js/jquery.autocomplete.min.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.4.4/underscore-min.js"></script>
<script>
    $(document).ready(function () {
        setNavigation();

        $('[name="id_user_level"]').on('change', function() {
            $('#pickRole').submit();
        })
    });

    function setNavigation() {
        var path = window.location.pathname;
        path = path[0] == '/' ? path.substr(1) : path; //it will remove the dash in the URL
        $("ul.list-menu .sub-menu a").each(function() {
            console.log("oces");
            var href = $(this).attr('href');
            var pathHref = href.split('/').slice(3).join('/');

            if (path === pathHref) {
                $(this).parent().parent().closest('li').addClass('active');
                $(this).parent().parent().closest('li').addClass('open');
                $(this).closest('ul').addClass('in');
            }
        });
    }
</script>
@stack('scripts')
@show
</body>
</html>

