<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    @include('shop.head')
</head>


<body>
    @include('sidebar.index')
    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu'></i>
            <span class="text">Dashboard</span>
        </div>
        <div class="dashboard">
            <div class="container">
                <input type="hidden" class="form-control" id="user_id" name="user_id"
                    value="{{ $currentUser->user_id ?? '' }}">
                <input type="text" class="form-control" id="user_id" name="user_id"
                    value="{{ $currentUser->user_id ?? '' }}">
                <div class="row row-cols-1 row-cols-md-4 g-2">
                    test
                </div>
            </div>
        </div>
    </section>
    @include('notifications.notiAdmin')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="{{ asset('frontend\js\sidebar.js') }}"></script>
    <script src="{{ asset('frontend\js\sendAjaxRequest.js') }}"></script>
    <script src="{{ asset('frontend\js\notification.js') }}"></script>

</body>

</html>
