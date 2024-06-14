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
                <div class="row row-cols-1 row-cols-md-4 g-2">
                    @foreach ($restaurant as $r)
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $r->restaurant_name }}</h5>
                                    <p class="card-text" style="display:grid;margin-bottom: 0.5rem;">
                                        <span>Thời gian mở cửa: {{ $r->restaurant_openTime }}</span>
                                        <span>Thời gian đóng cửa: {{ $r->restaurant_closeTime }}</span>
                                    </p>
                                    <div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input default-checkbox" type="checkbox"
                                                role="switch" id="flexSwitchCheckChecked"
                                                data-restaurant-id="{{ $r->restaurant_id }}"
                                                id="flexSwitchCheck{{ $r->restaurant_id }}"
                                                {{ $r->restaurant_openStatus == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="fslexSwitchCheckChecked">Trạng thái cửa
                                                hàng</label>
                                        </div>
                                        <a href="{{ route('edit-restaurant', ['id' => $r->restaurant_id]) }}"
                                            class="btn btn-primary btn-sm">Sửa</a>
                                        <a href="#" class="btn btn-danger btn-sm">Xóa</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @include('notifications.notiAdmin')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="{{ asset('frontend\js\sidebar.js') }}"></script>
    <script src="{{ asset('frontend\js\sendAjaxRequest.js') }}"></script>
    <script src="{{ asset('frontend\js\notification.js') }}"></script>
    <script>
        //chuyển trạng thái mặc định bank
        $(document).ready(function() {
            $('.default-checkbox').on('change', function() {
                var restaurantId = $(this).data('restaurant-id');
                var checkboxId = 'flexSwitchCheck' + restaurantId;
                var data = {
                    _token: '{{ csrf_token() }}',
                    restaurant_openStatus: this.checked,
                    restaurantId: restaurantId,
                };

                // Gửi yêu cầu AJAX
                sendAjaxRequest('/system/shop/' + restaurantId + '/updateStatus/', 'POST',
                    data,
                    function(response) {
                        // Đặt thuộc tính 'checked' cho checkbox được chọn
                        $('#' + checkboxId).prop('checked', true).attr('checked', 'checked');

                        showToast(response.success);
                    },
                    function(error) { // onError
                        showToast('Error:', error);
                    }
                );
            });
        });
    </script>

</body>

</html>
