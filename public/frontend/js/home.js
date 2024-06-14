$("#closeOffcanvasBtn").click(function () {
    $("#offcanvasBottom").offcanvas("hide");
});

//fomrmat tiền
var token = $("#token").val();
var count = $("#cartCount").data("count");

function formatCurrencyVND(total) {
    return new Intl.NumberFormat("vi-VN", {
        style: "currency",
        currency: "VND",
    }).format(total);
}

function updateTotalPrice() {
    var total = 0;
    $(".cart").each(function () {
        var price = parseFloat(
            $(this).find(".product-price").data("raw-price")
        );
        var qty = parseInt($(this).find(".product-qty").text());
        total += price * qty;
    });
    $("#totalPrice").text(formatCurrencyVND(total).replace(/\s/g, ""));
}

$(document).ready(function () {
    var newRestaurantId = localStorage.getItem("restaurant_id");

    // Kiểm tra sự thay đổi restaurant_id và xử lý giỏ hàng nếu cần
    $.ajax({
        url: "api/check-restaurant-change",
        type: "POST",
        data: {
            _token: token,
            newRestaurantId: newRestaurantId,
        },
        success: function (response) {
            if (response.needToClearCart) {
                // console.log(response.needToClearCart);
                localStorage.setItem("restaurant_id", response.restaurantId);
                clearCart(response.newRestaurantId); // Xóa giỏ hàng nếu cần và cập nhật UI
            } else {
                console.log(
                    "Giữ nguyên giỏ hàng do ID nhà hàng không thay đổi."
                );
            }
        },
        error: function (error) {
            console.error("Error:", error);
        },
    });
});

function clearCart() {
    $.ajax({
        url: "api/clear-cart",
        type: "POST",
        data: {
            _token: token,
        },
        success: function (response) {
            $(".products").html(
                '<div class="products-show-noti text-center">' +
                    '<i class="bi bi-check2-circle" style="margin-right:5px;color:red"></i>' +
                    '<p style="color:red">Không có sản phẩm nào trong giỏ hàng</p>' +
                    "</div>"
            );
            updateTotalPrice();
            updateSubTotalPrice();
            showToast(response.success);
        },
        error: function (error) {
            console.error("Error clearing cart:", error);
        },
    });
}

function updateSubTotalPrice() {
    var total = 0;
    var khuyenmai = 0;
    var thanhvien = 0;
    var subTotal = 0;
    $(".cart").each(function () {
        var price = parseFloat(
            $(this).find(".product-price").data("raw-price")
        );
        var qty = parseInt($(this).find(".product-qty").text());
        total += price * qty;
        // subTotal = parseFloat(total) + parseFloat(khuyenmai) + parseFloat(thanhvien) + parseFloat(
        //     shippingFee);
        subTotal =
            parseFloat(total) + parseFloat(khuyenmai) + parseFloat(thanhvien);
    });
    $("#subTotalPrice").text(formatCurrencyVND(subTotal).replace(/\s/g, ""));
}

//delete Product
$(document).on("click", ".deleteProduct", function (e) {
    e.preventDefault();
    var rowId = $(this).data("rowid");

    $.ajax({
        url: "api/delete-product",
        type: "POST",
        data: {
            _token: token,
            rowId: rowId,
        },
        success: function (response) {
            if (response.success) {
                // Xóa phần tử cart chứa nút này
                $('button[data-rowid="' + rowId + '"]')
                    .closest(".cart")
                    .remove();
                $("#panelsStayOpen-collapse-" + rowId).remove();

                if ($(".cart").length === 0) {
                    $(".products").html(
                        '<div class="products-show-noti text-center">' +
                            '<i class="bi bi-check2-circle" style="margin-right:5px;color:red"></i>' +
                            '<p style="color:red">Không có sản phẩm nào trong giỏ hàng</p>' +
                            "</div>"
                    );

                    updateTotalPrice();
                    updateSubTotalPrice();
                } else {
                    updateTotalPrice();
                    updateSubTotalPrice();
                    count = response.cartCount;
                    //console.log(count);
                    showToast(response.success);
                }
            }
        },
        error: function (error) {
            showToast("Có lỗi xảy ra khi bạn xóa sản phẩm");
        },
    });
});

