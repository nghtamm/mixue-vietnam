<?php

namespace App\Admin\Controllers;

use App\Models\NhanVien;
use App\Models\Restaurant;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class NhanVienController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'NhanVien';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new NhanVien());

        $grid->column('telegram_id', __('Telegram id'));
        $grid->column('name', __('Name'));
        $grid->column('phone', __('Phone'));
        $grid->column('restaurant.restaurant_name', __('Restaurant name'));
        $grid->filter(function ($filter) {
            // Xóa ID filter mặc định
            $filter->disableIdFilter();

            // Thêm 1 filter theo cột dữ liệu
            $filter->like('name', 'Staff name');
            $filter->like('phone', 'Phone');
            $filter->like('restaurant.restaurant_name', 'Restaurant name');
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
        $show = new Show(NhanVien::findOrFail($id));

        $show->field('telegram_id', __('Telegram id'));
        $show->field('name', __('Name'));
        $show->field('phone', __('Phone'));
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
        $form = new Form(new NhanVien());

        $form->text('telegram_id', __('Telegram id'))->rules('nullable');
        $form->text('name', __('Name'))->rules('nullable');
        $form->text('phone', __('Phone'))->rules('nullable|regex:/^[0-9]{10}$/');
        $form->select('restaurant_id', __('Restaurant'))->options(Restaurant::all()->pluck('restaurant_name', 'restaurant_id'))->rules('required');

        $form->footer(function ($footer) {
            // Disable reset button
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
