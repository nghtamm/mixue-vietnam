<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cảm ơn đã mua hàng</title>
    @include('pages.head')
    <link rel="stylesheet" href="{{ asset('frontend/css/payment.css') }}">
</head>

<body>
    @include('payment.head')
    <div class="d-flex justify-content-center align-items-center" style="height: 50%">
        <div>
            <div class="mb-3 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="text-success" width="75" height="75"
                    fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                    <path
                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                </svg>
            </div>
            <div class="text-center">
                <h1>Cảm ơn bạn đã đặt đồ uống!</h1>
                <p>Chúng tôi sẽ gửi email khi đơn đã được xác nhận từ phía cửa hàng. Bạn có thể kiểm tra đơn hàng tại
                    mục đơn hàng.</p>
                <p>Nếu bạn chọn hình thức chuyển khoản, vui lòng nhắn tin tới page để thanh toán!!!</p>
                <a type="button" href="/" class="btn btn-success">Quay lại trang chủ</a>
            </div>
        </div>
    </div>
</body>

</html>
