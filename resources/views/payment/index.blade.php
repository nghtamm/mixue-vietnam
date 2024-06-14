<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thanh Toán</title>
    @include('pages.head')
    <link rel="stylesheet" href="{{ asset('frontend/css/payment.css') }}">
</head>

<body id="body" style="background-color:#fafafa; overflow: hidden;">
    @include('payment.head')
    @yield('payment')
    @include('notifications.index')
    @include('loading')
    <script src="{{ asset('frontend\js\notification.js') }}"></script>
    {{-- <script src="{{ asset('frontend\js\bodyModal.js') }}"></script> --}}
</body>

</html>
