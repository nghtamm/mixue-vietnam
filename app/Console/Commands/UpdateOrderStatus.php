<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Orders;

class UpdateOrderStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:cancel-unaccepted';
    protected $description = 'Hủy các đơn hàng không được nhận sau 10 phút';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Lấy thời gian hiện tại trừ đi 10 phút
        $thresholdTime = now()->subMinutes(10);

        // Lọc và cập nhật trạng thái của các đơn hàng chưa được nhận
        $orders = Orders::where('bill_status', '=', 'Đang chờ xử lí')
            ->where('created_at', '<', $thresholdTime)
            ->update(['bill_status' => 'Hủy đơn hàng']);

        $this->info('Đã hủy ' . $orders . ' đơn hàng không được nhận sau 10 phút.');
    }
}
