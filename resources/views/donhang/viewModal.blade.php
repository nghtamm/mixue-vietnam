<form id="frmViewRegister" role="form" action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="_token" id='_token' value="{{ csrf_token() }}">
    {{-- <input type="hidden" name="idRegister" id="idRegister" value="{{ $id }}"> --}}
    <div class="modal-dialog modal-dialog-centered modal-xl" style="font-size: 15px">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Thông tin đơn hàng</h4>
                {{-- <button type="button" class="close" data-dismiss="modal">&times;</button> --}}
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="tab-content">
                    <div>
                        <div class="row">
                            <div class="col-md">
                                <div class="mb-3">
                                    <label for="user_name" class="form-label">Tên khách hàng</label>
                                    <input type="text" class="form-control" id="user_name"
                                        style="background-color:#e1e1e1" value="{{ $data->user->user_name }}" readonly>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="mb-3">
                                    <label for="total_price" class="form-label">Tổng tiền</label>
                                    <input type="text" class="form-control" id="total_price"
                                        style="background-color:#e1e1e1" value="@currency($data->total_price)" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md">
                                <div class="mb-3">
                                    <label for="shipping" class="form-label">Phí giao hàng</label>
                                    <input type="text" class="form-control" id="shipping"
                                        style="background-color:#e1e1e1" value="@currency($data->shipping->shipping_fee ?? 0)" readonly>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="mb-3">
                                    <label for="restaurant" class="form-label">Cửa hàng</label>
                                    <input type="text" class="form-control" id="restaurant"
                                        style="background-color:#e1e1e1"
                                        value="{{ $data->restaurant->restaurant_name }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md">
                                <div class="mb-3">
                                    <label for="note" class="form-label">Ghi chú đơn hàng</label>
                                    <input type="text" class="form-control" id="note"
                                        style="background-color:#e1e1e1" value="{{ $data->user_note }}" readonly>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="mb-3">
                                    <label for="time" class="form-label">Thời gian giao hàng</label>
                                    <input type="text" class="form-control" id="time"
                                        style="background-color:#e1e1e1"
                                        value="{{ $data->scheduled_delivery_time ? $data->scheduled_delivery_time : 'Càng sớm càng tốt' }}"
                                        readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md">
                                <div class="mb-3">
                                    <label for="info" class="form-label">Người nhận đơn hàng</label>
                                    <input type="text" class="form-control" id="info"
                                        style="background-color:#e1e1e1" value="{{ $data->order_name }}" readonly>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Số điện thoại</label>
                                    <input type="text" class="form-control" id="phone"
                                        style="background-color:#e1e1e1" value="{{ $data->order_phone }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md">
                                <div class="mb-3">
                                    <label for="note" class="form-label">Địa chỉ</label>
                                    <input type="text" class="form-control" id="note"
                                        style="background-color:#e1e1e1" value="{{ $data->order_address }}" readonly>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="mb-3">
                                    <label for="staff" class="form-label">Người giao hàng</label>
                                    <input type="text" class="form-control" id="staff"
                                        style="background-color:#e1e1e1"
                                        value="{{ $data->staff ? $data->staff->name : '' }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md">
                                <div class="mb-3">
                                    <label for="note" class="form-label">Thời gian tạo đơn</label>
                                    <input type="text" class="form-control" id="note"
                                        style="background-color:#e1e1e1"
                                        value="{{ Carbon\Carbon::parse($data->created_at)->format('d-m-Y H:i:s') }}"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Trạng thái</label>
                                    <input type="text" class="form-control" id="status"
                                        style="background-color:#e1e1e1" value="{{ $data->bill_status }}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</form>
