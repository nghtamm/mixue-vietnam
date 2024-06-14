<?php $content = Cart::content(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Giỏ hàng</title>
    @include('pages.head')
    <style>
        .navigation {
            position: absolute;
            bottom: 0px;
        }
    </style>
</head>

<body>
    <div class="sidebar-mobile col-12 px-0 d-sm-block mt-2">
        <div class="tittle-main d-flex justify-content-center">
            <p>------ Giỏ hàng ------</p>
        </div>

        <div class="products px-3 ">
            @if (!Cart::content()->isEmpty())
                <div class="row accordion"
                    style="display:flex; flex-wrap: nowrap; flex-direction: column; height: 220px; overflow-y: auto;">
                    <input type="hidden" class="form-control" id="token" name="_token"
                        value="{{ csrf_token() }}">
                    @foreach ($content as $v_content)
                        <div class="cart d-flex mt-3" data-rowid="{{ $v_content->rowId }}">
                            <div class="col-1" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapse-{{ $v_content->rowId }}" aria-expanded="true"
                                aria-controls="panelsStayOpen-collapse-{{ $v_content->rowId }}">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-chevron-compact-down" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M1.553 6.776a.5.5 0 0 1 .67-.223L8 9.44l5.776-2.888a.5.5 0 1 1 .448.894l-6 3a.5.5 0 0 1-.448 0l-6-3a.5.5 0 0 1-.223-.67z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="col-3"
                                style="padding-right: calc(var(--bs-gutter-x) * .3); padding-left: calc(var(--bs-gutter-x) * .1);">
                                <div class="d-flex" style="height:100%">
                                    <button type="button" class="product-qty btn btn-outline-success"
                                        style="font-size: 18px;width:50%;--bs-btn-hover-bg: unset; --bs-btn-hover-color:#198754"
                                        id="qty_{{ $v_content->rowId }}">{{ $v_content->qty }}</button>
                                    <div class="d-flex" style="flex-direction: column; margin-left: 5px;">
                                        <button type="button" class="increase-quantity btn btn-outline-success "
                                            data-rowid="{{ $v_content->rowId }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                                <path
                                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                                            </svg>
                                        </button>

                                        <button type="button" class="decrease-quantity btn btn-outline-success"
                                            data-rowid="{{ $v_content->rowId }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
                                                <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8" />
                                            </svg>
                                        </button>
                                    </div>

                                </div>
                            </div>
                            <div class="col-7">
                                <div class="products-show flex-column flex-sm-row" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapse-{{ $v_content->rowId }}"
                                    aria-expanded="true"
                                    aria-controls="panelsStayOpen-collapse-{{ $v_content->rowId }}">
                                    <p><strong>{{ $v_content->name }}</strong></p>
                                    <p class="product-price" data-raw-price="{{ $v_content->price }}">
                                        @currency($v_content->price)</p>
                                </div>
                            </div>

                            <div class="col-1">
                                <button class="deleteProduct" type="button"
                                    style="border:unset;background-color: unset;" data-rowid="{{ $v_content->rowId }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                        <path
                                            d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div id="panelsStayOpen-collapse-{{ $v_content->rowId }}" class="accordion-collapse collapse">
                            <div class="accordion-body" style="padding-bottom: 5px;">
                                <li>Đá: Bình thường</li>
                                <li>Đường: Bình thường</li>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="products-show-noti text-center">
                    <i class="bi bi-check2-circle" style="margin-right:5px;color:red"></i>
                    <p style="color:red">Không có sản phẩm nào trong giỏ hàng</p>
                </div>
            @endif
        </div>


        <section class="money" style="z-index:100;background-color: white;">
            <div class="total-money" style="background-color: #F5F7F9; padding-top: 15px;">
                <div class="container-fluid mb-3">
                    <div class="voucher row">
                        <div class="voucher-x col-8"><input type="text" class="form-control" id="voucher"
                                placeholder="Áp dụng Voucher"></div>
                        <div class="voucher-confirm col-4"><button type="button" class="btn btn-success"
                                style="font-size: 15px;">Xác
                                nhận</button></div>
                    </div>
                </div>

                <div class="money-show px-3">
                    <?php $total = 0;
                    $thanhvien = 0;
                    $khuyenmai = 0;
                    foreach (Cart::content() as $item) {
                        $total += $item->price * $item->qty;
                    }
                    $subTotal = $total + $khuyenmai + $thanhvien;
                    ?>
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
                    <p> <span>Phí Giao Hàng</span> <span>@currency($khuyenmai)</span> </p>
                </div>

            </div>
            <div class="container-fluid">
                <button type="button" class="thanhtoantotal btn btn-success"
                    style="width:100%;display:flex;justify-content: space-between; font-size: 15px;margin-bottom: 80px;">
                    <span>THANH TOÁN</span>
                    <span id="subTotalPrice">@currency($subTotal)</span>
                </button>
            </div>
        </section>
        <div class="navigation">
            <ul>
                <li class="list active">
                    <a href="{{ route('home') }}">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="text"> Home</span>
                    </a>
                </li>
                <li class="list">
                    <a href="{{ route('cart') }}">
                        <span class="icon">
                            <ion-icon name="cart-outline"></ion-icon>
                        </span>
                        <span class="text"> Cart</span>
                    </a>
                </li>
                <li class="list">
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="settings-outline"></ion-icon>
                        </span>
                        <span class="text"> Setting</span>
                    </a>
                </li>
                <li class="list">
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="notifications-outline"></ion-icon>
                        </span>
                        <span class="text"> Notification</span>
                    </a>
                </li>
                <li class="list">
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="call-outline"></ion-icon>
                        </span>
                        <span class="text"> Hotline</span>
                    </a>
                </li>
                <div class="indicator"></div>
            </ul>
        </div>

    </div>
    <script>
        const list = document.querySelectorAll('.list');

        function activeLink() {
            list.forEach((item) =>
                item.classList.remove('active'));
            this.classList.add('active');
        }
        list.forEach((item) =>
            item.addEventListener('click', activeLink));
    </script>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    @yield('js')
    @include('notifications.index')
    <script src="{{ asset('frontend\js\notification.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script>
        //fomrmat tiền
        var token = $('#token').val();
        var count = {{ Cart::count() }};

        function formatCurrencyVND(total) {
            return new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND'
            }).format(total);
        }

        function updateTotalPrice() {
            var total = 0;
            $('.cart').each(function() {
                var price = parseFloat($(this).find('.product-price').data('raw-price'));
                var qty = parseInt($(this).find('.product-qty').text());
                total += price * qty;
                new Intl.NumberFormat('vi-VN', {
                    style: 'currency',
                    currency: 'VND'
                }).format(1000);
            });
            $('#totalPrice').text(formatCurrencyVND(total).replace(/\s/g, ''));
        }

        function updateSubTotalPrice() {
            var total = 0;
            var khuyenmai = 0;
            var thanhvien = 0;
            var subTotal = 0;
            $('.cart').each(function() {
                var price = parseFloat($(this).find('.product-price').data('raw-price'));
                var qty = parseInt($(this).find('.product-qty').text());
                total += price * qty;
                subTotal = total + khuyenmai + thanhvien;
                new Intl.NumberFormat('vi-VN', {
                    style: 'currency',
                    currency: 'VND'
                }).format(1000);
            });
            $('#subTotalPrice').text(formatCurrencyVND(subTotal).replace(/\s/g, ''));
        }


        //delete Product
        $(document).on('click', '.deleteProduct', function(e) {
            e.preventDefault();
            var rowId = $(this).data('rowid');

            $.ajax({
                url: '/delete-product',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    rowId: rowId
                },
                success: function(response) {
                    if (response.success) {
                        // Xóa phần tử cart chứa nút này
                        $('button[data-rowid="' + rowId + '"]').closest('.cart').remove();
                        $('#panelsStayOpen-collapse-' + rowId).remove();

                        if ($('.cart').length === 0) {
                            $('.products').html(
                                '<div class="products-show-noti text-center">' +
                                '<i class="bi bi-check2-circle" style="margin-right:5px;color:red"></i>' +
                                '<p style="color:red">Không có sản phẩm nào trong giỏ hàng</p>' +
                                '</div>'
                            );
                        } else {
                            updateTotalPrice();
                            updateSubTotalPrice();
                            showToast(response.success);
                        }
                    }
                },
                error: function(error) {
                    showToast('Có lỗi xảy ra khi bạn xóa sản phẩm');
                }
            });
        });

        //Add to cart
        $(document).on('click', '.add-to-cart', function(e) {
            e.preventDefault();
            var productId = $(this).data('rowid');
            var productName = $(this).data('name');
            var productPrice = $(this).data('price');

            $.ajax({
                url: '/add-products',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: productId,
                    name: productName,
                    price: productPrice
                },
                success: function(response) {
                    if (response.success) {
                        addProductToCartDisplay(response.rowId, productName, productPrice, 1);
                        showToast(response.success);
                    }
                },
                error: function(error) {
                    showToast('Có lỗi xảy ra khi thêm sản phẩm');
                }
            });
        });

        function addProductToCartDisplay(rowId, name, price, qty) {
            var cartItem = $(`.cart[data-rowid="${rowId}"]`);
            var noProductMessage = $('.products-show-noti');
            var cartContainer = $('.products.px-3 .row');
            var cartNoProductContainer = $('.products.px-3');
            if (cartItem.length) {
                var currentQty = parseInt(cartItem.find('.product-qty').text());
                cartItem.find('.product-qty').text(currentQty + qty);
            } else {
                var formattedPrice = formatCurrencyVND(price);
                var productHtml =
                    `<div class="cart d-flex mt-3" data-rowid="${rowId}">
                                    <div class="col-1" data-bs-toggle="collapse"
                                            data-bs-target="#panelsStayOpen-collapse-${rowId}"
                                            aria-expanded="true"
                                            aria-controls="panelsStayOpen-collapse-${rowId}">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-chevron-compact-down" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M1.553 6.776a.5.5 0 0 1 .67-.223L8 9.44l5.776-2.888a.5.5 0 1 1 .448.894l-6 3a.5.5 0 0 1-.448 0l-6-3a.5.5 0 0 1-.223-.67z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="col-3"
                                        style="padding-right: calc(var(--bs-gutter-x) * .3); padding-left: calc(var(--bs-gutter-x) * .1);">
                                        <div class="d-flex" style="height:100%">
                                            <button type="button" class="product-qty btn btn-outline-success"
                                                style="font-size: 18px;width:50%;--bs-btn-hover-bg: unset; --bs-btn-hover-color:#198754"
                                                id="qty_${rowId}">${qty}</button>
                                            <div class="d-flex" style="flex-direction: column; margin-left: 5px;">
                                                <button type="button" class="increase-quantity btn btn-outline-success "
                                                    data-rowid="${rowId}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                                        <path
                                                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                                                    </svg>
                                                </button>

                                                <button type="button" class="decrease-quantity btn btn-outline-success"
                                                    data-rowid="${rowId}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
                                                        <path
                                                            d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8" />
                                                    </svg>
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-7">
                                        <div class="products-show flex-column flex-sm-row" data-bs-toggle="collapse"
                                            data-bs-target="#panelsStayOpen-collapse-${rowId}"
                                            aria-expanded="true"
                                            aria-controls="panelsStayOpen-collapse-${rowId}">
                                            <p><strong>${name}</strong></p>
                                            <p class="product-price" data-raw-price="${price}">${formattedPrice}</p>
                                        </div>
                                    </div>

                                    <div class="col-1">
                                        <button class="deleteProduct" type="button"
                                            style="border:unset;background-color: unset;"
                                            data-rowid="${rowId}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                                            </svg>
                                        </button>
                                    </div>

                                    
                    </div>
                    
                    <div id="panelsStayOpen-collapse-${rowId}" class="accordion-collapse collapse">
                                    <div class="accordion-body" style="padding-bottom: 5px;">
                                        <li>Đá: Bình thường</li>
                                        <li>Đường: Bình thường</li>
                                    </div>
                                </div>`;
                cartContainer.append(productHtml);
                if (noProductMessage.length) {
                    noProductMessage.remove();
                    var NoproductHtml =
                        `
                        <div class="row accordion"
                            style="height:40px; display:flex; flex-wrap: nowrap; flex-direction: column; height: 350px; overflow-y: auto;">
                            <div class="cart d-flex mt-3" data-rowid="${rowId}">
                                        <div class="col-1" data-bs-toggle="collapse"
                                                data-bs-target="#panelsStayOpen-collapse-${rowId}"
                                                aria-expanded="true"
                                                aria-controls="panelsStayOpen-collapse-${rowId}">
                                            <div>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-chevron-compact-down" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                        d="M1.553 6.776a.5.5 0 0 1 .67-.223L8 9.44l5.776-2.888a.5.5 0 1 1 .448.894l-6 3a.5.5 0 0 1-.448 0l-6-3a.5.5 0 0 1-.223-.67z" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="col-3"
                                            style="padding-right: calc(var(--bs-gutter-x) * .3); padding-left: calc(var(--bs-gutter-x) * .1);">
                                            <div class="d-flex" style="height:100%">
                                                <button type="button" class="product-qty btn btn-outline-success"
                                                    style="font-size: 18px;width:50%;--bs-btn-hover-bg: unset; --bs-btn-hover-color:#198754"
                                                    id="qty_${rowId}">${qty}</button>
                                                <div class="d-flex" style="flex-direction: column; margin-left: 5px;">
                                                    <button type="button" class="increase-quantity btn btn-outline-success "
                                                        data-rowid="${rowId}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                                            <path
                                                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                                                        </svg>
                                                    </button>

                                                    <button type="button" class="decrease-quantity btn btn-outline-success"
                                                        data-rowid="${rowId}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
                                                            <path
                                                                d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8" />
                                                        </svg>
                                                    </button>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-7">
                                            <div class="products-show flex-column flex-sm-row" data-bs-toggle="collapse"
                                                data-bs-target="#panelsStayOpen-collapse-${rowId}"
                                                aria-expanded="true"
                                                aria-controls="panelsStayOpen-collapse-${rowId}">
                                                <p><strong>${name}</strong></p>
                                                <p class="product-price" data-raw-price="${price}">${formattedPrice}</p>
                                            </div>
                                        </div>

                                        <div class="col-1">
                                            <button class="deleteProduct" type="button"
                                                style="border:unset;background-color: unset;"
                                                data-rowid="${rowId}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                    <path
                                                        d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                                                </svg>
                                            </button>
                                        </div>

                                        
                            </div>
                            <div id="panelsStayOpen-collapse-${rowId}" class="accordion-collapse collapse">
                                    <div class="accordion-body" style="padding-bottom: 5px;">
                                        <li>Đá: Bình thường</li>
                                        <li>Đường: Bình thường</li>
                                    </div>
                                </div>
                        </div>`;
                    cartNoProductContainer.append(NoproductHtml);
                }
            }
            updateTotalPrice();
            updateSubTotalPrice();
        }


        //update quantity
        $(document).on('click', '.increase-quantity', function(e) {
            e.preventDefault();
            var rowId = $(this).data('rowid');
            updateQuantity(rowId, 1);
        });

        $(document).on('click', '.decrease-quantity', function(e) {
            e.preventDefault();
            var rowId = $(this).data('rowid');
            updateQuantity(rowId, -1);
        });

        function updateQuantity(rowId, change) {
            var currentQty = parseInt($('#qty_' + rowId).text());
            var newQty = currentQty + change;
            if (newQty <= 0) {
                // Xóa sản phẩm khỏi giỏ hàng
                $.ajax({
                    url: 'shop/api/delete-product',
                    type: 'POST',
                    processData: false,
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        rowId: rowId
                    },
                    success: function(response) {
                        if (response.success) {
                            $('button[data-rowid="' + rowId + '"]').closest('.cart').remove();
                            $('#panelsStayOpen-collapse-' + rowId).remove();
                            showToast(response.success);
                            count = response.cartCount;
                            //console.log(count);
                            updateTotalPrice();
                            updateSubTotalPrice();
                        }
                    },
                    error: function(error) {
                        console.log(error);
                        showToast('Có lỗi xảy ra khi cập nhật sản phẩm');
                    }
                });
            } else {
                // Cập nhật số lượng
                $.ajax({
                    url: 'shop/api/update-quantity-product',
                    type: 'POST',
                    processData: false,
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        rowId: rowId,
                        change: change
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#qty_' + rowId).text(response.quantity);
                            showToast(response.success);
                            count = response.cartCount;
                            //console.log(count);
                            updateTotalPrice(); // Cập nhật tổng giá tiền
                            updateSubTotalPrice();
                        }
                    },
                    error: function(error) {
                        showToast('Có lỗi xảy ra khi cập nhật sản phẩm');
                        console.log(error);
                    }
                });
            }
        }
    </script>
</body>

</html>
