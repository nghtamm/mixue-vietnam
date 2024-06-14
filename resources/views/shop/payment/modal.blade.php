<!-- Modal sửa thông tin -->
<form id="editBankForm">
    <input type="hidden" name="banking_id" value="{{ $bankData->banking_id }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="suathongtinModalLabel">Sửa thông tin tài khoản</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid mb-3">

                    <div class="mb-3">
                        <label class="form-label">Tên ngân hàng</label>
                        <select class="form-control" name="bank_name" id="bank_name">
                            @foreach ($banks['data'] as $bank)
                                <option value="{{ $bank['short_name'] }}|{{ $bank['code'] }}|{{ $bank['bin'] }}"
                                    {{ $bankData->banking_name == $bank['short_name'] ? 'selected' : '' }}>
                                    {{ $bank['short_name'] }} - {{ $bank['name'] }}
                                </option>
                            @endforeach
                        </select>


                    </div>

                    <div class="mb-3">
                        <label for="account_number" class="form-label">Số tài khoản</label>
                        <input type="text" class="form-control" name="account_number" id="account_number"
                            placeholder="0031000354504" value="{{ $bankData->account_number }}">
                    </div>

                    <div class="mb-3">
                        <label for="full_name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" name="full_name" id="full_name"
                            placeholder="Nguyen Hoai Nam" value="{{ $bankData->name }}">
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <input type="submit" class="btn btn-success" value="Lưu thay đổi">
            </div>
        </div>
    </div>
</form>