//Add to cart
$(document).on("click", ".add-to-cart", function (e) {
    e.preventDefault();
    var addProductUrl = "{{ route('add.to.cart') }}";
    var productId = $(this).data("rowid");
    var productName = $(this).data("name");
    var productPrice = $(this).data("price");
    var sugarId = $(this).closest(".card").find('select[name="sugar"]').val();
    var iceId = $(this).closest(".card").find('select[name="ice"]').val();
    $.ajax({
        url: "api/add-products",
        type: "POST",
        data: {
            _token: token,
            id: productId,
            name: productName,
            price: productPrice,
            sugar_id: sugarId,
            ice_id: iceId,
        },
        success: function (response) {
            if (response.success) {
                addProductToCartDisplay(
                    response.rowId,
                    productName,
                    productPrice,
                    response.iceOption,
                    response.sugarOption,
                    1
                );
                showToast(response.success);
                count = response.cartCount;
                //console.log(count);
            }
        },
        error: function (error) {
            showToast("Có lỗi xảy ra khi thêm sản phẩm");
        },
    });
});

function addProductToCartDisplay(
    rowId,
    name,
    price,
    iceOption,
    sugarOption,
    qty
) {
    var cartItem = $(`.cart[data-rowid="${rowId}"]`);
    var noProductMessage = $(".products-show-noti");
    var cartContainer = $(".products.px-3 .row");
    var cartNoProductContainer = $(".products.px-3");
    if (cartItem.length) {
        var currentQty = parseInt(cartItem.find(".product-qty").text());
        cartItem.find(".product-qty").text(currentQty + qty);
    } else {
        var formattedPrice = formatCurrencyVND(price);
        var productHtml = `<div class="cart d-flex mt-3" data-rowid="${rowId}">
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
                                <li>Đá: ${iceOption}</li>
                                <li>Đường: ${sugarOption}</li>
                            </div>
                        </div>`;
        cartContainer.append(productHtml);
        if (noProductMessage.length) {
            noProductMessage.remove();
            var NoproductHtml = `
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
                                <li>Đá: ${iceOption}</li>
                                <li>Đường: ${sugarOption}</li>
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
$(document).on("click", ".increase-quantity", function (e) {
    e.preventDefault();
    var rowId = $(this).data("rowid");
    updateQuantity(rowId, 1);
});

$(document).on("click", ".decrease-quantity", function (e) {
    e.preventDefault();
    var rowId = $(this).data("rowid");
    updateQuantity(rowId, -1);
});

function updateQuantity(rowId, change) {
    var currentQty = parseInt($("#qty_" + rowId).text());
    var newQty = currentQty + change;
    if (newQty <= 0) {
        // Xóa sản phẩm khỏi giỏ hàng
        $.ajax({
            url: "api/delete-product",
            type: "POST",
            data: {
                _token: token,
                rowId: rowId,
            },
            success: function (response) {
                if (response.success) {
                    $('button[data-rowid="' + rowId + '"]')
                        .closest(".cart")
                        .remove();
                    $("#panelsStayOpen-collapse-" + rowId).remove();
                    showToast(response.success);
                    count = response.cartCount;
                    //console.log(count);
                    updateTotalPrice();
                    updateSubTotalPrice();
                }
            },
            error: function (error) {
                console.log(error);
                showToast("Có lỗi xảy ra khi cập nhật sản phẩm");
            },
        });
    } else {
        // Cập nhật số lượng
        $.ajax({
            url: "api/update-quantity-product",
            type: "POST",
            data: {
                _token: token,
                rowId: rowId,
                change: change,
            },
            success: function (response) {
                if (response.success) {
                    $("#qty_" + rowId).text(response.quantity);
                    showToast(response.success);
                    count = response.cartCount;
                    //console.log(count);
                    updateTotalPrice(); // Cập nhật tổng giá tiền
                    updateSubTotalPrice();
                }
            },
            error: function (error) {
                showToast("Có lỗi xảy ra khi cập nhật sản phẩm");
                console.log(error);
            },
        });
    }
}

$(".thanhtoantotal").click(function () {
    if (count < 2) {
        showToast("Vui lòng mua ít nhất 2 sản phẩm!");
        return false;
    }
});
