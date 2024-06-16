@extends('home')

@section('content')
    <?php $content = Cart::content(); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="products-show-col col-md-9 px-0 d-sm-block" style="border-right: 1px solid #dfdfe3">
                <nav class="navbar-main">
                    <nav class="navbar navbar-expand-lg bg-body-tertiary">
                        <div class="container-fluid">
                            <a class="navbar-brand" href="{{ route('home') }}">
                                <img style="height: 3rem;" src="{{ asset('frontend\images\logo.png') }}">
                            </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarText">
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                    <li class="nav-item">
                                        <input type="hidden" class="form-control" id="token" name="_token"
                                            value="{{ csrf_token() }}">
                                        <div id="cartCount" data-count="{{ Cart::count() }}"
                                            data-restaurant-id="{{ $restaurant_id }}"></div>

                                    </li>
                                </ul>
                                <span class="navbar-item">
                                    @if (isset($currentUser))
                                        <a href="" class="fs-6 text-decoration-none dropdown-toggle"
                                            style="color:black; font-weight: 500;" data-bs-toggle="dropdown">
                                            <span style="color:#cb1c3b">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                                    <path fill-rule="evenodd"
                                                        d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                                                </svg>
                                            </span>
                                            <span>{{ $currentUser->user_name }}</span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <form action="{{ route('donhang') }}" method="GET">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item">Đơn hàng</button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="{{ route('logout') }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item">Đăng xuất</button>
                                                </form>
                                            </li>
                                        </ul>
                                    @else
                                        <a href="{{ route('login') }}" class="fs-6 text-decoration-none"
                                            style="color:black; font-weight: 500;">
                                            <span style="color:#cb1c3b">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                                    <path fill-rule="evenodd"
                                                        d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                                                </svg>
                                            </span>
                                            <span>Thành viên</span>
                                        </a>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </nav>
                    <nav class="nav nav-pills flex-column flex-sm-row">
                        <a onclick="showProduct(0)" class="flex-sm-fill text-sm-center nav-link active"
                            style="color:black; background-color:mistyrose;border-radius:0;user-select: none;">Tất cả</a>
                        @foreach ($category as $c)
                            <a onclick="showProduct('{{ $c->category_id }}')" data-id="{{ $c->category_id }}" class="flex-sm-fill text-sm-center nav-link active"
                                style="color:black; background-color:mistyrose;border-radius:0;user-select: none;">{{ $c->category_name }}</a>
                        @endforeach
                    </nav>

                </nav>
                <section class="container-lg mt-2">
                    <div class="row row-cols-1 row-cols-md-4 g-2">
                        @foreach ($products as $p)
                            <div data-category-id="{{ $p->category_id }}" class="products-option col" style="margin-bottom: var(--bs-gutter-y);">
                                <div class="card h-100" style="overflow: hidden;">
                                    <img src="{{ $p->product_image }}" class="card-img-top" alt="Mixue Viet Nam"
                                        loading="lazy" style="height: 300px;">
                                    <div class="card-body" style="background-color:white; z-index: 2">
                                        <h5 class="card-title" style="height: 50px;">
                                            <strong>{{ $p->product_name }}</strong>
                                        </h5>
                                        <p class="card-text">{{ $p->product_description }}</p>
                                        <div class="option">
                                            <div class="select is-normal mb-3" style="width:100%;">
                                                <select style="width:100%" name="ice">
                                                    @foreach ($ice as $iceOption)
                                                        <option value="{{ $iceOption->ice_id }}"
                                                            {{ $iceOption->ice_option == 'Bình thường' ? 'selected' : '' }}>
                                                            {{ $iceOption->ice_option }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="select is-normal mb-3" style="width:100%;">
                                                @if ($p->category_id == 1)
                                                    <select name="sugar" style="width:100%">
                                                        @foreach ($sugar as $sugarOption)
                                                            @if ($sugarOption->sugar_option == 'Bình thường')
                                                                <option value="{{ $sugarOption->sugar_id }}" selected>
                                                                    {{ $sugarOption->sugar_option }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                @else
                                                    <select name="sugar" style="width:100%">
                                                        @foreach ($sugar as $sugarOption)
                                                            <option value="{{ $sugarOption->sugar_id }}"
                                                                {{ $sugarOption->sugar_option == 'Bình thường' ? 'selected' : '' }}>
                                                                {{ $sugarOption->sugar_option }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @endif

                                            </div>
                                            <button type="button" class="add-to-cart btn btn-outline-success"
                                                style="width:100%;display:flex;justify-content: space-between;"
                                                data-rowid="{{ $p->product_id }}" data-name="{{ $p->product_name }}"
                                                data-price="{{ $p->product_price }}">
                                                <span>THÊM</span>
                                                <span>@currency($p->product_price)</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>

            </div>
            <div class="sidebar col-md-3 px-0 d-none d-sm-block mt-2">
                <div class="tittle-main d-flex justify-content-center">
                    <p>------ Giỏ hàng ------ </p>
                </div>

                <div class="products px-3 ">
                    @if (!Cart::content()->isEmpty())
                        <div class="row accordion"
                            style="height:40px; display:flex; flex-wrap: nowrap; flex-direction: column; height: 350px; overflow-y: auto;">
                            @foreach ($content as $v_content)
                                <div class="cart d-flex mt-3" data-rowid="{{ $v_content->rowId }}">
                                    <div class="col-1" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapse-{{ $v_content->rowId }}"
                                        aria-expanded="true"
                                        aria-controls="panelsStayOpen-collapse-{{ $v_content->rowId }}">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-chevron-compact-down"
                                                viewBox="0 0 16 16">
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
                                                        <path
                                                            d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8" />
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
                                            <p class="productNameOrder"><strong>{{ $v_content->name }}</strong></p>
                                            <p class="product-price" data-raw-price="{{ $v_content->price }}">
                                                @currency($v_content->price)</p>
                                        </div>
                                    </div>

                                    <div class="col-1">
                                        <button class="deleteProduct" type="button"
                                            style="border:unset;background-color: unset;"
                                            data-rowid="{{ $v_content->rowId }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <div id="panelsStayOpen-collapse-{{ $v_content->rowId }}"
                                    class="accordion-collapse collapse">
                                    <div class="accordion-body" style="padding-bottom: 5px;">
                                        <li>Đá:
                                            {{ $v_content->options->has('ice') ? $v_content->options->ice : 'Không có thông tin' }}
                                        </li>
                                        <li>Đường:
                                            {{ $v_content->options->has('sugar') ? $v_content->options->sugar : 'Không có thông tin' }}
                                        </li>
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
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                        <path
                                            d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                                    </svg></a>
                                <span>@currency($thanhvien)</span>
                            </p>
                            <p>
                                <span class="w-50">Giảm K.Mại</span>
                                <a type="button" data-bs-toggle="modal" data-bs-target="#khuyenmaiModal"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                        <path
                                            d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                                    </svg></a>
                                <span>@currency($khuyenmai)</span>
                            </p>
                            {{-- <p> <span>Phí Giao Hàng</span> <span id="shippingFee"></span> </p> --}}
                        </div>

                    </div>
                    <div class="container-fluid">
                        <a type="button" class="thanhtoantotal btn btn-success" href="{{ route('thanhtoan') }}"
                            style="width:100%;display:flex;justify-content: space-between; font-size: 15px;">
                            <span>THANH TOÁN</span>
                            <span id="subTotalPrice">@currency($subTotal)</span>
                        </a>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <script>
        const products = @json($products);
        console.log(products);
        
        function showProduct(category_id) {
            if (category_id == 0) {
                $('.products-option').show();
            } else {
                $('.products-option').hide();
                $(`.products-option[data-category-id=${category_id}]`).show();
            }
        }
    </script>

    @include('pages.modal')
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="{{ asset('frontend\js\home.js') }}"></script>
@endsection
