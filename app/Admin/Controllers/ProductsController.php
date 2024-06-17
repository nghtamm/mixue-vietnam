<?php

namespace App\Admin\Controllers;

use App\Models\Products;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ProductsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Products';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Products());

        $grid->column('product_id', __('Product id'));
        $grid->column('product_name', __('Product name'));
        $grid->column('product_description', __('Product description'));
        $grid->column('product_image', __('Product image'));
        $grid->column('product_price', __('Product price'));
        $grid->column('category.category_name', __('Category name'));
        $grid->column('restaurant.restaurant_name', __('Restaurant name'));
        $grid->column('product_status')->using(['1' => 'Còn hàng', '0' => 'Hết hàng']);
        $grid->filter(function ($filter) {
            // Xóa ID filter mặc định
            $filter->disableIdFilter();

            // Thêm 1 filter theo cột dữ liệu
            $filter->like('product_name', 'Product name');
            $filter->in('category_id')->checkbox([
                '1'    => 'Dòng kem',
                '2'    => 'Dòng trà hoa quả',
                '3'    => 'Dòng trà sữa',
                '4'    => 'Dòng cafe',
            ]);

            $filter->in('restaurant_id')->checkbox([
                '1'     => 'Mixue Quán Toan',
                '2'     => 'Mixue An Lão',
                '3'     => 'Mixue Vĩnh Bảo',
            ]);
            $filter->in('product_status')->checkbox([
                '1'     => 'Còn hàng',
                '2'     => 'Hết hàng',
            ]);

        });
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
        $show = new Show(Products::findOrFail($id));

        $show->field('product_id', __('Product id'));
        $show->field('product_name', __('Product name'));
        $show->field('product_description', __('Product description'));
        $show->field('product_image', __('Product image'));
        $show->field('product_price', __('Product price'));
        $show->column('category.category_name', __('Category name'));
        $show->column('product_status')->using(['1' => 'Còn hàng', '0' => 'Hết hàng']);
        $show->column('restaurant.restaurant_name', __('Restaurant name'));


        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Products());

        $form->text('product_name', __('Product name'));
        $form->textarea('product_description', __('Product description'));
        $form->text('product_image', __('Product image'));
        $form->number('product_price', __('Product price'));
        $form->select('category_id')->options(['1' => 'Dòng kem', '2'=> 'Dòng trà hoa quả','3'=> 'Dòng trà sữa','4'=> 'Dòng cafe']);
        $form->switch('product_status', __('Product status'))->default(1);
        $form->select('restaurant_id')->options(['1' => 'Mixue Quán Toan', '2'=> 'Mixue An Lão','3'=> 'Mixue Vĩnh Bảo']);
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
