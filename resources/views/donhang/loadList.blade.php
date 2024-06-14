<div class="row">
    <div class="col-12 px-3">
        <div class="container-fluid mt-3">
            <div class="table-responsive">
                <table class="table table-striped table-hover caption-top">
                    <caption>Đơn hàng của bạn</caption>
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Ngày tạo đơn</th>
                            <th scope="col">Tổng tiền</th>
                            <th scope="col">SL sản phẩm</th>
                            <th scope="col">Cửa hàng</th>
                            <th scope="col">Người giao hàng</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Thao tác</th>
                        </tr>
                    </thead>
                    @foreach ($data as $donhang)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td class="created_at">
                                {{ Carbon\Carbon::parse($donhang->created_at)->format('d-m-Y H:i:s') }}
                            </td>
                            <td class="total_price">@currency($donhang->total_price)</td>
                            <td class="quantity">{{ $donhang->quantity }}</td>
                            <td class="restaurant">{{ $donhang->restaurant->restaurant_name }}</td>
                            <td class="nguoigiaohang">
                                {{ $donhang->staff ? $donhang->staff->name : '' }}
                            </td>
                            <td class="status">{{ $donhang->bill_status }}</td>
                            <td style="text-align: center"><a onclick="jsOrder.inforRecord('{{ $donhang->id }}')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                        <path
                                            d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                    </svg></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
