<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Choose Level Page</title>
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
    <link rel="icon" type="image/png" href="{{ asset('img/logo2.png') }}" sizes="32x32">
    <meta name="theme-color" content="#1d2a39">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,700">
    <link rel="stylesheet" href="{{ asset('css/vendor.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/elephant.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/errors.min.css') }}">
</head>
<body>
<center>
    <div class="error-body">
        <h1 class="error-heading"><b>{{ mosqueName() }}</b></h1>
        <h4 class="error-subheading">Untuk masuk ke dalam Aplikasi</h4>
        <p>
            <small>Silahkan pilih level yang anda miliki dibawah ini :</small>
        </p>
    </div>
    <div class="row" style="position: relative; top: -30px">
        <form id="chooseRole" method="POST" action="{!! route('role.pick') !!}">
            @csrf
            @forelse($listAkses as $akses)
                <button style="margin-top: 10px" class="btn btn-primary btn-pill btn-thick" type="submit" name="id_user_level" value="{!! $akses->role->id !!}">
                    {!! $akses->role->nama !!}
                </button>
            @empty
                <center>Belum tersedia akses menu, silahkan kontak admin untuk mendapatkan akses.</center>
            @endforelse
        </form>
    </div>
    <div class="error-footer">
        <p>
            <small>© {{ date('Y') }} {{ mosqueName() }}</small>
        </p>
    </div>
</center>
<a href="{{ route('logout') }}" style="margin-right: 10px" class="btn btn-danger pull-right" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    <i class="icon icon-sign-out"></i> <strong>Logout</strong>
</a>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{ asset('js/vendor.min.js') }}"></script>
<script src="{{ asset('js/elephant.min.js') }}"></script>
</body>
</html>
