<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="icon" href="{{ asset('img/pleets125.png') }}" type="image/x-icon" />
    <link rel="shortcut icon" href="{{ asset('img/pleets125.png') }}" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php
        $title = config('app.page_title');
        $description = config('app.page_description');
    @endphp

    <title>@yield('meta_title', $title)</title>
    <meta name="description" content="@yield('meta_description', $description)">

    @include('layouts.head._fbtags')

    @php
        $sdk_should_be_included = config('facebook.home.activated') || config('facebook.posts.activated');
        $recaptcha_api = config('google.recaptcha.activated');
        $paypal_sdk = config('paypal.activated');
    @endphp

    @includeWhen($sdk_should_be_included, 'layouts.head._fb_social_plugins')
    @includeWhen($recaptcha_api, 'layouts.head._google_recaptcha')
    @includeWhen($paypal_sdk, 'layouts.head._paypal_checkout')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/faster.js') }}" defer></script>
    <script src="{{ asset('js/scripts.js') }}" defer></script>

    @include('layouts.head._fonts')

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/faster.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fonts.css') }}" rel="stylesheet">
    <link href="{{ asset('css/facebook.css') }}" rel="stylesheet">

    <link href="{{ asset('css/monokai-sublime.css') }}" rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link href="{{ asset('css/monokai-sublime.css') }}" rel="stylesheet">
    </noscript>
</head>
<body>
    <div id="app">
        @include('layouts.nav._top')

        <main>
            @yield('content')
        </main>

        <footer class="container text-center">
            © {{ date('Y') }} <span class="pltsword">Pleets</span>
        </footer>
    </div>

    <!-- PayPal checkout smart button -->
    @if(config('paypal.activated') && request()->routeIs('posts'))
        <script src="{{ asset('js/paypal.js') }}" defer></script>
    @endif
</body>
</html>
