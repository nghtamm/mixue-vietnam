goongjs.accessToken = "ODPR9bgIasixTlQrBDwn1DrxvvChnqPtszXK56WU";
var map = new goongjs.Map({
    container: "map", // container id
    style: "https://tiles.goong.io/assets/goong_map_web.json", // stylesheet location
    center: [105.83991, 21.028], // starting position [lng, lat]
    zoom: 11, // starting zoom
});

map.resize();

var origin;
$(document).ready(function () {
    $(".restaurant").change(function () {
        var restaurantId = $(this).val();
        $.ajax({
            url: "/get-restaurant",
            type: "GET",
            data: {
                _token: "{{ csrf_token() }}",
                restaurant_id: restaurantId,
            },
            success: function (response) {
                if (response.geometry) {
                    origin = response.geometry.split(",");
                    showToast("Đã cập nhật tọa độ");
                } else {
                    showToast("Tọa độ nhà hàng không có sẵn");
                }
            },
            error: function (error) {
                showToast("Vui lòng chọn cửa hàng");
            },
        });
    });
});

//search
var geocoder = new GoongGeocoder({
    accessToken: "e4hwAYW0ya0pPOmQdkPcMyxUel1UvMGb0LhY3r5M",
    goongjs: goongjs, // Sử dụng GoongJS làm map library
    marker: false, // Không hiển thị marker
    placeholder: "Nhập địa chỉ khách hàng...", // Text placeholder cho trường tìm kiếm
});

// Thêm GoongGeocoder vào trang web
document.getElementById("geocoder").appendChild(geocoder.onAdd(map));

// Get the geocoder results container.
// var results = document.getElementById('result');
var customerLocation;

//Marker chưa xử lí xong
var draggableMarker = new goongjs.Marker({
    draggable: true,
})
    .setLngLat([105.83991, 21.028]) // Đặt vị trí ban đầu của marker
    .addTo(map);

// Xử lý sự kiện khi kết thúc việc kéo marker
draggableMarker.on("dragend", function () {
    var lngLat = draggableMarker.getLngLat();
    customerLocation = [lngLat.lat, lngLat.lng];
    showToast("Địa chỉ bạn đã kéo thả marker: " + customerLocation);
    // console.log('Vị trí marker:', customerLocation);
});

// Add geocoder result to container.
geocoder.on("result", function (e) {
    // console.log('Kết quả từ Geocoder:', e.result);
    if (e.result.result.geometry.location) {
        var lat = e.result.result.geometry.location.lat;
        var lng = e.result.result.geometry.location.lng;
        var address = e.result.result.formatted_address;
        customerLocation = [lat, lng];
        showToast("Địa chỉ bạn đã chọn: " + address); // Hiển thị tọa độ trong console để kiểm tra
        // Di chuyển marker đến vị trí mới
        draggableMarker.setLngLat([lng, lat]);
    } else {
        // console.error('Không thể lấy thông tin vị trí.');
        showToast("Không thể lấy thông tin vị trí.");
    }
});

// Clear results container when search is cleared.
// geocoder.on('clear', function() {
//     results.innerText = '';
// });
//save
function getDistanceMatrix() {
    if (!origin) {
        showToast("Tọa độ nhà hàng chưa được cập nhật");
        return;
    }
    var destination = customerLocation; // Vị trí khách hàng

    var url =
        "https://rsapi.goong.io/DistanceMatrix?origins=" +
        origin.join() +
        "&destinations=" +
        destination.join() +
        "&vehicle=car&api_key=e4hwAYW0ya0pPOmQdkPcMyxUel1UvMGb0LhY3r5M";
    console.log(origin);
    $.get(url, function (data) {
        // var duration = data.rows[0].elements[0].duration.text;
        var distance = data.rows[0].elements[0].distance.text;
        // showToast('Duration: ' + duration + ', Distance: ' + distance);
        showToast("Khoảng cách cửa hàng - địa điểm bạn: " + distance);
    });
}

function saveCustomerLocation() {
    $.ajax({
        url: "/save-customer-location",
        type: "POST",
        data: {
            customerLocation: customerLocation,
            _token: "{{ csrf_token() }}",
        },
        success: function (response) {
            showToast("Vị trí khách hàng đã được lưu.");
        },
        error: function (error) {
            showToast("Lỗi khi lưu vị trí khách hàng.");
        },
    });
}
