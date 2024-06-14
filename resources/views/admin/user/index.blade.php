<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quản lý User</title>
    @include('shop.head')
</head>

<body style="background: #f4f4f4;">
    @include('sidebar.index')
    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu'></i>
            <span class="text">Quản lý Người Dùng</span>
        </div>
        <div class="quanlybank">
            <div class="container">
                <div class="adduser mb-2 d-flex" style="justify-content: flex-end;">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#addUserModal">Thêm người dùng</button>
                </div>
                <div class="row">
                    <div class="col-12 px-3" style="background-color: #ECECEC">
                        <div class="container-fluid mt-3">
                            <table class="table table-striped table-hover caption-top" style="--bs-table-bg:#ECECEC ">
                                <caption>TÀI KHOẢN NGƯỜI DÙNG</caption>
                                <thead>
                                    <tr>
                                        <th scope="col"><input class="form-check-input" type="checkbox"
                                                value="" id="flexCheckDefault">
                                        </th>
                                        <th scope="col">#</th>
                                        <th scope="col">Tên người dùng</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Số điện thoại</th>
                                        <th scope="col">Thao tác</th>
                                        <th scope="col">Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody id="data-table">
                                    @php $i = 1; @endphp
                                    @foreach ($users as $user)
                                        <tr>
                                            <th scope="col"><input class="form-check-input" type="checkbox"
                                                    value="" name="1">
                                            </th>
                                            <th scope="row">{{ $i++ }}</th>
                                            <td class="user-name">{{ $user->user_name }}</td>
                                            <td class="user-email">{{ $user->user_email }}</td>
                                            <td class="user-phone">{{ $user->user_phone }}</td>
                                            <td>
                                                <a type="button" onclick="Js_Payment.edit('{{ $user->user_id }}')">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                |
                                                <a type="button"
                                                    onclick="Js_Payment.confirmDelete('{{ $user->user_id }}')">
                                                    <i class="bi bi-trash-fill"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input default-checkbox" type="checkbox"
                                                        role="switch" data-user-id="{{ $user->user_id }}"
                                                        name="flexSwitchChecked"
                                                        id="flexSwitchCheckChecked{{ $user->user_id }}"
                                                        {{ $user->user_status == 1 ? 'checked' : '' }}>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <nav class="d-flex" style="justify-content: space-between;">
                                <div><button type="button" class="btn btn-secondary">Xóa tất cả</button></div>
                                {{ $users->links() }}
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('notifications.notiAdmin')
    @include('admin.user.AddUserModal');
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('frontend\js\sidebar.js') }}"></script>
    <script src="{{ asset('frontend\js\sendAjaxRequest.js') }}"></script>
    <script src="{{ asset('frontend\js\notification.js') }}"></script>
    <script>
        //chuyển trạng thái mặc định bank
        $(document).ready(function() {
            $(".default-checkbox").on("change", function() {
                var userId = $(this).data("user-id");
                var checkboxId = "flexSwitchCheckChecked" + userId;
                var data = {
                    _token: "{{ csrf_token() }}",
                    user_status: this.checked,
                };

                // Gửi yêu cầu AJAX
                sendAjaxRequest(
                    "/system/admin/user/updateStatus/" + userId,
                    "POST",
                    data,
                    function(response) {
                        if (data.user_status) {
                            // Nếu user_status là 1, đánh dấu checkbox là đã chọn
                            $("#" + checkboxId).prop("checked", true);
                        } else {
                            // Nếu user_status là 0, bỏ chọn checkbox
                            $("#" + checkboxId).removeAttr("checked").prop("checked", false);
                        }
                        console.log(data.user_status);
                        showToast(response.success);
                    },
                    function(error) {
                        // onError
                        // console.log(error);
                        showToast("Error:", error);
                    }
                );
            });
        });

        //add user
        $(document).ready(function() {
            $('#submitAddUser').click(function() {
                var data = $("#addUserForm").serialize(); // Lấy dữ liệu từ form
                // console.log(data);

                $.ajax({
                    url: '/system/admin/user/addUser', // Endpoint xử lý POST request
                    type: 'POST',
                    data: data,
                    success: function(response) {
                        $('#addUserModal').modal('hide');
                        $("#data-table").append(response);
                        showToast(response.success);

                    },
                    error: function(xhr) {
                        // console.log(error);
                        $('#addUserModal').modal('hide');
                        if (xhr.status === 409) {
                            var errorResponse = xhr.responseJSON;
                            showToast(errorResponse.error);
                        }
                        // else {
                        //     var errorMessage = xhr.status + " " + xhr.statusText;
                        //     console.log('Error: ' + errorMessage);
                        // }
                    }
                });
            });
        });
    </script>
</body>

</html>
