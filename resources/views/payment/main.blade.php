@extends('payment.index')

@section('payment')
    <div class="container-fluid">
        <section class="container-fluid mt-2">
            <nav class="navbar bg-body-tertiary" style="border-bottom:unset; position: unset;">
                <div class="container-fluid">
                    <div class="d-flex" style="align-items: center;">
                        <h2 style="padding-right: 15px;">XÁC NHẬN THÔNG TIN KHÁCH HÀNG</h2>
                        <button type="button" class="btn btn-success btn-sm"
                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;--bs-btn-bg:#CB1C3B;--bs-btn-border-color:unset;--bs-btn-hover-bg:#CB1C3B">Số
                            lượng sản phẩm: {{ Cart::count() }}</button>
                    </div>
                    <a type="button" id="backToMenuLink" class="btn btn-outline-success">Quay lại menu</a>
                </div>
            </nav>
        </section>
        <div class="row" style="padding: 0px 25px 0px 25px;">
            <input type="hidden" class="form-control" id="token" name="_token" value="{{ csrf_token() }}">
            <div class="col-sm-9 px-3 d-sm-block">
                @include('notifications.alert')

                <section class="payment-information container mt-2">
                    <div class="form-check" style="padding-top: 10px;">
                        <input class="form-check-input" type="checkbox" value="" id="order_nguoithan"
                            data-bs-toggle="collapse" data-bs-target="#collapseMap" aria-expanded="false"
                            aria-controls="collapseMap">
                        <label class="form-check-label" for="order_nguoithan">
                            Gửi tặng đồ uống
                        </label>
                    </div>
                    <div class="row" style="padding-top: 10px;">
                        <div id="collapseMap" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="order_nthan_name"
                                                placeholder="Nhập tên" required>
                                            <label for="order_nthan_name">Họ và tên</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="order_nthan_sdt"
                                                placeholder="Nhập sđt" required>
                                            <label for="order_nthan_sdt">Số điện thoại</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="input-group mb-3">
                                            <div class="form-floating position-relative">
                                                <input type="text" class="form-control" id="order_nthan_address"
                                                    placeholder="Nhập địa chỉ" required>
                                                <label for="order_nthan_address">Địa chỉ</label>
                                                <button type="button"
                                                    class="btn position-absolute top-50 end-0 translate-middle-y me-3"
                                                    id="locate-me">
                                                    <i class="bi bi-crosshair"></i>
                                                </button>
                                            </div>
                                            <button class="input-group-text map-button"
                                                style="background-color: #198754;"><i class="bi bi-map-fill"
                                                    style="color:white"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>Thông tin cá nhân của bạn (Chúng tôi sẽ gửi tới người bạn của bạn)</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="order_username" placeholder="Nhập tên"
                                    value="{{ $user->user_name ?? '' }}" required disabled>
                                <label for="order_username">Họ và tên</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="order_sdt" placeholder="Nhập sđt"
                                    value="{{ $user->user_phone ?? '' }}" required disabled>
                                <label for="order_sdt">Số điện thoại</label>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="order_email" placeholder="Nhập email"
                                    value="{{ $user->user_email ?? '' }}" required disabled>
                                <label for="order_email">Email</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group mb-3">
                                <div class="form-floating position-relative">
                                    <input type="text" class="form-control" id="order_address"
                                        placeholder="Nhập địa chỉ" value="{{ $user->user_address ?? '' }}" required
                                        disabled>
                                    <label for="order_address">Địa chỉ</label>
                                </div>
                                {{-- <button class="input-group-text map-button" style="background-color: #198754;"><i
                                        class="bi bi-map-fill" style="color:white"></i></button> --}}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="messageshop" name="messageshop"
                                    placeholder="Lời nhắn">
                                <label for="messageshop">Ghi chú đơn hàng</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="delivery-time form-floating mb-3">
                                            <select class="form-select" id="delivery-time-option"
                                                name="delivery-time-option" aria-label="Default select example"
                                                placeholder="Thời gian" required>
                                                <option value="1">Càng sớm càng tốt</option>
                                                <option value="2">Thời gian cụ thể</option>
                                            </select>
                                            <label for="delivery-time-option">Thời gian giao hàng</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="specific-time form-floating mb-3">
                                            <select class="form-select" id="specific-time-option"
                                                name="specific-time-option" aria-label="Default select example"
                                                placeholder="Thời gian cụ thể">
                                                <option value="1">8.00</option>
                                                <option value="2">9.00</option>
                                            </select>
                                            <label for="specific-time-option">Thời gian cụ thể</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </section>
            </div>
            <div class="col-sm-3 px-0 mt-2" style="background-color: #CB1C3B;border-radius: 10px;">
                <section class="payment-description container-fluid mt-2 px-3">

                    <div class="money-show-payment">
                        <?php $total = 0;
                        $thanhvien = 0;
                        $khuyenmai = 0;
                        foreach (Cart::content() as $item) {
                            $total += $item->price * $item->qty;
                        }
                        $subTotal = $total + $khuyenmai + $thanhvien;
                        ?>
                        <div id="cartSummary" data-total="{{ $total }}" data-khuyenmai="{{ $khuyenmai }}"
                            data-thanhvien="{{ $thanhvien }}"></div>
                        <p> <span>Tổng</span> <span id="totalPrice">@currency($total)</span> </p>
                        <p>
                            <span class="w-50">Giảm T.Viên</span>
                            <a tyle="button" data-bs-toggle="modal" data-bs-target="#thanhvienModal"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-info-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                    <path
                                        d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                                </svg></a>
                            <span>@currency($thanhvien)</span>
                        </p>
                        <p>
                            <span class="w-50">Giảm K.Mại</span>
                            <a type="button" data-bs-toggle="modal" data-bs-target="#khuyenmaiModal"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-info-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                    <path
                                        d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                                </svg></a>
                            <span>@currency($khuyenmai)</span>
                        </p>
                        <p> <span>Phí Giao Hàng</span> <span id="shippingFee"></span> </p>
                    </div>
                    <div class="payment ">
                        <h2 style="margin-bottom: .2rem;">Thanh toán: </h2>
                        <h1 id="subTotal">@currency($subTotal)</h1>
                    </div>
                    <div class="phuongthucthanhtoan">
                        <p>Phương thức thanh toán</p>
                        <div>
                            <div class="form-check mb-3"
                                style="display:flex;align-items: center;justify-content: space-between;">
                                <input class="form-check-input" type="radio" name="order_payment" id="order_payment1"
                                    value="0" checked>
                                <label class="form-check-label" for="order_payment1" style="width: 100%;">
                                    <button type="button" class="tienmat d-flex">
                                        <img src="{{ asset('frontend/images/cash.webp') }}" class="card-img-top"
                                            style="width:50px;margin-right: 20px;" alt="...">
                                        Thanh toán bằng tiền mặt
                                    </button>
                                </label>
                            </div>
                            <div class="form-check mb-3"
                                style="display:flex;align-items: center;justify-content: space-between;">
                                <input class="form-check-input" type="radio" name="order_payment" id="order_payment2"
                                    value="1">
                                <label class="form-check-label" for="order_payment2" style="width: 100%;">
                                    <button type="button" class="tienmat d-flex">
                                        <img src="{{ asset('frontend/images/vnpay-logo.jpg') }}" class="card-img-top"
                                            style="width:50px;margin-right: 20px;" alt="...">
                                        Thanh toán chuyển khoản
                                    </button>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="description mb-4" style="font-size: 15px;">
                        <p>Quý khách vui lòng kiểm tra lại thông tin trước khi ấn xác nhận đơn hàng</p>
                        <button type="button" id="confirmOrder" class="btn btn-light"
                            style="width: 100%;--bs-btn-color:#CB1C3B" onclick="processCheckout()">
                            <strong>XÁC NHẬN ĐƠN HÀNG</strong></button>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script>
        var token = $('#token').val();

        function formatCurrencyVND(total) {
            return new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND'
            }).format(total);
        }

        function calculateShippingFee(restaurantId) {
            // console.log(restaurantId);
            // var restaurantId = @json(session('restaurant_id'));
            var isGift = $('#order_nguoithan').is(':checked');
            var formData = {
                _token: token,
                restaurantId: restaurantId,
                isGift: isGift
            };
            // console.log('Tính tiền từ cửa hàng: ' + restaurantId);

            if (isGift) {
                formData.recipient_address = $('#order_nthan_address').val();
            } else {
                formData.user_address = $('#order_address').val();
            }
            $.ajax({
                url: 'shop/api/get-restaurant',
                method: 'POST',
                data: formData,
                success: function(response) {
                    if (response.shipping_fee !== null) {
                        shippingFee = response.shipping_fee;
                        var formattedShippingFee = formatCurrencyVND(shippingFee);
                        $('#shippingFee').html(formattedShippingFee);
                        updateSubTotal(shippingFee);
                        // console.log(shippingFee);
                    } else {
                        $('#shippingFee').text('Không thể tính phí giao hàng');
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error: " + error);
                    $('#shippingFee').text('Lỗi khi tính phí giao hàng');
                }
            });
        }

        // $(document).ready(function() {
        //     var restaurantId = @json(session('restaurant_id'));
        //     if (restaurantId) {
        //         calculateShippingFee(restaurantId);
        //     }
        // });

        $(document).ready(function() {
            $.ajax({
                url: 'shop/api/get-restaurant-id',
                type: 'GET',
                success: function(response) {
                    var restaurantId = response.restaurantId;
                    // Bạn có thể sử dụng restaurantId ở đây
                    // console.log(restaurantId);
                    if (restaurantId) {
                        calculateShippingFee(restaurantId);
                        document.getElementById('backToMenuLink').setAttribute('href', '/shop/' +
                            restaurantId);
                    }
                },
                error: function(error) {
                    console.log('Error:', error);
                }
            });
        });


        function updateSubTotal(shippingFee) {
            var total = Number($('#cartSummary').data('total'));
            var khuyenmai = Number($('#cartSummary').data('khuyenmai'));
            var thanhvien = Number($('#cartSummary').data('thanhvien'));

            var subTotal = total + khuyenmai + thanhvien + parseFloat(shippingFee);
            var formattedSubTotal = formatCurrencyVND(subTotal);
            // console.log(formattedSubTotal);

            $('#subTotal').html(formattedSubTotal);
        }

        var searchInput = 'order_nthan_address';

        $(document).ready(function() {
            var autocomplete;
            autocomplete = new google.maps.places.Autocomplete((document.getElementById(searchInput)), {
                componentRestrictions: {
                    country: "VN"
                }
            });

            google.maps.event.addListener(autocomplete, 'place_changed', function() {
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    console.error("No details available for the input: '" + place.name + "'");
                    return;
                }

                var address = place.formatted_address;
                calculateShippingFee(address);
            });

            $('#order_nthan_name, #order_email, #order_nthan_sdt, #order_name, #order_sdt').on('change',
                function() {
                    var name = $('#order_nthan_name').val();
                    var email = $('#order_email').val();
                    var phone = $('#order_nthan_sdt').val();

                    $.ajax({
                        url: '/thanhtoan/validate-input',
                        type: 'POST',
                        data: {
                            name: name,
                            email: email,
                            phone: phone,
                            _token: token
                        },
                        success: function(response) {
                            $('#order_nthan_name').removeClass('is-invalid');
                            $('#order_nthan_sdt').removeClass('is-invalid');
                            // showAlert().hide();
                            $('#alert').html('');
                            // console.log('test');
                        },
                        error: function(error) {
                            // showToast(response.responseJSON.errors.phone);
                            showAlert(error.responseJSON.message);
                            $('#order_nthan_name').addClass('is-invalid');
                            $('#order_nthan_sdt').addClass('is-invalid');
                            // Xử lý lỗi và hiển thị thông báo
                            // console.log(response.responseJSON.errors);
                            console.log(error);
                        }
                    });
                });
        });

        document.getElementById('locate-me').addEventListener('click', function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var latlng = position.coords.latitude + "," + position.coords.longitude;

                    // Sử dụng Geocoding API để chuyển đổi latlng thành địa chỉ
                    fetch('https://maps.googleapis.com/maps/api/geocode/json?latlng=' + latlng +
                            '&key=AIzaSyDvt90oCXt10RAfYuWtY8M4RBHzTkndfGg')
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'OK') {
                                if (data.results[0]) {
                                    var address = document.getElementById('order_nthan_address').value =
                                        data
                                        .results[0]
                                        .formatted_address;
                                    calculateShippingFee(address);
                                    console.log(address);
                                } else {
                                    console.error('No results found');
                                }
                            } else {
                                console.error('Geocoder failed due to: ' + data.status);
                            }
                        }).catch(error => console.error('Error:', error));
                }, function(error) {
                    console.error('Error occurred: ' + error.message);
                }, {
                    enableHighAccuracy: true,
                    timeout: 5000,
                    maximumAge: 0
                });
            } else {
                console.error('Geolocation is not supported by this browser.');
            }
        });

        function processCheckout() {
            $('#loadingOverlay').show();
            // data.message = $('#messageshop').val();
            var message_shop = $('input[name="messageshop"]').val();
            var restaurantId = localStorage.getItem('restaurant_id');
            var delivery_time = $('#delivery-time-option').val();
            var specific_time = $('#specific-time-option').val();
            var order_payment = $('input[name="order_payment"]:checked').val();
            // console.log(restaurantId, specific_time, delivery_time);
            // console.log('Order payment: ', order_payment);
            var isGift = $('#order_nguoithan').is(':checked');
            // console.log(isGift);
            var formData = {
                _token: token,
                restaurant_id: restaurantId,
                delivery_time: delivery_time,
                specific_time: specific_time,
                order_payment: order_payment,
                message_shop: message_shop,
                isGift: isGift
            };

            if (isGift) {
                formData.recipient_name = $('#order_nthan_name').val();
                formData.recipient_phone = $('#order_nthan_sdt').val();
                formData.recipient_address = $('#order_nthan_address').val();
            } else {
                formData.user_name = $('#order_username').val();
                formData.user_phone = $('#order_sdt').val();
                formData.user_address = $('#order_address').val();
            }
            // console.log('Bản thân: ', formData.user_name, formData.user_address, formData.user_phone);
            // console.log('Người thân: ', formData.recipient_name, formData.recipient_phone, formData.recipient_address);
            if (!restaurantId) {
                showToast('Restaurant ID không tồn tại.');
                return false;
            } else {
                $.ajax({
                    url: 'shop/api/process-checkout',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        window.location.href = response.redirectURL;
                        // console.log(response.redirectURL);
                    },
                    error: function(error) {
                        showAlert(error.responseJSON.message || 'Đã xảy ra lỗi khi xử lý đơn hàng.');
                        console.error('Error:', error);
                        $('#loadingOverlay').hide();
                    }
                });
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            var deliveryTimeSelect = document.getElementById('delivery-time-option');
            var specificTimeSelect = document.getElementById('specific-time-option');

            function clearTimeOptions() {
                specificTimeSelect.innerHTML = ''; // Xóa các lựa chọn
            }

            function roundUpTime(date) {
                var minutes = date.getMinutes();
                var roundedMinutes = Math.ceil(minutes / 15) * 15;
                date.setMinutes(roundedMinutes);
                return date;
            }

            function parseTime(timeString) {
                var parts = timeString.split(':');
                return {
                    hour: parseInt(parts[0], 10),
                    minute: parseInt(parts[1], 10)
                };
            }

            function populateTimeOptions(restaurantId) {
                $.ajax({
                    url: 'thanhtoan/checkRestaurantTime',
                    method: 'POST',
                    data: {
                        _token: token,
                        restaurant_id: restaurantId
                    },
                    success: function(response) {
                        var openTimeParts = parseTime(response.openTime);
                        var closeTimeParts = parseTime(response.closeTime);
                        var currentTime = new Date();
                        currentTime = roundUpTime(currentTime); // Làm tròn thời gian hiện tại
                        currentTime.setMinutes(currentTime.getMinutes() + 30); // Cộng thêm 30 phút
                        specificTimeSelect.innerHTML = ''; // Xóa các lựa chọn hiện có
                        // console.log('Thời gian mở cửa và đóng cửa:', openTimeParts, closeTimeParts);
                        for (var i = 0; i < 10; i++) { // Tạo các lựa chọn thời gian
                            var timeOption = new Date(currentTime.getTime() + i * 15 * 60000);
                            if ((timeOption.getHours() > closeTimeParts.hour) ||
                                (timeOption.getHours() === closeTimeParts.hour && timeOption
                                    .getMinutes() > closeTimeParts.minute) ||
                                (timeOption.getHours() < openTimeParts.hour) ||
                                (timeOption.getHours() === openTimeParts.hour && timeOption
                                    .getMinutes() < openTimeParts.minute)) {
                                continue;
                            }
                            var timeValue = timeOption.toLocaleTimeString('it-IT', {
                                hour: '2-digit',
                                minute: '2-digit',
                                hour12: false
                            });
                            $('#specific-time-option').append($('<option>', {
                                value: timeValue,
                                text: timeValue
                            }));
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error: " + error);
                    }
                });
            }

            deliveryTimeSelect.addEventListener('change', function() {
                if (this.value === '2') {
                    var restaurantId = @json(session('restaurant_id'));
                    // console.log(restaurantId);
                    if (restaurantId) {
                        populateTimeOptions(restaurantId);
                    }
                } else {
                    clearTimeOptions();
                }
            });
            clearTimeOptions();
        });
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyDvt90oCXt10RAfYuWtY8M4RBHzTkndfGg">
    </script>
    @include('pages.modal')
@endsection
