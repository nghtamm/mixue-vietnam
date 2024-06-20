<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    public function showRevenue()
    {
        return view('admin.analytics.revenue');
    }

    public function mostProductSale(Request $request)
    {
        // $from_date = $request->from_date;
        // $to_date = $request->to_date;

        // if (empty($from_date) || empty($to_date)) {
        //     return response()->json(['message' => 'Vui lòng nhập đầy đủ ngày bắt đầu, ngày kết thúc'], 400);
        // }

        // $validator = Validator::make($request->all(), [
        //     'from_date' => 'required|date_format:Y/m/d',
        //     'to_date' => 'required|date_format:Y/m/d',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json(['message' => $validator->errors()->first()], 400);
        // }


        $result = DB::select("SELECT OrderDetail.product_id, products.product_name,
            COUNT(OrderDetail.product_id) AS so_lan_mua,
            SUM(OrderDetail.quantity) as so_luong_mua,
            SUM(OrderDetail.price * OrderDetail.quantity) as tong_tien
        FROM
            OrderDetail
        JOIN
            products ON OrderDetail.product_id = products.product_id
        GROUP BY
            OrderDetail.product_id, products.product_name
        ORDER BY
            tong_tien DESC, so_luong_mua DESC
        LIMIT 10
    ");

        return response()->json($result);
    }

    public function mostProductSaleByMember(Request $request)
    {
        $from_date = $request->from_date;
        $to_date = $request->to_date;

        if (empty($from_date) || empty($to_date)) {
            return response()->json(['message' => 'Vui lòng nhập đầy đủ ngày bắt đầu, ngày kết thúc'], 400);
        }

        $validator = Validator::make($request->all(), [
            'from_date' => 'required|date_format:Y/m/d',
            'to_date' => 'required|date_format:Y/m/d',
            'id_member' => 'required|integer'
        ], [
            'id_member.required' => 'Vui lòng nhập id thành viên',
            'id_member.integer' => 'Id thành viên phải là số nguyên'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 400);
        }

        $result = DB::select("SELECT id_san_pham,mh_mua_hang.ten_thuoc ,
        COUNT(mh_mua_hang.id_san_pham) AS so_lan_mua,
        sum(mh_mua_hang.so_luong_mua) as so_luong_mua,
        sum(mh_mua_hang.thanh_tien) as tong_tien
        FROM mh_mua_hang
        WHERE DATE(mh_mua_hang.ngay_mua) BETWEEN '$from_date' AND '$to_date'
        AND mh_mua_hang.nguoi_mua = '$request->id_member'
        GROUP BY mh_mua_hang.id_san_pham, mh_mua_hang.ten_thuoc
        ORDER BY tong_tien DESC, so_luong_mua DESC
        LIMIT 50");


        return response()->json($result);
    }

    public function mostProductSaleByQuay(Request $request)
    {
        $from_date = $request->from_date;
        $to_date = $request->to_date;

        if (empty($from_date) || empty($to_date)) {
            return response()->json(['message' => 'Vui lòng nhập đầy đủ ngày bắt đầu, ngày kết thúc'], 400);
        }

        $validator = Validator::make($request->all(), [
            'from_date' => 'required|date_format:Y/m/d',
            'to_date' => 'required|date_format:Y/m/d',
            'id_quay' => 'required|integer'
        ], [
            'id_quay.required' => 'Vui lòng nhập id quầy',
            'id_quay.integer' => 'Id thành viên phải là số nguyên'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 400);
        }

        $result = DB::select("SELECT id_san_pham,mh_mua_hang.ten_thuoc ,
        COUNT(mh_mua_hang.id_san_pham) AS so_lan_mua,
        sum(mh_mua_hang.so_luong_mua) as so_luong_mua,
        sum(mh_mua_hang.thanh_tien) as tong_tien
        FROM mh_mua_hang
        WHERE DATE(mh_mua_hang.ngay_mua) BETWEEN '$from_date' AND '$to_date'
        AND mh_mua_hang.id_quay = '$request->id_quay'
        GROUP BY mh_mua_hang.id_san_pham, mh_mua_hang.ten_thuoc
        ORDER BY tong_tien DESC, so_luong_mua DESC
        LIMIT 50");

        return response()->json($result);
    }

    public function QuayMuaNhieu(Request $request)
    {
        // $from_date = $request->from_date;
        // $to_date = $request->to_date;

        // if (empty($from_date) || empty($to_date)) {
        //     return response()->json(['message' => 'Vui lòng nhập đầy đủ ngày bắt đầu, ngày kết thúc'], 400);
        // }

        // $validator = Validator::make($request->all(), [
        //     'from_date' => 'required|date_format:Y/m/d',
        //     'to_date' => 'required|date_format:Y/m/d',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json(['message' => $validator->errors()->first()], 400);
        // }

        $result = DB::select("SELECT id_quay, mh_quay.name,
        COUNT(mh_mua_hang.id_quay) AS so_lan_mua,
        sum(mh_mua_hang.so_luong_mua) as so_luong_mua,
        sum(mh_mua_hang.thanh_tien) as tong_tien
        FROM mh_mua_hang
        LEFT JOIN mh_quay ON mh_mua_hang.id_quay = mh_quay.id
        GROUP BY mh_mua_hang.id_quay, mh_quay.name
        ORDER BY tong_tien DESC, so_luong_mua DESC
        LIMIT 10");

        return response()->json($result);
    }

    public function MemberMuaNhieu(Request $request)
    {
        // $from_date = $request->from_date;
        // $to_date = $request->to_date;

        // if (empty($from_date) || empty($to_date)) {
        //     return response()->json(['message' => 'Vui lòng nhập đầy đủ ngày bắt đầu, ngày kết thúc'], 400);
        // }

        // $validator = Validator::make($request->all(), [
        //     'from_date' => 'required|date_format:Y/m/d',
        //     'to_date' => 'required|date_format:Y/m/d',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json(['message' => $validator->errors()->first()], 400);
        // }

        $result = DB::select("SELECT mh_mua_hang.nguoi_mua, members.ten as nhan_vien,
        COUNT(mh_mua_hang.nguoi_mua) AS so_lan_mua,
        sum(mh_mua_hang.so_luong_mua) as so_luong_mua,
        sum(mh_mua_hang.thanh_tien) as tong_tien
        FROM mh_mua_hang
        LEFT JOIN members ON mh_mua_hang.nguoi_mua = members.id
        -- WHERE DATE(mh_mua_hang.ngay_mua)
        GROUP BY mh_mua_hang.nguoi_mua, members.ten_nha_thuoc
        ORDER BY tong_tien DESC ,so_luong_mua DESC
        LIMIT 10");

        return response()->json($result);
    }

    public function currentTurnover(Request $request)
    {
        $resultDay = DB::select("SELECT DATE(mh_mua_hang.ngay_mua) as ngay,
            sum(mh_mua_hang.thanh_tien) as tong_tien
            FROM mh_mua_hang
            WHERE DATE(mh_mua_hang.ngay_mua) = CURDATE()
            Group by DATE(mh_mua_hang.ngay_mua)
            ");
        $resultWeek = DB::select("SELECT WEEK(mh_mua_hang.ngay_mua) as tuan,
            sum(mh_mua_hang.thanh_tien) as tong_tien
            FROM mh_mua_hang
            WHERE WEEK(mh_mua_hang.ngay_mua) = WEEK(CURDATE())
            Group by WEEK(mh_mua_hang.ngay_mua)
            ");
        $resultMonth = DB::select("SELECT MONTH(mh_mua_hang.ngay_mua) as thang,
            sum(mh_mua_hang.thanh_tien) as tong_tien
            FROM mh_mua_hang
            WHERE MONTH(mh_mua_hang.ngay_mua) = MONTH(CURDATE())
            Group by MONTH(mh_mua_hang.ngay_mua)
            ");
        $resultYear = DB::select("SELECT YEAR(mh_mua_hang.ngay_mua) as nam,
            sum(mh_mua_hang.thanh_tien) as tong_tien
            FROM mh_mua_hang
            WHERE YEAR(mh_mua_hang.ngay_mua) = YEAR(CURDATE())
            Group by YEAR(mh_mua_hang.ngay_mua)");
        return response()->json([
            'day' => $resultDay,
            'week' => $resultWeek,
            'month' => $resultMonth,
            'year' => $resultYear

        ]);
    }

    // thống kê doanh thu theo từng tháng của năm hiện tại
    public function saleOverview(Request $request)
    {
        $result = DB::select("SELECT
        all_months.thang AS thang,
        IFNULL(SUM(mh_mua_hang.thanh_tien), 0) AS tong_tien
        FROM
        (SELECT 1 AS thang UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12) AS all_months
        LEFT JOIN mh_mua_hang ON MONTH(mh_mua_hang.ngay_mua) = all_months.thang AND YEAR(mh_mua_hang.ngay_mua) = YEAR(NOW())
        WHERE
        all_months.thang <= MONTH(CURDATE())
        GROUP BY
        all_months.thang
        order by thang
        ");

        return response()->json($result);
    }

    // số lần gửi hàng ở từng bến
    public function sendOverview(Request $request)
    {
        $result = DB::select("SELECT
        ben.name AS ten_ben,
        COUNT(*) AS so_lan_gui
        FROM
        mh_mua_hang
        LEFT JOIN ben ON ben.id = mh_mua_hang.ben_id
        where mh_mua_hang.ben_id <> 0
        GROUP BY
        mh_mua_hang.ben_id
        ");

        return response()->json($result);
    }
}
