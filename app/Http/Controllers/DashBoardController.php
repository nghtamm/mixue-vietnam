<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashBoardController extends Controller
{
    public function index(Request $request)
    {
        $user_id = Auth::id();
        $restaurant = DB::table('restaurant')->where('user_id', $user_id)->get();
        // dd($restaurant, $user_id);
        $data['restaurant'] = $restaurant;
        return view('shop.dashboard.index', $data);
    }

    public function updateStatus(Request $request)
    {
        $restaurant_openStatus = $request->input('restaurant_openStatus') == 'true' ? 1 : 0;
        $restaurantId = $request->input('restaurantId');
        // dd($banking_setDefault, $accountId);

        // Tìm và cập nhật bản ghi
        DB::table('restaurant')->where('restaurant_id', $restaurantId)->update(['restaurant_openStatus' => $restaurant_openStatus]);
        // dd($update, $restaurantId, $restaurant_openStatus);

        return response()->json(['success' => 'Trạng thái cập nhật thành công']);
    }
}
