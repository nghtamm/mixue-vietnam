<!DOCTYPE html>
<html>

<head>
    <script src="https://cdn.jsdelivr.net/npm/@goongmaps/goong-js@1.0.9/dist/goong-js.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@goongmaps/goong-js@1.0.9/dist/goong-js.css" rel="stylesheet" />
    <style>
        #map {
            position: absolute;
            top: 0;
            bottom: 0;
            width: 100%;
            margin-top: 100px;
        }

        .mapboxgl-ctrl-geocoder.mapboxgl-ctrl {
            box-shadow: none;
        }

        .mapboxgl-ctrl-geocoder.mapboxgl-ctrl {
            width: 100%
        }

        .mapboxgl-ctrl-bottom-left {
            display: none;
        }

        .mapboxgl-ctrl-bottom-right {
            display: none;
        }
    </style>
</head>

<body>
    @include('map.bodyPlugin')
    <div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Giao hàng tận nơi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="input-group">
                                <div id="geocoder" class="form-control"></div>
                                <button class="input-group-text map-button" style="background-color: #198754;"><i
                                        class="bi bi-map-fill" style="color:white"></i></button>
                            </div>
                        </div>
                        <select class="restaurant form-select mt-2">
                            <option value="" selected>Chọn cửa hàng</option>
                            @foreach ($restaurant as $cuahang)
                                <option class="cuahang" value="{{ $cuahang->restaurant_id }}">
                                    {{ $cuahang->restaurant_name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="row showmap" style="height:375px;">
                            <div class="col-12">
                                <div id="map"></div>
                                {{-- <pre id="result" style="margin-top:400px: display:none"></pre> --}}
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                    <button type="submit" class="dathang btn btn-success" style="width:100%">Bắt đầu đặt
                        hàng</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <script src="{{ asset('frontend\js\map\map.js') }}"></script>
    <script>
        // Sử dụng hàm css() để thay đổi nhiều thuộc tính cùng lúc
        $('.mapboxgl-canvas').css({
            'width': '95%',
            'height': '375px'
        });

        $(document).ready(function() {
            $('.showmap').show();
            $('.map-button').click(function() {
                $('.showmap').toggle();
            });
        });

        $('.dathang').click(function() {
            var selectedRestaurantId = $('.restaurant').val();
            if (selectedRestaurantId && selectedRestaurantId !== "") {
                getDistanceMatrix();
            } else {
                showToast('Vui lòng chọn một nhà hàng.');
            }
        });
    </script>
</body>

</html>
