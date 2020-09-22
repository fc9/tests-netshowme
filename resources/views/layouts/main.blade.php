<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ env('APP_DESCRIPTION') }}">
    <meta name="author" content="{{ env('APP_AUTHOR') }}">
    <meta name="msapplication-TileImage" content="{{ url('images/netshow-me-icon-200px.png') }}" />
    <link rel="icon" href="{{ url('images/netshow-me-icon-200px-150x150.png') }}" sizes="32x32" />
    <link rel="icon" href="{{ url('images/netshow-me-icon-200px.png') }}" sizes="192x192" />
    <link rel="apple-touch-icon" href="{{ url('images/netshow-me-icon-200px.png') }}" />

    <title>{{ env('APP_NAME') }}</title>

    <link rel="stylesheet" href="{{ url('css/app.min.css') }}">
    @yield('styles')
</head>
<body>

@yield('content')

<script src="{{ url('js/app.min.js') }}"></script>
@yield('scripts')

</body>
</html>
