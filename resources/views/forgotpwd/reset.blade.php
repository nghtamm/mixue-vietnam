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
                <div class="card d-flex justify-content-center align-items-center pb-4" style="box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35); width: 40rem; width: 40rem; border-radius: 14px; width: fit-content; height: fit-content; padding-left: 100px; padding-right: 100px">
                    <h1 class="mb-4 mt-5">Bạn bị quên mật khẩu?</h1>
                    <p>Nhập vào mật khẩu mới</p>
                    <form id="forgot" method="POST" action="{{ route('change-password') }}">
                        @csrf
                        <div class="mb-3 w-75">
                            <div class="input-field" style="width: 20vw">
                                <input type="password" class="form-control" id="password" placeholder="Nhập vào mật khẩu mới">
                            </div>
                        </div>
                        <div class="mb-3 w-75">
                            <div class="input-field" style="width: 20vw">
                                <input type="password" class="form-control" id="re-password" placeholder="Nhập lại mật khẩu mới">
                            </div>
                        </div>
                        <div class="submit-container mb-5" id="confirm">
                            <button id="submit" class="btn btn-primary custom-btn" style="width: 20vw">Xác nhận</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <script>
            function validatePassword(password) {
                // Kiểm tra xem mật khẩu có ít nhất một chữ cái thường, một chữ cái hoa, một chữ số, một ký tự đặc biệt và không có khoảng trắng
                var re = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
                return re.test(password);
            }

            $("#confirm").click((e) => {
                e.preventDefault();
                var password = $("#password").val();
                var rePassword = $("#re-password").val();

                if (password !== rePassword) {
                    alert('Mật khẩu và mật khẩu xác nhận không khớp.');
                    return;
                }

                if (!validatePassword(password)) {
                    alert('Mật khẩu phải bao gồm ít nhất 8 ký tự, thỏa mãn các điều kiện chứa ít nhất một chữ cái thường, một chữ cái hoa, một chữ số, một ký tự đặc biệt và không có khoảng trắng.');
                    return;
                }

                $.ajax({
                    url: '{{ route('change-password') }}',
                    type: 'POST',
                    data: {
                        user_password: password,
                        user_repassword: rePassword,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        alert('Mật khẩu đã được thay đổi thành công.');
                        window.location.href = '{{ route('login') }}';
                    },
                    error: function(err) {
                        console.log(err);
                        alert('Có lỗi xảy ra khi thay đổi mật khẩu. Vui lòng thử lại.');
                    }
                });
            })
        </script>
    </body>
</html>
