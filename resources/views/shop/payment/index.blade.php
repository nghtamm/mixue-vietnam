<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quản lý Bank</title>
    @include('shop.head')
</head>


<body>
    @include('sidebar.index')
    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu'></i>
            <span class="text">Quản lý Bank</span>
        </div>
        <div class="quanlybank">
            <div class="container">
                <div class="row mb-3">
                    <div class="col-8 px-2" style="background-color: #ECECEC">
                        <input type="hidden" class="form-control" id="user_id" name="user_id"
                            value="{{ $currentUser->user_id ?? '' }}">
                        <input type="hidden" class="form-control" id="restaurant_id" name="restaurant_id"
                            value="{{ $restaurant->restaurant_id }}">

                        <div class="container-fluid mt-3 mb-3 caption-top">
                            <div class="mb-4">
                                <caption>THÊM TÀI KHOẢN NGÂN HÀNG</caption>
                            </div>
                            <form action="/system/shop/{{ $restaurant->restaurant_id }}/bank/addBank" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Tên ngân hàng</label>
                                    <select class="form-control" name="bank_name" id="bank_name">
                                        @foreach ($banks['data'] as $bank)
                                            <option
                                                value="{{ $bank['short_name'] }}|{{ $bank['code'] }}|{{ $bank['bin'] }}">
                                                {{ $bank['short_name'] }} - {{ $bank['name'] }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>

                                <div class="mb-3">
                                    <label for="account_number" class="form-label">Số tài khoản</label>
                                    <input type="text" class="form-control" name="account_number" id="account_number"
                                        placeholder="0031000354504">
                                </div>

                                <div class="mb-3">
                                    <label for="full_name" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" name="full_name" id="full_name"
                                        placeholder="Nguyen Hoai Nam">
                                </div>
                                <button type="submit" class="btn btn-success">Thêm số tài khoản</button>
                            </form>
                        </div>

                    </div>
                    <div class="col-4">
                        @foreach ($bankAccounts as $account)
                            @if ($account->banking_setDefault == true)
                                <img src="https://img.vietqr.io/image/{{ $account->banking_bin }}-{{ $account->account_number }}-compact2.jpg?amount=100000&accountName={{ $account->name }}"
                                    class="card-img" style="width:auto; height:410px">
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 px-3" style="background-color: #ECECEC">
                        <div class="container-fluid mt-3">
                            <table class="table table-striped table-hover caption-top" style="--bs-table-bg:#ECECEC ">
                                <caption>TÀI KHOẢN NGÂN HÀNG</caption>
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tên ngân hàng</th>
                                        <th scope="col">Số ngân hàng</th>
                                        <th scope="col">Tên chủ thẻ</th>
                                        <th scope="col">Thao tác</th>
                                        {{-- <th scope="col">Trạng thái</th> --}}
                                        <th scope="col">Mặc định</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bankAccounts as $account)
                                        <tr id="bankAccount-{{ $account->banking_id }}">
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td class="banking-name">{{ $account->banking_name }}</td>
                                            <td class="account-number">{{ $account->account_number }}</td>
                                            <td class="full-name">{{ $account->name }}</td>
                                            <td>
                                                <a type="button"
                                                    onclick="Js_Payment.edit('{{ $account->banking_id }}')">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                |
                                                <a type="button"
                                                    onclick="Js_Payment.confirmDelete('{{ $account->banking_id }}')">
                                                    <i class="bi bi-trash-fill"></i>
                                                </a>
                                            </td>
                                            {{-- <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" role="switch"
                                                        id="flexSwitchCheckChecked"
                                                        {{ $account->status == 1 ? 'checked' : '' }}>
                                                </div>
                                            </td> --}}
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input default-checkbox" type="checkbox"
                                                        role="switch" data-account-id="{{ $account->banking_id }}"
                                                        name="flexSwitchCheck"
                                                        id="flexSwitchCheck{{ $account->banking_id }}"
                                                        {{ $account->banking_setDefault == 1 ? 'checked' : '' }}>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('notifications.notiAdmin')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        //chuyển trạng thái mặc định bank
        $(document).ready(function() {
            $('.default-checkbox').on('change', function() {
                var accountId = $(this).data('account-id');
                var restaurantId = '{{ $restaurant->restaurant_id }}';
                var checkboxId = 'flexSwitchCheck' + accountId;
                var data = {
                    _token: '{{ csrf_token() }}',
                    banking_setDefault: this.checked
                };

                // Gửi yêu cầu AJAX
                sendAjaxRequest('/system/shop/' + restaurantId + '/bank/updateDefault/' + accountId, 'POST',
                    data,
                    function(response) {
                        // Bỏ chọn tất cả các checkbox khác
                        $('.default-checkbox').not('#' + checkboxId).prop('checked', false).removeAttr(
                            'checked');

                        // Đặt thuộc tính 'checked' cho checkbox được chọn
                        $('#' + checkboxId).prop('checked', true).attr('checked', 'checked');

                        showToast(response.success);
                    },
                    function(error) { // onError
                        showToast('Error:', error);
                    }
                );
            });
        });

        //Get modal bank
        var Js_Payment = {
            edit: function(accountId, restaurantId) {
                var url = '/system/shop/' + restaurantId + '/bank/getBankData/' + accountId;
                var modal = $('#suathongtin');
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        modal.html(response.htmlContent);
                        modal.modal('show');
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            },

            confirmDelete: function(accountId, restaurantId) {
                $.ajax({
                    url: '/system/shop/' + restaurantId + '/getDeleteModal/' + accountId,
                    type: 'GET',
                    success: function(response) {
                        var modal = $('#xoathongtin');
                        modal.html(response.htmlContent);
                        modal.modal('show');
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            }
        };

        //update bank
        $(document).ready(function() {
            $(document).on('submit', '#editBankForm', function(e) {
                e.preventDefault();

                var formData = $(this).serializeArray(); // Lấy dữ liệu từ form
                var data = {};
                $.each(formData, function() {
                    data[this.name] = this.value;
                });
                var restaurantId = '{{ $restaurant->restaurant_id }}';
                var jsonData = JSON.stringify(data); // Chuyển đổi dữ liệu sang JSON
                // console.log('JSON data:', jsonData);

                $.ajax({
                    url: '/system/shop/' + restaurantId + '/bank/editBank', // URL xử lý form
                    type: 'POST',
                    data: jsonData,
                    contentType: 'application/json',
                    success: function(response) {
                        var row = $('#bankAccount-' + response.banking_id);
                        row.find('.banking-name').text(response.banking_name);
                        row.find('.account-number').text(response.account_number);
                        row.find('.full-name').text(response.full_name);
                        $('#suathongtin').modal('hide');
                        showToast(response.success); // Hiển thị thông báo thành công
                    },
                    error: function(error) {
                        // Xử lý lỗi
                        console.error('Error:', error);
                        // Hiển thị thông báo lỗi
                    }
                });
            });
        });

        //Xóa tài khoản
        $(document).ready(function() {
            $(document).on('submit', '#deleteBankForm', function(e) {
                e.preventDefault();
                var accountId = $(this).find('input[name="banking_id"]').val();
                var restaurantId = '{{ $restaurant->restaurant_id }}';
                // console.log(accountId);
                $.ajax({
                    url: '/system/shop/' + restaurantId + '/bank/deleteBank/' + accountId,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#bankAccount-' + accountId).remove();
                        $('#xoathongtin').modal('hide');
                        showToast(response.success);
                    },
                    error: function(error) {
                        console.error('Error:', error);
                        showToast('Lỗi khi xóa tài khoản.');
                        $('#xoathongtin').modal('hide');
                    }
                });
            });
        });
    </script>
    <div class="modal fade" data-backdrop="static" id="suathongtin" role="dialog"></div>
    <div class="modal fade" data-backdrop="static" id="xoathongtin" role="dialog"></div>

    <script src="{{ asset('frontend\js\sidebar.js') }}"></script>
    <script src="{{ asset('frontend\js\sendAjaxRequest.js') }}"></script>
    <script src="{{ asset('frontend\js\notification.js') }}"></script>

</body>

</html>
