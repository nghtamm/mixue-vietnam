<!-- Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addUserModalLabel">THÊM TÀI KHOẢN NGƯỜI DÙNG</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {{-- <form action="{{ route('addUser') }}" method="POST"> --}}
            <form id="addUserForm" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="container-fluid mb-3">
                        <div class="mb-3">
                            <label for="user_name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" name="user_name" id="user_name"
                                placeholder="NGUYEN HOAI NAM">
                        </div>

                        <div class="mb-3">
                            <label for="user_email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="user_email" id="user_email"
                                placeholder="mixuevn@gmail.com">
                        </div>

                        <div class="mb-3">
                            <label for="user_password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="user_password" id="user_password"
                                placeholder="Nhập mật khẩu người dùng">
                        </div>

                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault"
                                name="user_status" checked>
                            <label class="form-check-label" for="flexSwitchCheckDefault">Trạng thái</label>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="submitAddUser" class="btn btn-success">Thêm tài khoản</button>
                </div>
            </form>
        </div>
    </div>
</div>
