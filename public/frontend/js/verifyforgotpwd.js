var token = $("#token").val();
var expiresAt;
var timerInterval;

function getOtpExpiryTimeAndSetTimer() {
    $.ajax({
        url: "/forgotpwd-otp-expiry-time",
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

    fetch("/forgotpwd-verify-otp", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
        body: JSON.stringify({
            otp: otp,
        }),
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = data.redirectUrl;
                showToast(data.success);
            } else {
                showToast(data.error);
            }
        })
        .catch((error) => {
            console.log(error);
            showToast("Có lỗi xảy ra, vui lòng thử lại.");
        });
});
