<?php

namespace App\Admin\Controllers;

use App\Models\Restaurant;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\UserMixue;

class RestaurantController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Restaurant';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Restaurant());

        $grid->column('restaurant_id', __('Restaurant id'));
        $grid->column('restaurant_name', __('Restaurant name'));
        $grid->column('restaurant_location', __('Restaurant location'));
        $grid->column('restaurant_openStatus', __('Restaurant openStatus'))->using(['1' => 'Đang mở', '0' => 'Đóng']);
        $grid->column('restaurant_image', __('Restaurant image'));
        $grid->column('tgroup_id', __('Tgroup id'));
        $grid->filter(function ($filter) {
            // Thêm 1 filter theo cột dữ liệu
            $filter->like('restaurant_name', 'Restaurant name');
            $filter->like('restaurant_location', 'Restaurant location');
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
        $show = new Show(Restaurant::findOrFail($id));

        $show->field('restaurant_id', __('Restaurant id'));
        $show->field('restaurant_name', __('Restaurant name'));
        $show->field('restaurant_location', __('Restaurant location'));
        $show->field('restaurant_openTime', __('Restaurant openTime'));
        $show->field('restaurant_closeTime', __('Restaurant closeTime'));
        $show->field('restaurant_openStatus', __('Restaurant openStatus'))->using(['1' => 'Đang mở', '0' => 'Đóng']);
        $show->field('user_id', __('User id'));
        $show->field('restaurant_image', __('Restaurant image'));
        $show->field('tgroup_id', __('Tgroup id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
   protected function form()
   {
       $form = new Form(new Restaurant());

       // Ẩn trường restaurant_id trong form tạo
       $form->hidden('restaurant_id', __('Restaurant id'));

       $form->text('restaurant_name', __('Restaurant name'))->rules('nullable');
       $form->textarea('restaurant_location', __('Restaurant location'))->rules('nullable');
       $form->time('restaurant_openTime', __('Restaurant openTime'))->default(date('H:i:s'));
       $form->time('restaurant_closeTime', __('Restaurant closeTime'))->default(date('H:i:s'));
       $form->switch('restaurant_openStatus', __('Restaurant openStatus'))->default(1);
       $form->select('user_id', __('User id'))->options(UserMixue::all()->pluck('user_name', 'user_id'))->rules('required');
       $form->text('restaurant_image', __('Restaurant image'));
       $form->text('tgroup_id', __('Tgroup id'));

       return $form;
   }
}
