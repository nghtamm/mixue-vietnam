<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng ký tài khoản</title>
    @include('pages.head')
    <style>
        .title {
            font-family: "Open Sans", sans-serif;
            font-weight: 700;
            text-align: center;
        }

        .password span {
            color: green;
        }
    </style>
    <script>
        function validatePassword() {
            var password = document.getElementById("floatingPassword").value;
            var submitBtn = document.getElementById("submitBtn");

            // Điều kiện regex cho từng yêu cầu
            var regexNumber = /\d/; // Ít nhất một số
            var regexLowerCase = /[a-z]/; // Ít nhất một chữ cái thường
            var regexUpperCase = /[A-Z]/; // Ít nhất một chữ cái hoa
            var regexSpecialChar = /[!@#$%^&*]/; // Ít nhất một ký tự đặc biệt
            var regexTrim = /^\S*$/; // Không có khoảng trắng

            var requirementsMet = true; // Biến để kiểm tra xem tất cả các yêu cầu có được đáp ứng

            // Kiểm tra yêu cầu: Ít nhất 1 số
            document.getElementById("requirementNumber").style.color = regexNumber.test(password) ? "green" : "gray";
            requirementsMet = requirementsMet && regexNumber.test(password);

            // Kiểm tra yêu cầu: Ít nhất 1 chữ cái thường
            document.getElementById("requirementLowerCase").style.color = regexLowerCase.test(password) ? "green" : "gray";
            requirementsMet = requirementsMet && regexLowerCase.test(password);

            // Kiểm tra yêu cầu: Ít nhất 1 chữ cái hoa
            document.getElementById("requirementUpperCase").style.color = regexUpperCase.test(password) ? "green" : "gray";
            requirementsMet = requirementsMet && regexUpperCase.test(password);

            // Kiểm tra yêu cầu: Ít nhất 1 ký tự đặc biệt
            document.getElementById("requirementSpecialChar").style.color = regexSpecialChar.test(password) ? "green" :
                "gray";
            requirementsMet = requirementsMet && regexSpecialChar.test(password);

            // Kiểm tra yêu cầu: Không có khoảng trắng
            document.getElementById("requirementTrim").style.color = regexTrim.test(password) ? "green" : "gray";
            requirementsMet = requirementsMet && regexTrim.test(password);

            // Cập nhật trạng thái nút submit dựa trên mật khẩu hiện tại
            if (requirementsMet && password.length >= 8) {
                submitBtn.style.backgroundColor = "green"; // Màu xanh
                submitBtn.disabled = false;
            } else {
                submitBtn.style.backgroundColor = "gray"; // Màu xám
                submitBtn.disabled = true;
            }
        }
    </script>
</head>

<body>
    <section class="vh-100" style="background-image: url({{ asset('frontend/images/login.png') }}); object-fit: cover;">
        <div class="container py-2 h-100">

            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card p-2 mb-2" style="border-radius: 0.5rem; display:block">
                        <a type="button" href="{{ route('home') }}" class="btn btn-primary btn-sm">Trang chủ</a>
                        <a type="button" href="{{ route('login') }}" class="btn btn-secondary btn-sm">Đăng nhập</a>
                    </div>
                    <div class="card" style="border-radius: 1rem;">
                        <form method="POST" action="{{ route('addUserRegister') }}">
                            @csrf
                            <div class="row g-0">
                                <h2 class="title mt-3 mb-1 pb-1">ĐĂNG KÝ NGƯỜI DÙNG</h2>

                                <h6 class="fw-normal mb-1 pb-3 px-2" style="text-align: center;">
                                    ĐĂNG KÝ TÀI KHOẢN NGƯỜI DÙNG VÀ ĐĂNG NHẬP
                                    TRƯỚC KHI THANH TOÁN ĐỂ TÍCH ĐIỂM – ĐỔI ĐỒ UỐNG NHÉ!</h6>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="col-md-6 col-lg-6 px-2 d-md-block">
                                    <div class="form-floating mb-3">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="user_name"
                                                placeholder="Nguyen Hoai Nam" name="user_name"
                                                value="{{ old('user_name') }}">
                                            <label for="user_name">Full Name</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control" id="user_email"
                                                placeholder="name@example.com" name="user_email"
                                                value="{{ old('user_email') }}">
                                            <label for="user_email">Email
                                                address</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="tel" class="form-control" id="user_phone"
                                                placeholder="0964xxxxxx" name="user_phone"
                                                value="{{ old('user_phone') }}">
                                            <label for="user_phone">Số
                                                điện thoại</label>
                                        </div>
                                        <div class="form-floating mb-2">
                                            <select class="form-select form-select" aria-label="Large select example"
                                                name="user_gender">
                                                <option value="male">Nam</option>
                                                <option value="female">Nữ</option>
                                            </select>
                                            <label for="user_gender">Chọn giới tính</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 px-2 align-items-center">
                                    <div class="input-group mb-3">
                                        <div class="form-floating position-relative">
                                            <input type="text" class="form-control" id="user_address"
                                                name="user_address" placeholder="Nhập địa chỉ"
                                                value="{{ old('user_address') }}">
                                            <label for="user_address">Địa chỉ</label>
                                            <button type="button"
                                                class="btn position-absolute top-50 end-0 translate-middle-y me-3"
                                                id="locate-me">
                                                <i class="bi bi-crosshair"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="form-floating mb-2">
                                        <input type="password" class="form-control" id="floatingPassword"
                                            placeholder="Nhập mật khẩu của bạn" name="user_password"
                                            onkeyup="validatePassword()" required>
                                        <label for="floatingPassword">Password</label>
                                    </div>

                                    <div class="password mb-2 pb-lg-2" style="display: grid;">
                                        <strong>Mật khẩu ít nhất 8 ký tự và đáp ứng 5 điều kiện sau:</strong>
                                        <span id="requirementNumber">
                                            <i class="bi bi-exclamation-circle"></i>
                                            Các số 0-9. Ví dụ: 2, 6, 7
                                        </span>
                                        <span id="requirementLowerCase">
                                            <i class="bi bi-exclamation-circle"></i>
                                            Các chữ cái thường (nhỏ) a-z. Ví dụ: a, e, r
                                        </span>
                                        <span id="requirementUpperCase">
                                            <i class="bi bi-exclamation-circle"></i>
                                            Chữ cái viết hoa (in hoa) A-Z. Ví dụ: A, E, R
                                        </span>
                                        <span id="requirementSpecialChar">
                                            <i class="bi bi-exclamation-circle"></i>
                                            Các ký tự đặc biệt như !@#$
                                        </span>
                                        <span id="requirementTrim">
                                            <i class="bi bi-exclamation-circle"></i>
                                            Không có khoảng trắng
                                        </span>
                                    </div>
                                </div>
                                <div class="cf-turnstile text-center"
                                    data-sitekey="{{ config('services.turnstile.site') }}"></div>
                                <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
                            </div>
                            <div class="ps-3 pe-3 mb-3" style="text-align: center;">
                                <input type="submit" class="btn btn-success" id="submitBtn" style="width:50%"
                                    value="Đăng ký">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="{{ asset('frontend\js\map\mapGoogle.js') }}"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyAI9kPkskayYti5ttrZL_UfBlL3OkMEbvs">
    </script>
</body>

</html>
