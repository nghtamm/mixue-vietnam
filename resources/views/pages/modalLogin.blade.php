<!-- Modal đăng nhập -->
<form id="dangnhapForm">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="xoathongtinModalLabel">Đăng nhập tài khoản</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Bạn có chắc chắn muốn xóa tài khoản này không?</p>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <input type="submit" class="btn btn-success" value="Đăng nhập">
            </div>
        </div>
    </div>
</form>
