<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trang chủ Mixue Việt Nam</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('frontend\images\mixue-favicon.png') }}"/>
    @include('pages.head')
</head>


<body id="body" style="background-color:#fafafa;">
    @include('payment.head')
    <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel" style="max-height: 70vh; overflow: hidden">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active" style="height:100%">
                <img src="{{ asset('frontend\images\banner1.png') }}" class="d-block w-100" alt="..." style="height:100%; object-fit: contain">
            </div>
            <div class="carousel-item" style="height:100%">
                <img src="{{ asset('frontend\images\banner2.png') }}" class="d-block w-100" alt="..." style="height:100%; object-fit: contain">
            </div>
            <div class="carousel-item" style="height:100%">
                <img src="{{ asset('frontend\images\banner3.png') }}" class="d-block w-100" alt="..." style="height:100%; object-fit: contain">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="mx-5 mb-5 mt-4">
        <div class="d-flex justify-content-center align-items-center mb-4">
            <span style="flex: 1; border-bottom: 1px solid #ccc; margin: 0 1rem;"></span>
            <h1 class="display-5" style="margin: 0; white-space: nowrap">
                Danh sách cửa hàng Mixue
            </h1>
            <span style="flex: 1; border-bottom: 1px solid #ccc; margin: 0 1rem;"></span>
        </div>
        <div class="home">
            @if (session('login_error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('login_error') }}
                </div>
            @endif
            <div class="rest_container">
                @foreach ($restaurant as $r)
                    <div class="restaurant col">
                        <div class="card" style="overflow: hidden;">
                            <img src="{{ $r->restaurant_image }}" class="card-img-top" alt="..." loading="lazy">
                            <div class="card-body" style="background-color:white; z-index: 2">
                                <h6 class="card-title"><strong>{{ $r->restaurant_name }}</strong></h6>
                                <a href="{{ route('showProduct', ['restaurant_id' => $r->restaurant_id]) }}"
                                    class="buynow btn btn-secondary btn-md w-100" name="buynow">Mua ngay</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @include('notifications.index')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('frontend\js\sendAjaxRequest.js') }}"></script>
    <script src="{{ asset('frontend\js\notification.js') }}"></script>
</body>

</html>
