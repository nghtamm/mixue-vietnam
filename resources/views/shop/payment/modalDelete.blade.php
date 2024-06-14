<!-- Modal sửa thông tin -->
<form id="deleteBankForm">
    <input type="hidden" name="banking_id" value="{{ $bankData->banking_id }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="xoathongtinModalLabel">Xóa tài khoản</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Bạn có chắc chắn muốn xóa tài khoản này không?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <input type="submit" class="btn btn-success" value="Xóa">
            </div>
        </div>
    </div>
</form>
