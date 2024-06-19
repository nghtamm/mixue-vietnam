<?php
namespace App\Admin\Controllers;

use App\Models\OrderDetail;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class OrderDetailController extends AdminController
{
    protected $title = 'Order Details';

    protected function grid()
    {
        $grid = new Grid(new OrderDetail());

        $grid->column('id', __('ID'));
        $grid->column('order_id', __('Order ID'));
        $grid->column('product_id', __('Product ID'));
        $grid->column('quantity', __('Quantity'));
        $grid->column('price', __('Price'));
        $grid->column('sugar_id', __('Sugar ID'));
        $grid->column('ice_id', __('Ice ID'));
        $grid->column('product_total', __('Product Total'));

        return $grid;
    }

    protected function detail($id)
    {
        $show = new Show(OrderDetail::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('order_id', __('Order ID'));
        $show->field('product_id', __('Product ID'));
        $show->field('quantity', __('Quantity'));
        $show->field('price', __('Price'));
        $show->field('sugar_id', __('Sugar ID'));
        $show->field('ice_id', __('Ice ID'));
        $show->field('product_total', __('Product Total'));

        return $show;
    }

    protected function form()
    {
        $form = new Form(new OrderDetail());

        $form->number('order_id', __('Order ID'));
        $form->number('product_id', __('Product ID'));
        $form->number('quantity', __('Quantity'));
        $form->decimal('price', __('Price'));
        $form->number('sugar_id', __('Sugar ID'));
        $form->number('ice_id', __('Ice ID'));
        $form->decimal('product_total', __('Product Total'));

        return $form;
    }
}
