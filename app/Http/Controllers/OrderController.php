<?php

namespace App\Http\Controllers;

use App\Models\NhanVien;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{
    public function index()
    {
        return view('donhang.index');
    }

    public function loadList(Request $request)
    {
        // Nhận tham số từ yêu cầu
        $user = Auth::id();
        $currentPage = $request->input('currentPage', 1);
        $perPage = $request->input('perPage', 15);
        $search = $request->input('search', '');
        // dd($r_person);

        // Thiết lập truy vấn
        $query = Orders::select('*')->where('user_id', $user)->orderBy('id', 'desc');
        // if (!empty($r_person)) {
        //     $query = $query->where('c_account_type_national', $r_person);
        // }

        // Bộ lọc tìm kiếm
        if (!empty($search)) {
            $query = $query->where(function ($q) use ($search) {
                $q->where('bill_status', 'LIKE', "%{$search}%")
                    ->orWhere('restaurant_id', 'LIKE', "%{$search}%")
                    ->orWhere('total_price', 'LIKE', "%{$search}%");
            });
        }

        // Phân trang
        $objResult = $query->paginate($perPage, ['*'], 'page', $currentPage);
        // dd($objResult);

        // Dữ liệu để truyền vào view
        $data['data'] = $objResult;

        // Render view với dữ liệu và chuyển view đó thành chuỗi HTML
        $html = view('donhang.loadList', $data)->render();

        // Trả về dữ liệu JSON bao gồm HTML của view và HTML của phần phân trang
        return response()->json([
            'html' => $html,
            'pagination' => (string) $objResult->links('donhang.pagination')
        ]);
    }

    public function inforRecord(Request $request)
    {
        $id = $request->input('id');
        $Id_DON_HANG = Orders::where('id', $id)->first();
        $data['data'] = $Id_DON_HANG;
        return view('donhang.viewModal', $data);
    }
}
