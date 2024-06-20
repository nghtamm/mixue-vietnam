<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng nhập vào Mixue Việt Nam</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('frontend\images\mixue-favicon.png') }}"/>
    @include('pages.head')
    <style>
        .title {
            font-family: "Open Sans", sans-serif;
            font-weight: 700;
            text-align: center;
        }
    </style>
    {{-- <script type="module" src="https://cdn.jsdelivr.net/npm/@bufferhead/nightowl@0.0.12/dist/nightowl.js"></script> --}}
</head>

<body>
    <section class="vh-100" style="background-image: url({{ asset('frontend/images/login.jpg') }}); object-fit: cover;">
        <div class="container py-2 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="{{ asset('frontend\images\popuplogin.png') }}" alt="login form"
                                    class="img-fluid"
                                    style="border-radius: 1rem 0 0 1rem; background-size: cover;height: 100%;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">
                                    <a href="{{ route('home') }}" class="d-flex mb-3"
                                        style="justify-content: center;"><img class="img-fluid"
                                            src="{{ asset('frontend\images\logo.png') }}" style="height: 60px;"></a>

                                    <h2 class="title mb-2 pb-3">Chào mừng bạn tới với Mixue Việt Nam! 🍦</h2>

                                    <h6 class="fw-normal mb-3 pb-3" style="text-align: center;">
                                        Chúc mừng bạn đã là thành viên của Mixue Việt Nam! Nhớ đăng nhập để có thể đặt đồ, thanh toán và tích điểm - đổi đồ uống miễn phí bạn nhé!</h6>

                                    <form method="POST" action="{{ route('login') }}">
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
                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control" id="floatingInput"
                                                placeholder="name@example.com" name="user_email"
                                                value="{{ old('user_email') }}" autofocus>
                                            <label for="floatingInput">Địa chỉ email</label>
                                        </div>

                                        <div class="form-floating mb-2 position-relative">
                                            <input type="password" class="form-control" id="floatingPassword"
                                                placeholder="Password" name="user_password">
                                            <label for="floatingPassword">Mật khẩu</label>
                                            <i class="bi bi-eye-slash" id="togglePassword"
                                                style="position: absolute; top: 50%; right: 20px; transform: translateY(-50%); cursor: pointer;"></i>
                                        </div>

                                        <div class="d-flex mb-2" style="justify-content: space-between">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="remember"
                                                    name="remember"
                                                    style="background-color: #198754;
                                                    border-color: #198754;"
                                                    checked>
                                                <label class="form-check-label" for="remember">
                                                    Lưu mật khẩu
                                                </label>
                                            </div>
                                            <div>
                                                <a href="{{ route('forgot-password') }}" style="color: #393f81; text-decoration: none">Quên
                                                    mật
                                                    khẩu</a>
                                            </div>
                                        </div>

                                        <div class="pt-1 mb-3" style="text-align: center;">
                                            <input type="submit" class="btn btn-success" style="width:100%"
                                                value="Đăng nhập">
                                        </div>

                                        <p class="mb-5 pb-lg-2" style="color: #393f81;">Bạn chưa có tài khoản? <a
                                                href="{{ route('register') }}" style="color: #393f81;">Đăng ký ngay</a>
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.getElementById('remember').addEventListener('change', function() {
            if (this.checked) {
                this.style.backgroundColor = '#198754';
            } else {
                this.style.backgroundColor = '';
            }
        });
    </script>
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#floatingPassword');

        togglePassword.addEventListener('click', function(e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the icon
            this.classList.toggle('bi-eye');
        });
    </script>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
