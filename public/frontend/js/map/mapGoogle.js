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
                                    "user_address"
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

var searchInput = "user_address";

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

        // var address = place.formatted_address;
        // calculateShippingFee(address);
    });
});
