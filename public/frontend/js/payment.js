var token = $("#token").val();

function formatCurrencyVND(total) {
    return new Intl.NumberFormat("vi-VN", {
        style: "currency",
        currency: "VND",
    }).format(total);
}

function calculateShippingFee(restaurantId) {
    // console.log(restaurantId);
    // var restaurantId = @json(session('restaurant_id'));
    var isGift = $("#order_nguoithan").is(":checked");
    var formData = {
        _token: token,
        restaurantId: restaurantId,
        isGift: isGift,
    };
    // console.log('Tính tiền từ cửa hàng: ' + restaurantId);

    if (isGift) {
        formData.recipient_address = $("#order_nthan_address").val();
    } else {
        formData.user_address = $("#order_address").val();
    }
    $.ajax({
        url: "shop/api/get-restaurant",
        method: "POST",
        data: formData,
        success: function (response) {
            if (response.shipping_fee !== null) {
                shippingFee = response.shipping_fee;
                var formattedShippingFee = formatCurrencyVND(shippingFee);
                $("#shippingFee").html(formattedShippingFee);
                updateSubTotal(shippingFee);
                // console.log(shippingFee);
            } else {
                $("#shippingFee").text("Không thể tính phí giao hàng");
            }
        },
        error: function (xhr, status, error) {
            console.error("Error: " + error);
            $("#shippingFee").text("Lỗi khi tính phí giao hàng");
        },
    });
}

$(document).ready(function () {
    $.ajax({
        url: "shop/api/get-restaurant-id",
        type: "GET",
        success: function (response) {
            var restaurantId = response.restaurantId;
            // Bạn có thể sử dụng restaurantId ở đây
            // console.log(restaurantId);
            if (restaurantId) {
                calculateShippingFee(restaurantId);
                document
                    .getElementById("backToMenuLink")
                    .setAttribute("href", "/shop/" + restaurantId);
            }
        },
        error: function (error) {
            console.log("Error:", error);
        },
    });
});

function updateSubTotal(shippingFee) {
    var total = Number($("#cartSummary").data("total"));
    var khuyenmai = Number($("#cartSummary").data("khuyenmai"));
    var thanhvien = Number($("#cartSummary").data("thanhvien"));

    var subTotal = total + khuyenmai + thanhvien + parseFloat(shippingFee);
    var formattedSubTotal = formatCurrencyVND(subTotal);
    // console.log(formattedSubTotal);

    $("#subTotal").html(formattedSubTotal);
}

var searchInput = "order_nthan_address";

$(document).ready(function () {
    var autocomplete;
    autocomplete = new google.maps.places.Autocomplete(
        document.getElementById(searchInput),
        {
            componentRestrictions: {
                country: "VN",
            },
        }
    );

    google.maps.event.addListener(autocomplete, "place_changed", function () {
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            console.error(
                "No details available for the input: '" + place.name + "'"
            );
            return;
        }

        var address = place.formatted_address;
        calculateShippingFee(address);
    });

    $(
        "#order_nthan_name, #order_email, #order_nthan_sdt, #order_name, #order_sdt"
    ).on("change", function () {
        var name = $("#order_nthan_name").val();
        var email = $("#order_email").val();
        var phone = $("#order_nthan_sdt").val();

        $.ajax({
            url: "/thanhtoan/validate-input",
            type: "POST",
            data: {
                name: name,
                email: email,
                phone: phone,
                _token: token,
            },
            success: function (response) {
                $("#order_nthan_name").removeClass("is-invalid");
                $("#order_nthan_sdt").removeClass("is-invalid");
                // showAlert().hide();
                $("#alert").html("");
                // console.log('test');
            },
            error: function (error) {
                // showToast(response.responseJSON.errors.phone);
                showAlert(error.responseJSON.message);
                $("#order_nthan_name").addClass("is-invalid");
                $("#order_nthan_sdt").addClass("is-invalid");
                // Xử lý lỗi và hiển thị thông báo
                // console.log(response.responseJSON.errors);
                console.log(error);
            },
        });
    });
});

document.getElementById("locate-me").addEventListener("click", function () {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function (position) {
                var latlng =
                    position.coords.latitude + "," + position.coords.longitude;

                // Sử dụng Geocoding API để chuyển đổi latlng thành địa chỉ
                fetch(
                    "https://maps.googleapis.com/maps/api/geocode/json?latlng=" +
                        latlng +
                        "&key=AIzaSyDvt90oCXt10RAfYuWtY8M4RBHzTkndfGg"
                )
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.status === "OK") {
                            if (data.results[0]) {
                                var address = (document.getElementById(
                                    "order_nthan_address"
                                ).value = data.results[0].formatted_address);
                                calculateShippingFee(address);
                                console.log(address);
                            } else {
                                console.error("No results found");
                            }
                        } else {
                            console.error(
                                "Geocoder failed due to: " + data.status
                            );
                        }
                    })
                    .catch((error) => console.error("Error:", error));
            },
            function (error) {
                console.error("Error occurred: " + error.message);
            },
            {
                enableHighAccuracy: true,
                timeout: 5000,
                maximumAge: 0,
            }
        );
    } else {
        console.error("Geolocation is not supported by this browser.");
    }
});

