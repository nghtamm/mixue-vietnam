<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $price;
    public $restaurant_name;
    public $bill_status;
    public $name;

    /**
     * Create a new message instance.
     */
    public function __construct($total_prỉce, $restaurant_name, $bill_status, $name)
    {
        $this->price = $total_prỉce;
        $this->restaurant_name = $restaurant_name;
        $this->bill_status = $bill_status;
        $this->name = $name;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->view('donhang.otp')
            ->with([
                'name' => $this->name,
                'price' => $this->price,
                'bill_status' => $this->bill_status,
                'restaurant_name' => $this->restaurant_name,
            ])
            ->subject('Đơn hàng của bạn');
    }
}
