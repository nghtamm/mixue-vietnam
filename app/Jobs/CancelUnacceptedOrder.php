<?php

namespace App\Jobs;

use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\Orders;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CancelUnacceptedOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $orderId;

    public function __construct($orderId)
    {
        $this->orderId = $orderId;
    }

    public function handle()
    {
        $order = Orders::find($this->orderId);

        // Nếu đơn hàng tồn tại và đang ở trạng thái "Đang chờ xử lí", cập nhật trạng thái của nó.
        if ($order && $order->bill_status === 'Đang chờ xử lí') {
            $order->update(['bill_status' => 'Hủy đơn hàng']);
            $this->sendCancellationMail($order);
            Log::channel('slack')->info("Đơn hàng #{$this->orderId} đã được cập nhật thành trạng thái 'Hủy đơn hàng'.");
        } elseif (!$order) {
            // Ghi log nếu đơn hàng không tìm thấy
            Log::channel('slack')->warning("Đơn hàng #{$this->orderId} không tồn tại trong cơ sở dữ liệu.");
        }
    }

    /**
     * Gửi email thông báo hủy đơn hàng.
     *
     * @param \App\Models\Orders $order Đối tượng đơn hàng cần gửi mail thông báo.
     */
    protected function sendCancellationMail($order)
    {
        Mail::to($order->user->user_email)->queue(new OrderMail(
            $order->total_price,
            $order->restaurant->restaurant_name,
            $order->bill_status,
            $order->staff->name ?? $order->restaurant->restaurant_name
        ));
    }
}