function processCheckout() {
    $("#loadingOverlay").show();
    // data.message = $('#messageshop').val();
    var message_shop = $('input[name="messageshop"]').val();
    var restaurantId = localStorage.getItem("restaurant_id");
    var delivery_time = $("#delivery-time-option").val();
    var specific_time = $("#specific-time-option").val();
    var order_payment = $('input[name="order_payment"]:checked').val();
    // console.log(restaurantId, specific_time, delivery_time);
    // console.log('Order payment: ', order_payment);
    var isGift = $("#order_nguoithan").is(":checked");
    // console.log(isGift);
    var formData = {
        _token: token,
        restaurant_id: restaurantId,
        delivery_time: delivery_time,
        specific_time: specific_time,
        order_payment: order_payment,
        message_shop: message_shop,
        isGift: isGift,
    };

    if (isGift) {
        formData.recipient_name = $("#order_nthan_name").val();
        formData.recipient_phone = $("#order_nthan_sdt").val();
        formData.recipient_address = $("#order_nthan_address").val();
    } else {
        formData.user_name = $("#order_username").val();
        formData.user_phone = $("#order_sdt").val();
        formData.user_address = $("#order_address").val();
    }
    // console.log('Bản thân: ', formData.user_name, formData.user_address, formData.user_phone);
    // console.log('Người thân: ', formData.recipient_name, formData.recipient_phone, formData.recipient_address);
    if (!restaurantId) {
        showToast("Restaurant ID không tồn tại.");
        return false;
    } else {
        $.ajax({
            url: "shop/api/process-checkout",
            type: "POST",
            data: formData,
            success: function (response) {
                window.location.href = response.redirectURL;
                // console.log(response.redirectURL);
            },
            error: function (error) {
                showAlert(
                    error.responseJSON.message ||
                        "Đã xảy ra lỗi khi xử lý đơn hàng."
                );
                console.error("Error:", error);
                $("#loadingOverlay").hide();
            },
        });
    }
}

document.addEventListener("DOMContentLoaded", function () {
    var deliveryTimeSelect = document.getElementById("delivery-time-option");
    var specificTimeSelect = document.getElementById("specific-time-option");

    function clearTimeOptions() {
        specificTimeSelect.innerHTML = ""; // Xóa các lựa chọn
    }

    function roundUpTime(date) {
        var minutes = date.getMinutes();
        var roundedMinutes = Math.ceil(minutes / 15) * 15;
        date.setMinutes(roundedMinutes);
        return date;
    }

    function parseTime(timeString) {
        var parts = timeString.split(":");
        return {
            hour: parseInt(parts[0], 10),
            minute: parseInt(parts[1], 10),
        };
    }

    function populateTimeOptions(restaurantId) {
        $.ajax({
            url: "thanhtoan/checkRestaurantTime",
            method: "POST",
            data: {
                _token: token,
                restaurant_id: restaurantId,
            },
            success: function (response) {
                var openTimeParts = parseTime(response.openTime);
                var closeTimeParts = parseTime(response.closeTime);
                var closeTime = new Date();
                closeTime.setHours(
                    closeTimeParts.hour,
                    closeTimeParts.minute + 30,
                    0
                );

                var currentTime = new Date();
                currentTime = roundUpTime(currentTime); // Làm tròn thời gian hiện tại
                currentTime.setMinutes(currentTime.getMinutes() + 30); // Cộng thêm 30 phút
                specificTimeSelect.innerHTML = ""; // Xóa các lựa chọn hiện có
                // console.log('Thời gian mở cửa và đóng cửa:', openTimeParts, closeTimeParts);
                for (var i = 0; i < 10; i++) {
                    // Tạo các lựa chọn thời gian
                    var timeOption = new Date(
                        currentTime.getTime() + i * 15 * 60000
                    );
                    if (
                        timeOption.getHours() > closeTimeParts.hour ||
                        (timeOption.getHours() === closeTimeParts.hour &&
                            timeOption.getMinutes() > closeTimeParts.minute) ||
                        timeOption.getHours() < openTimeParts.hour ||
                        (timeOption.getHours() === openTimeParts.hour &&
                            timeOption.getMinutes() < openTimeParts.minute)
                    ) {
                        continue;
                    }

                    if (timeOption > closeTime) {
                        break;
                    }
                    var timeValue = timeOption.toLocaleTimeString("it-IT", {
                        hour: "2-digit",
                        minute: "2-digit",
                        hour12: false,
                    });
                    $("#specific-time-option").append(
                        $("<option>", {
                            value: timeValue,
                            text: timeValue,
                        })
                    );
                }
            },
            error: function (xhr, status, error) {
                console.error("Error: " + error);
            },
        });
    }

    deliveryTimeSelect.addEventListener("change", function () {
        if (this.value === "2") {
            var restaurantId = localStorage.getItem("restaurant_id");
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
