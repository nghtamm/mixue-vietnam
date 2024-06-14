<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verify Mail</title>
    @include('pages.head')
    <style>
        .timer-style {
            position: absolute;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
        }
    </style>
</head>

<body>
    <section class="vh-100" style="background-image: url({{ asset('frontend/images/login.png') }}); object-fit: cover;">
        <div class="container py-2 h-100 text-center">
            <div class="row h-100">
                <div class="col-12 align-self-center" style="display:flex; justify-content: center;">
                    <div class="card mt-3">
                        <form method="POST" id="otpForm">
                            <input type="hidden" class="form-control" id="token" name="_token"
                                value="{{ csrf_token() }}">
                            <div class="card-body">
                                <div class="mb-3">
                                    <a type="button" href="{{ route('home') }}" class="btn btn-primary btn-sm">Trang
                                        chủ</a>
                                    <a type="button" href="{{ route('login') }}" class="btn btn-secondary btn-sm">Đăng
                                        nhập</a>
                                </div>
                                <h3 class="card-title">Xác thực tài khoản</h3>
                                <p class="card-text">Mã xác thực đã được gửi qua email. Bạn vui lòng kiểm tra hòm thư
                                    đến để
                                    lấy mã.
                                </p>
                                @if (session('error'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                @if (session('success'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <div class="form-floating mb-3 position-relative">
                                    <input type="text" class="form-control" id="otp" name="otp"
                                        placeholder="Vui lòng nhập mã xác thực">
                                    <label for="otp">Mã xác thực</label>
                                    <div id="timer" class="timer-style"></div>
                                </div>
                                {{-- <div class="d-flex">
                                    <p>Bạn không nhận được mã?</p>
                                    <a href="" id="resendOtp" onclick="resendOtp()">Gửi lại OTP</a>
                                </div> --}}
                                <input type="submit" class="btn btn-success" style="width:100%" value="Xác nhận">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('notifications.index')
    <script src="{{ asset('frontend\js\notification.js') }}"></script>
    <script src="{{ asset('frontend\js\verifymail.js') }}"></script>

</body>

</html>
