var token = $("#token").val();
var expiresAt;
var timerInterval;

document.addEventListener("DOMContentLoaded", function () {
    getOtpExpiryTimeAndSetTimer();
});

function getOtpExpiryTimeAndSetTimer() {
    $.ajax({
        url: "/otp-expiry-time",
        type: "GET",
        success: function (response) {
            setTimer(response.expiresAt);
            // console.log(response.expiresAt);
        },
        error: function (error) {
            // console.log("Error fetching OTP expiry time:", error);
            showToast('Error fetching OTP expiry time');
        },
    });
}

function setTimer(newExpiresAt) {
    clearInterval(timerInterval); // Xóa timer cũ trước khi thiết lập mới
    expiresAt = new Date(newExpiresAt); // Cập nhật thời gian hết hạn mới
    // console.log(newExpiresAt);
    var timerElement = document.getElementById("timer");
    timerElement.innerHTML = "Đang thiết lập...";

    function updateTimer() {
        var now = new Date().getTime();
        var distance = expiresAt - now;

        if (distance > 0) {
            var minutes = Math.floor(
                (distance % (1000 * 60 * 60)) / (1000 * 60)
            );
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            timerElement.innerHTML = `${minutes}:${
                seconds < 10 ? "0" : ""
            }${seconds}`;
        } else {
            timerElement.innerHTML =
                '<a href="javascript:void(0);" id="resendOtp" onclick="resendOtp()">Gửi lại OTP</a>';
            clearInterval(timerInterval);
        }
    }
    updateTimer(); // Cập nhật ngay lập tức
    timerInterval = setInterval(updateTimer, 1000); // Thiết lập lại timer với thời gian mới
}

function resendOtp() {
    $.ajax({
        url: "/resend-otp",
        type: "POST",
        data: {
            _token: token,
        },
        beforeSend: function () {
            $("#timer").html("Đang gửi...");
        },
        success: function (response) {
            $(".alert-danger").hide();
            $(".alert-success").hide();
            showToast(response.success);
            setTimer(response.newExpiresAt);
        },
        error: function (response) {
            $(".alert-success").hide();
            $(".alert-danger").hide();
            // showToast(response.error);
            showToast("Có lỗi xảy ra khi gửi lại OTP.");
            // $('.alert-danger').text('Có lỗi xảy ra khi gửi lại OTP.').show();
        },
    });
}

$("#otpForm").submit(function (e) {
    e.preventDefault();
    var otp = $("#otp").val();

    $.ajax({
        url: "/verify-mail",
        type: "POST",
        data: {
            otp: otp,
            _token: token,
        },
        success: function (response) {
            if (response.success) {
                window.location.href = response.redirectUrl;
                showToast(response.success);
            } else {
                showToast(response.error);
            }
        },
        error: function (response) {
            // console.log(error);
            showToast("Có lỗi xảy ra, vui lòng thử lại.");
        },
    });
});
