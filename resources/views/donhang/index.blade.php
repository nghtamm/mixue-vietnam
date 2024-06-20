<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lịch sử đơn hàng</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('frontend\images\mixue-favicon.png') }}"/>

    @include('pages.head')
    <link rel="stylesheet" href="{{ asset('frontend/css/payment.css') }}">
</head>

<body>
    @include('payment.head')
    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
    <form action="" method="POST" id="frmRegister_index" class="py-3 pl-4 pr-2">
        <div class="container-fluid mt-2">
            <section class="content-wrapper">
                <ol class="breadcrumb">
                    <li class="active">Danh sách đơn hàng của bạn</li>
                </ol>
                <div class="panel panel-default" style="box-shadow: none;">
                    <div class="panel-body">
                        <div class="form-group row">
                            {{-- <div class="col-md-3">
                                <select class="chzn-select form-control form-control-chosen-required" name="R_STATUS"
                                    id="R_STATUS">
                                    <option value=''>---Xác thực với CSDLDC---</option>
                                    <option value="XAC_THUC">Đã xác thực</option>
                                    <option value="CHUA_XAC_THUC">Chưa xác thực</option>
                                </select>
                            </div> --}}
                            <div class="col-md-12" style="display: none">
                                <div class="input-group px-3">
                                    <input id="txt_search" class="form-control input-sm pr-2" value="" type="text"
                                        placeholder="Tìm kiếm đơn hàng">
                                    <span class="input-group-btn pl-2">
                                        <button type="button" id="find-search" class="input-group-text map-button"
                                            style="background-color: #198754; padding: 10px 16px !important;"
                                            data-loading-text="Tìm kiếm..."><i class="bi bi-search" style="color:white"
                                                aria-hidden="true"></i></button></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Màn hình danh sách -->
                    <div id="table-container" style="padding-top:10px"></div>
                    <div class="row px-4" id="pagination"></div>
                </div>
            </section>
        </div>
    </form>
    @include('notifications.index')
    <script src="{{ asset('frontend\js\notification.js') }}"></script>
    <script type="text/javascript">
        var baseUrl = '{{ url('') }}';
    </script>
    <script src="{{ asset('frontend\js\Js_Order.js') }}"></script>
    <!-- Hien thi modal -->
    <div class="modal fade" id="viewModal" role="dialog">
    </div>
</body>

</html>
