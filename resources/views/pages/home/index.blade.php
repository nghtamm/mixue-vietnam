<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trang chủ</title>
    @include('pages.head')
</head>


<body id="body" style="background-color:#fafafa;">
    @include('payment.head')
    <div id="carouselExampleIndicators" class="carousel slide">
        <div id="carouselExample" class="carousel slide">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('frontend\images\bannerhome1.png') }}" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <div class="container mt-3 mb-3">
        <div class="home">
            @if (session('login_error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('login_error') }}
                </div>
            @endif
            <div class="row row-cols-1 row-cols-md-6 g-2">
                @foreach ($restaurant as $r)
                    <div class="restaurant col" style="margin-bottom: var(--bs-gutter-y);">
                        <div class="card" style="overflow: hidden;">
                            <img src="{{ $r->restaurant_image }}" class="card-img-top" alt="..." loading="lazy">
                            <div class="card-body" style="background-color:white; z-index: 2">
                                <h6 class="card-title"><strong>{{ $r->restaurant_name }}</strong></h6>
                                <a href="{{ route('showProduct', ['restaurant_id' => $r->restaurant_id]) }}"
                                    class="buynow btn btn-secondary btn-sm w-100" name="buynow">Mua ngay</a>
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
