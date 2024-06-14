@extends('home')

@section('content')
    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu'></i>
            <span class="text">Quản lý Bank</span>
        </div>
        <div class="quanlybank">
            <div class="container">
                <div class="row mb-3">
                    <div class="col-8 px-2" style="background-color: #ECECEC">
                        <div class="container-fluid mt-3 mb-3 caption-top">
                            <div class="mb-4">
                                <caption>THÊM TÀI KHOẢN NGÂN HÀNG</caption>
                            </div>
                            <form action="/system/shop/bank/addBank" method="POST">
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
                                    <label for="exampleFormControlInput1" class="form-label">Số tài khoản</label>
                                    <input type="text" class="form-control" name="account_number"
                                        id="exampleFormControlInput1" placeholder="0031000354504">
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" name="full_name"
                                        id="exampleFormControlInput1" placeholder="Nguyen Hoai Nam">
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
                                        <th scope="col">Tên chủ thẻ</th>
                                        <th scope="col">Số ngân hàng</th>
                                        <th scope="col">Thao tác</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Mặc định</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $amount = 0; ?>
                                    @foreach ($bankAccounts as $account)
                                        <tr>
                                            <th scope="row">{{ $amount += 1 }}</th>
                                            <td>{{ $account->banking_name }}</td>
                                            <td>{{ $account->account_number }}</td>
                                            <td>{{ $account->name }}</td>
                                            <td>
                                                <a href="" type="button"
                                                    onclick="Js_Payment.edit('{{ $account->banking_id }}')"><i
                                                        class="bi bi-pencil-square"></i></a>
                                                |
                                                <a href="" type="button"><i class="bi bi-trash-fill"></i></a>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" role="switch"
                                                        id="flexSwitchCheckChecked"
                                                        {{ $account->status == 1 ? 'checked' : '' }}>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input default-checkbox" type="checkbox"
                                                        role="switch" data-account-id="{{ $account->banking_id }}"
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
        @include('shop.payment.modal')
    </section>
    @end
