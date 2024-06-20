<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thực đơn đồ giải khát</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('frontend\images\mixue-favicon.png') }}"/>

    @include('pages.head')
</head>

<body id="body" style="background-color:#fafafa;">
    @yield('content')
    @yield('js')
    @include('notifications.index')
    <script src="{{ asset('frontend\js\notification.js') }}"></script>
</body>

</html>
