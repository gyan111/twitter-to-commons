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
  <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon" />
  <link href="{{ asset('img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Bootstrap css -->
  <!-- <link rel="stylesheet" href="css/bootstrap.css"> -->
  <!-- <link href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"> -->
  <link rel="stylesheet" href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}" crossorigin="anonymous">

  <link rel="stylesheet" href="{{ asset('lib/fancybox/jquery.fancybox.min.css') }}" />


  @yield('css')
</head>

<body>
  @include('wiki.twitter._menu')
  @yield('content')
  @include('wiki.twitter._footer')

  <!-- JavaScript Libraries -->
  <!-- <script src="{{ asset('lib/jquery/jquery.min.js') }}"></script> -->
  <script src="{{ asset('lib/jquery/jquery.min.js') }}"></script>
  <!-- <script src="{{ asset('lib/jquery/jquery-migrate.min.js') }}"></script> -->
  <script src="{{ asset('lib/jquery/jquery-migrate.min.js') }}"></script>
  <!-- <script src="{{ asset('lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script> -->
  <script src="{{ asset('lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/simplelightbox/1.17.1/simple-lightbox.min.js"></script> -->

  <script src="{{ asset('lib/fancybox/jquery.fancybox.min.js') }}"></script>

  @yield('js')

  @if (App::environment() !='local')
  @endif
</body>
</html>
