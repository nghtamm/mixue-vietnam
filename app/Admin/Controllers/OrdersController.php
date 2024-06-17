<?php

namespace App\Admin\Controllers;

use App\Models\Orders;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

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

        $grid->column('id', __('Id'));
        $grid->column('user_id', __('User id'));
        $grid->column('total_price', __('Total price'));
        $grid->column('shipping_id', __('Shipping id'));
        $grid->column('restaurant.restaurant_name', __('Restaurant name'));
        $grid->column('user_note', __('User note'));
        $grid->column('bill_status', __('Bill status'));
        $grid->column('payment_status', __('Payment status'));
        $grid->column('order_payment', __('Order payment'));
        $grid->column('order_gift', __('Order gift'));
        $grid->column('order_name', __('Order name'));
        $grid->column('order_phone', __('Order phone'));
        $grid->column('order_address', __('Order address'));
        $grid->column('is_asap', __('Is asap'));
        $grid->column('scheduled_delivery_time', __('Scheduled delivery time'));
        $grid->column('daily_order_number', __('Daily order number'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('telegram_id', __('Telegram id'));
        $grid->column('quantity', __('Quantity'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Orders::findOrFail($id));

        $show->field('id');
        $show->field('OrderDetail.order_id');
        $show->field('OrderDetail.product_id');
        $show->field('OrderDetail.sugar_id');
        $show->field('OrderDetail.ice_id');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Orders());

        $form->text('user_id', __('User id'));
        $form->decimal('total_price', __('Total price'));
        $form->number('shipping_id', __('Shipping id'));
        $form->number('restaurant_id', __('Restaurant id'));
        $form->textarea('user_note', __('User note'));
        $form->text('bill_status', __('Bill status'));
        $form->text('payment_status', __('Payment status'));
        $form->switch('order_payment', __('Order payment'));
        $form->switch('order_gift', __('Order gift'));
        $form->text('order_name', __('Order name'));
        $form->text('order_phone', __('Order phone'));
        $form->textarea('order_address', __('Order address'));
        $form->switch('is_asap', __('Is asap'));
        $form->time('scheduled_delivery_time', __('Scheduled delivery time'))->default(date('H:i:s'));
        $form->number('daily_order_number', __('Daily order number'));
        $form->text('telegram_id', __('Telegram id'));
        $form->number('quantity', __('Quantity'));

        return $form;
    }
}
