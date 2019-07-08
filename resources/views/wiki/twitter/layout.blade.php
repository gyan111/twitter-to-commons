<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>@yield('pageTitle')</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="@yield('pageKeywords')" name="keywords">
  <meta content="@yield('pageDescription')" name="description">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Favicons -->
  <link href="{{ secure_asset('img/favicon.ico') }}" rel="icon">
  <link href="{{ secure_asset('img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Bootstrap css -->
  <!-- <link rel="stylesheet" href="css/bootstrap.css"> -->
  <!-- <link href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"> -->
  <link rel="stylesheet" href="https://tools-static.wmflabs.org/cdnjs/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" crossorigin="anonymous">

  <link rel="stylesheet" href="https://tools-static.wmflabs.org/cdnjs/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />


  @yield('css')
</head>

<body>
  @include('wiki.twitter._menu')
  @yield('content')
  @include('wiki.twitter._footer')

  <!-- JavaScript Libraries -->
  <!-- <script src="{{ asset('lib/jquery/jquery.min.js') }}"></script> -->
  <script src="https://tools-static.wmflabs.org/cdnjs/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!-- <script src="{{ asset('lib/jquery/jquery-migrate.min.js') }}"></script> -->
  <script src="https://tools-static.wmflabs.org/cdnjs/ajax/libs/jquery-migrate/3.0.1/jquery-migrate.min.js"></script>
  <!-- <script src="{{ asset('lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script> -->
  <script src="https://tools-static.wmflabs.org/cdnjs/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>

  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/simplelightbox/1.17.1/simple-lightbox.min.js"></script> -->

  <script src="https://tools-static.wmflabs.org/cdnjs/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>

  @yield('js')

  @if (App::environment() !='local')
  @endif
</body>
</html>
