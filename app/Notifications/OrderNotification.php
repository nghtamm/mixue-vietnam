<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use NotificationChannels\Telegram\TelegramLocation;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $order;
    private $chatId;

    /**
     * Create a new notification instance.
     *
     * @param  mixed  $order  Đối tượng đơn hàng hoặc dữ liệu liên quan đến đơn hàng
     * @param  string $chatId ID chat Telegram để gửi thông báo
     */
    public function __construct($order, $chatId)
    {
        $this->order = $order;
        $this->chatId = $chatId;
    }

    public function via($notifiable)
    {
        return [TelegramChannel::class];
    }

    // private function getAddressCoordinates($address)
    // {
    //     $client = new Client();
    //     $response = $client->request('GET', 'https://nominatim.openstreetmap.org/search', [
    //         'query' => [
    //             'q' => $address,
    //             'format' => 'json'
    //         ],
    //         'headers' => [
    //             'User-Agent' => 'UncleCatVN'
    //         ]
    //     ]);

    //     $data = json_decode($response->getBody(), true);
    //     if (!empty($data)) {
    //         $firstResult = $data[0];
    //         return (object) [
    //             'latitude' => $firstResult['lat'],
    //             'longitude' => $firstResult['lon']
    //         ];
    //     }

    //     return null;
    // }

    private function getAddressCoordinates($address)
    {
        $client = new Client();
        $response = $client->request('GET', 'https://maps.googleapis.com/maps/api/geocode/json', [
            'query' => [
                'address' => $address,
                'key' => env('GOOGLE_MAPS_API_KEY')
            ]
        ]);

        $data = json_decode($response->getBody(), true);
        // Log dữ liệu để debug
        Log::channel('slack')->info("API Response:", $data);
        if (!empty($data['results'])) {
            $coordinates = $data['results'][0]['geometry']['location'];
            Log::info('Coordinates found:', ['latitude' => $coordinates['lat'], 'longitude' => $coordinates['lng']]);
            return (object) [
                'latitude' => $coordinates['lat'],
                'longitude' => $coordinates['lng']
            ];
        }

        return null;
    }

    public function toTelegram($notifiable)
    {
        // $coordinates = $this->getAddressCoordinates($this->order->order_address);
        // dd($coordinates);
        $messageText = $this->createMessageText();

        // Thêm liên kết tới Google Maps với tọa độ
        // $locationUrl = "https://www.google.com/maps/search/?api=1&query={$coordinates->latitude},{$coordinates->longitude}";
        // $messageText .= "\nXem Vị Trí: [Xem Trên Bản Đồ]($locationUrl)";

        // Log::channel('slack')->info($locationUrl);
        // Gửi thông báo văn bản với liên kết tới vị trí
        $telegramMessage = TelegramMessage::create()
            ->to($this->chatId)
            ->content($messageText)
            ->options(['parse_mode' => 'Markdown']);

        return $telegramMessage;
    }

    private function createMessageText()
    {
        $name = $this->order->user->user_name;
        $deliveryTimeMessage = $this->order->is_asap == 1 ? 'Càng sớm càng tốt' : $this->order->scheduled_delivery_time;
        $payment = $this->order->order_payment == 0 ? 'Tiền mặt' : 'Chuyển khoản';
        // dd($name);
        $message = "Đơn hàng của: {$name} (Đơn số: {$this->order->daily_order_number}) \n";
        foreach ($this->order->orderDetails as $detail) {
            $productName = $detail->product->product_name;
            $iceName = $detail->ice->ice_option;
            $sugarName = $detail->sugar->sugar_option;
            $productTotalFormatted = number_format($detail->product_total, 0, '.', '.');
            $message .= "{$productName} ({$detail->price} x {$detail->quantity}) (Đá: {$iceName}, Đường: {$sugarName}): {$productTotalFormatted}₫\n";
        }
        $totalPriceFormatted = number_format($this->order->total_price, 0, '.', '.');
        $shippingFeeFormatted = number_format(session('shipping_fee'), 0, '.', '.');
        $message .= "----------------------------\n";
        $message .= "Số lượng sản phẩm: {$this->order->quantity}\n";
        $message .= "Tổng tiền: {$totalPriceFormatted}₫ (Đã tính phí ship)\n";
        $message .= "Phí ship: {$shippingFeeFormatted}₫\n";
        $message .= "Hình thức thanh toán: {$payment}\n";
        $message .= "----------------------------\n";
        $message .= "Thời gian giao hàng: {$deliveryTimeMessage}\n";
        // Xử lý thông tin người nhận dựa trên order_gift
        $recipientInfo = $this->order->order_gift ? 'Thông tin người nhận' : 'Thông tin người đặt';
        $message .= "{$recipientInfo}: {$this->order->order_name}\n";
        $message .= "Số điện thoại: {$this->order->order_phone}\n";
        $message .= "Địa chỉ: {$this->order->order_address}\n";
        $message .= "Ghi chú đơn hàng: {$this->order->user_note}\n";
        $message .= "Ngày tạo: {$this->order->created_at}";
        return $message;
    }
}
