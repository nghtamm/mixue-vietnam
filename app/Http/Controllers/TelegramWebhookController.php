<?php

namespace App\Http\Controllers;

use App\Mail\OrderMail;
use App\Models\NhanVien;
use Illuminate\Http\Request;
use App\Models\Orders;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class TelegramWebhookController extends Controller
{
    public function handle(Request $request)
    {
        try {
            $update = $request->all();
            if (isset($update['message']['text'])) {
                $text = $update['message']['text'];
                $telegramUserId = $update['message']['from']['id'];
                $groupId = $update['message']['chat']['id'] ?? '';
                $nhanVien = NhanVien::where('telegram_id', $telegramUserId)->first();

                if ($nhanVien) {
                    if (preg_match('/^\/nhandon (\d+)$/', $text, $matches)) {
                        // Xử lý lệnh /nhandon
                        $this->processOrder($matches[1], $nhanVien, $groupId, true, $telegramUserId);
                    } elseif (preg_match('/^\/tuchoi (\d+)$/', $text, $matches)) {
                        // Xử lý lệnh /tuchoi
                        $this->processOrder($matches[1], $nhanVien, $groupId, false, $telegramUserId);
                    }
                } else {
                    // Không tìm thấy thông tin nhân viên
                    $responseMessage = "Không tìm thấy thông tin nhân viên trong hệ thống.";
                    $this->sendMessageToTelegramUser($groupId, $responseMessage);
                }
            }
        } catch (\Exception $e) {
            Log::channel('slack')->error("Lỗi khi xử lý webhook: " . $e->getMessage());
        }
        return response()->json(['status' => 'success']);
    }

    protected function processOrder($orderId, $nhanVien, $groupId, $accept, $telegramUserId)
    {
        $displayName = $nhanVien->name;
        $restaurantId = $nhanVien->restaurant_id;
        $today = now()->startOfDay();
        $order = Orders::where('daily_order_number', $orderId)
            ->where('restaurant_id', $restaurantId)
            ->whereDate('created_at', $today)
            ->first();

        if ($order) {
            if ($accept) {
                $order->bill_status = 'Đã nhận đơn';
                Log::channel('slack')->info("Đơn hàng #{$order->id} đã được {$displayName} nhận.");
                $responseMessage = "Đơn hàng #{$orderId} đã được {$displayName} nhận.";
                // Log::channel('slack')->error($order->total_price, $order->restaurant->restaurant_name);
            } else {
                $order->bill_status = 'Hủy đơn hàng';
                Log::channel('slack')->info("Đơn hàng #{$order->id} đã bị {$displayName} từ chối.");
                // Log::channel('slack')->info($order);
                $responseMessage = "Đơn hàng #{$orderId} đã bị {$displayName} từ chối.";
            }
            $order->telegram_id = $telegramUserId;
            $order->save();
            $this->sendOrderEmail($order);
            $this->sendMessageToTelegramUser($groupId, $responseMessage);
        } else {
            $responseMessage = "Không tìm thấy đơn hàng với #{$orderId} tại cửa hàng của bạn.";
            $this->sendMessageToTelegramUser($groupId, $responseMessage);
        }
    }

    /**
     * Gửi email thông báo cho người dùng về đơn hàng.
     *
     * @param \App\Models\Orders $order
     */
    protected function sendOrderEmail(Orders $order)
    {
        Mail::to($order->user->user_email)->queue(new OrderMail(
            $order->total_price,
            $order->restaurant->restaurant_name,
            $order->bill_status,
            $order->staff->name ?? $order->restaurant->restaurant_name
        ));
    }

    protected function sendMessageToTelegramUser($chatId, $text)
    {
        $botToken = env('TELEGRAM_BOT_TOKEN');
        $response = Http::post("https://api.telegram.org/bot{$botToken}/sendMessage", [
            'chat_id' => $chatId,
            'text' => $text,
            'parse_mode' => 'HTML'
        ]);

        return $response->json();
    }
}
