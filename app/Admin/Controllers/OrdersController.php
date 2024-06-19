<?php

namespace App\Admin\Controllers;

use App\Models\Orders;
use App\Models\OrderDetail;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
Use Encore\Admin\Widgets\Table;

class OrdersController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Orders';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Orders());


            $grid->column('id', __('Id'))->expand(function ($model) {
                $orderDetails = $model->orderDetails()->with('product')->take(10)->get()->map(function ($orderDetail) {
                    return [
                        'product_id' => $orderDetail->product_id,
                        'product_name' => $orderDetail->product ? $orderDetail->product->product_name : 'N/A', // Sử dụng mối quan hệ để lấy tên sản phẩm
                        'quantity' => $orderDetail->quantity,
                        'sugar_id' => $orderDetail->sugar_id ? $orderDetail->sugar->sugar_option : 'N/A', // Sử dụng mối quan hệ để lấy tên đường
                        'ice_id' => $orderDetail->ice_id ? $orderDetail->ice->ice_option : 'N/A', // Sử dụng mối quan hệ để lấy tên đá
                        'price' => $orderDetail->price,
                        'product_total' => $orderDetail->product_total,
                    ];
                });

                return new Table(['Product ID', 'Product Name', 'Quantity', 'Sugar', 'Ice', 'Price', 'Product Total'], $orderDetails->toArray());
            });

            $grid->column('user_id', __('User id'));
            $grid->column('total_price', __('Total price'));
            $grid->column('shipping_id', __('Shipping id'));
            $grid->column('restaurant.restaurant_name', __('Restaurant name'));
            $grid->column('user_note', __('User note'));
            $grid->column('bill_status', __('Bill status'));
            $grid->column('payment_status', __('Payment status'));
            $grid->column('order_payment', __('Order payment'))->using(['1' => 'Đã thanh toán', '0' => 'Chưa thanh toán']);
            $grid->column('order_gift', __('Order gift'))->using(['1' => 'Đơn tặng', '0' => 'Không phải đơn tặng']);
            $grid->column('order_name', __('Order name'));
            $grid->column('order_phone', __('Order phone'));
            $grid->column('order_address', __('Order address'));
            $grid->column('is_asap', __('Is asap'))->using(['1' => 'Giao ngay lập tức', '2' => 'Giao hàng sau']);
            $grid->column('scheduled_delivery_time', __('Scheduled delivery time'));
            $grid->column('daily_order_number', __('Daily order number'));
            $grid->column('created_at', __('Created at'));
            $grid->column('updated_at', __('Updated at'));
            $grid->column('telegram_id', __('Telegram id'));
            $grid->column('quantity', __('Quantity'));
            $grid->disableCreateButton();

        $grid->filter(function ($filter) {
            $filter->like('user_id', 'User ID');
            $filter->between('total_price', 'Total Price')->decimal();
            $filter->like('restaurant.restaurant_name', 'Restaurant Name');
            $filter->in('bill_status', 'Bill Status')->radio(['Đã nhận đơn' => 'Đã nhận đơn', 'Hủy đơn hàng'=> 'Hủy đơn hàng','Đang chờ xử lí'=> 'Đang chờ xử lí','Hoàn thành đơn'=> 'Hoàn thành đơn']);
            $filter->in('payment_status', 'Payment Status')->radio(['Đang chờ thanh toán' => 'Đang chờ thanh toán', 'Đã thanh toán'=> 'Đã thanh toán']);
            $filter->like('order_name', 'Order Name');
            $filter->like('order_phone', 'Order Phone');
            $filter->like('order_address', 'Order Address');
            $filter->between('created_at', 'Created At')->date();
            $filter->between('updated_at', 'Updated At')->date();
            $filter->like('telegram_id', 'Telegram ID');
        });


            $grid->actions(function ($actions) {
                $actions->disableView();
            });


            return $grid;
        }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
//    protected function detail($id)
//    {
//        $show = new Show(Orders::findOrFail($id));
//        // Add OrderDetail as a nested table
//        $show->orderDetails('Order Details', function ($orderDetail) {
//            $orderDetail->resource('/admin/orders'); // Set the resource to Orders controller itself
//
//            $orderDetail->id();
//            $orderDetail->order_id();
//            $orderDetail->product_id();
//            $orderDetail->quantity();
//            $orderDetail->price();
//            $orderDetail->sugar_id();
//            $orderDetail->ice_id();
//            $orderDetail->product_total();
//
//            $orderDetail->disableExport();
//            $orderDetail->disableFilter();
//            $orderDetail->disablePagination();
//            $orderDetail->disableRowSelector();
//            $orderDetail->disableActions();
//        });
//
//        return $show;
//    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Orders());

        $form->text('user_id', __('User id'))->readonly();
        $form->decimal('total_price', __('Total price'))->readonly();
        $form->text('shipping_id', __('Shipping id'))->readonly();
        $form->text('restaurant_id', __('Restaurant id'))->readonly();
        $form->textarea('user_note', __('User note'));
        $form->select('bill_status')->options(['Đã nhận đơn' => 'Đã nhận đơn', 'Hủy đơn hàng'=> 'Hủy đơn hàng','Đang chờ xử lí'=> 'Đang chờ xử lí','Hoàn thành đơn'=> 'Hoàn thành đơn']);
        $form->select('payment_status')->options(['Đang chờ thanh toán' => 'Đang chờ thanh toán', 'Đã thanh toán'=> 'Đã thanh toán']);
        $form->switch('order_payment', __('Order payment'));
        $form->switch('order_gift', __('Order gift'));
        $form->text('order_name', __('Order name'));
        $form->text('order_phone', __('Order phone'));
        $form->textarea('order_address', __('Order address'));
        $form->switch('is_asap', __('Is asap'));
        $form->time('scheduled_delivery_time', __('Scheduled delivery time'))->default(date('H:i:s'));
        $form->text('daily_order_number', __('Daily order number'))->readonly();
        $form->text('telegram_id', __('Telegram id'))->readonly();
        $form->text('quantity', __('Quantity'))->readonly();

        $form->footer(function ($footer) {
            // Disable reset btn
            $footer->disableReset();

            // Disable `View` checkbox
            $footer->disableViewCheck();

            // Disable `Continue editing` checkbox
            $footer->disableEditingCheck();

            // Disable `Continue Creating` checkbox
            $footer->disableCreatingCheck();

        });

        return $form;
    }
}
