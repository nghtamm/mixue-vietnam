<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Quên mật khẩu</title>
        <link rel="shortcut icon" type="image/png" href="{{ asset('frontend\images\mixue-favicon.png') }}"/>
        @include('pages.head')
    </head>
    <body>
        <section class="d-flex justify-content-center align-items-center vh-100" style="background-image: url({{ asset('frontend/images/login.jpg') }}); object-fit: cover;">
            <div class="container input-container d-flex justify-content-center align-items-center">
                <div class="card d-flex justify-content-center align-items-center pb-5" style="box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35); width: 40rem; border-radius: 14px; width: fit-content; height: fit-content; padding-left: 100px; padding-right: 100px">
                    <h1 class="mb-4 mt-5">Bạn bị quên mật khẩu?</h1>
                    <p>Nhập địa chỉ email đã sử dụng để đăng ký Mixue Việt Nam tại đây</p>
                    <div id="forgot">
                        <div class="mb-3" style="width: 20vw">
                            <div class="input-field">
                                <input type="email" class="form-control" id="user_email" name="user_email" placeholder="Email" required>
                                <button class="mt-2 btn btn-primary" id="mailbtn" style="width: 20vw">Lấy mật khẩu</button>
                            </div>
                        </div>
                        <p class="mb-3"> Quay trở lại đăng nhập? <a href="{{ route('login') }}">Nhấn vào đây!</a> </p>
                    </div>
                    <form id="otpForm" method="POST" action="{{ route('forgotpwd-verify-otp') }}" style="display: none">
                        <input type="hidden" class="form-control" id="token" name="_token"
                               value="{{ csrf_token() }}">
                        @csrf
                        @if (session('login_error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('login_error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="mb-3" style="width: 20vw">
                            <div class="input-field">
                                <input type="text" class="form-control" id="otp" aria-describedby="emailHelp" placeholder="Mã OTP" >
                                <button type="submit" class="mt-2 btn btn-success" id="otpbtn" style="width: 20vw">Xác nhận</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        @include('notifications.index')
        <script src="{{ asset('frontend\js\notification.js') }}"></script>
        <script src="{{ asset('frontend\js\verifyforgotpwd.js') }}"></script>
        <script>
            $("#mailbtn").click((e) => {
                e.preventDefault();
                var user_email = $("#user_email").val();
                $.ajax({
                    url: '{{ route('rst-pwd') }}',
                    type: 'POST',
                    data: {
                        user_email: user_email,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        $("#forgot").hide();
                        $("#otpForm").show();
                        getOtpExpiryTimeAndSetTimer();
                    },
                    error: function() {
                        alert('Error sending OTP. Please try again.');
                    }
                });
            })
        </script>
    </body>
</html>
