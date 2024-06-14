<?php

namespace App\Http\Controllers;

use App\Models\BankType;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BankController extends Controller
{
    public function index($id)
    {
        $user = Auth::id();
        $restaurant = Restaurant::find($id);
        $bankAccounts = DB::table('BankingType')->where('restaurant_id', $id)->get();
        $response = Http::get('https://api.vietqr.io/v2/banks');
        $banks = [];
        if ($response->successful()) {
            $result = $response->body();
            $banks = json_decode($result, true);
        }
        return view('shop.payment.index', compact('banks', 'bankAccounts', 'restaurant', 'user'));
    }

    public function addBank(Request $request, $restaurant_id)
    {
        $request->validate([
            'bank_name' => 'required',
            'account_number' => 'required|numeric',
            'full_name' => 'required',
        ]);
        // Kiểm tra xem account_number đã tồn tại hay chưa
        $exist = DB::table('BankingType')->where('account_number', $request->input('account_number'))->exists();
        if ($exist) {
            return back()->withErrors(['account_number' => 'Số tài khoản này đã tồn tại trong hệ thống.']);
        }

        // Tách chuỗi để lấy short_name và code
        [$short_name, $code, $bin] = explode('|', $request->input('bank_name'), 3);

        DB::table('BankingType')->insert([
            'banking_name' => $short_name,
            'account_number' => $request->input('account_number'),
            'name' => $request->input('full_name'),
            'banking_code' => $code,
            'banking_bin' => $bin,
            'status' => true,
            'banking_setDefault' => false,
            'restaurant_id' => $restaurant_id,
        ]);

        return response()->json(['success' => 'Tài khoản ngân hàng đã được thêm.']);
        // return view('shop.payment.index')->with('success', 'Tài khoản ngân hàng đã được thêm.');
    }

    public function getDeleteModal($restaurant_id, $accountId)
    {
        $bankData = BankType::findOrFail($accountId);
        $htmlContent = view('shop.payment.modalDelete', compact('bankData'))->render();
        return response()->json(['htmlContent' => $htmlContent]);
    }


    public function deleteBank(Request $request, $restaurant_id, $accountId)
    {
        $bank = BankType::findOrFail($accountId);
        $bank->delete();
        return response()->json(['success' => 'Đã xóa tài khoản thành công']);
    }


    public function getBankData($restaurant_id, $accountId)
    {
        $bankData = BankType::findOrFail($accountId);
        $response = Http::get('https://api.vietqr.io/v2/banks');
        $banks = [];
        if ($response->successful()) {
            $banks = json_decode($response->body(), true);
        }
        $htmlContent = view('shop.payment.modal', compact('bankData', 'banks'))->render();

        return response()->json(['htmlContent' => $htmlContent]);
    }

    public function editBank(Request $request, $restaurant_id)
    {
        $data = $request->json()->all();
        $request->validate([
            'banking_id' => 'required',
            'bank_name' => 'required',
            'account_number' => 'required|numeric',
            'full_name' => 'required',
        ]);

        $bankInfo = $this->extractBankName($request->input('bank_name'));

        DB::table('BankingType')->where('banking_id', $request->input('banking_id'))->update([
            'banking_name' => $bankInfo['shortName'],
            'banking_code' => $bankInfo['code'],
            'banking_bin' => $bankInfo['bin'],
            'account_number' => $request->input('account_number'),
            'name' => $request->input('full_name'),
        ]);

        $data['banking_name'] = $bankInfo['shortName'];

        return response()->json([
            'success' => 'Tài khoản ngân hàng đã được cập nhật.',
            'banking_id' => $data['banking_id'],
            'banking_name' => $data['banking_name'],
            'account_number' => $data['account_number'],
            'full_name' => $data['full_name'],
        ]);
    }

    protected function extractBankName($bankName)
    {
        list($shortName, $code, $bin) = explode('|', $bankName, 3);
        return ['shortName' => $shortName, 'code' => $code, 'bin' => $bin];
    }



    public function updateDefault(Request $request, $restaurant_id, $accountId)
    {
        $banking_setDefault = $request->input('banking_setDefault') ? 1 : 0;
        // dd($banking_setDefault, $accountId);

        // Tìm và cập nhật bản ghi
        DB::table('BankingType')->where('banking_id', $accountId)->update(['banking_setDefault' => $banking_setDefault]);
        // dd($accountId, $restaurant_id, $banking_setDefault);
        // Cập nhật tất cả các bản ghi khác thành không chọn
        DB::table('BankingType')->where('banking_id', '!=', $accountId)->update(['banking_setDefault' => 0]);

        return response()->json(['success' => 'Trạng thái cập nhật thành công']);
    }
}
