<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\Box;
use App\Models\Orders;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ChartjsController extends Controller
{
    public function index(Content $content)
    {
        // Fetch the total orders for today using the correct column name
        $today = Carbon::today();
        $totalOrdersToday = Orders::whereDate('created_at', $today)->count();

        // Fetch the revenue for today
        $revenueToday = Orders::whereDate('created_at', $today)->sum('total_price');

        // Fetch the total orders per day
        $ordersData = Orders::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Format the data for Chart.js
        $labels = $ordersData->pluck('date')->map(function ($date) {
            return Carbon::parse($date)->format('Y-m-d');
        });
        $data = $ordersData->pluck('total');

        // Fetch the total quantity of each product sold
        $productSalesData = OrderDetail::join('products', 'OrderDetail.product_id', '=', 'products.product_id')
            ->select('products.product_name as product_name', DB::raw('SUM(OrderDetail.quantity) as total_quantity'))
            ->groupBy('products.product_name')
            ->orderBy('total_quantity', 'desc')
            ->get();

        // Format the data for Chart.js
        $productLabels = $productSalesData->pluck('product_name');
        $productData = $productSalesData->pluck('total_quantity');

        // Fetch the monthly revenue
        $monthlyRevenueData = Orders::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(total_price) as total_revenue')
        )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $revenueLabels = $monthlyRevenueData->pluck('month')->map(function ($month) {
            return Carbon::createFromDate(null, $month)->format('F');
        });
        $revenueData = $monthlyRevenueData->pluck('total_revenue');

        return $content
            ->header('Chartjs')
            ->body(new Box('Total Orders Today', "Total Orders Today: $totalOrdersToday"))
            ->body(new Box('Revenue Today', "Revenue Today: $revenueToday"))
            ->body(new Box('Chart', view('admin.chartjs', compact('labels', 'data', 'productLabels', 'productData', 'revenueLabels', 'revenueData'))));
    }
}
