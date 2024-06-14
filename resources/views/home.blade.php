<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Đồ Uống</title>
    @include('pages.head')
</head>

<body id="body" style="background-color:#fafafa;">
    @yield('content')
    @yield('js')
    @include('notifications.index')
    <script src="{{ asset('frontend\js\notification.js') }}"></script>
</body>

</html>
