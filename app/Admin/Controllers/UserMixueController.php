<?php

namespace App\Admin\Controllers;

use App\Models\UserMixue;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Hash;

class UserMixueController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'UserMixue';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new UserMixue());

        $grid->column('user_id', __('User id'));
        $grid->column('user_name', __('User name'));
        $grid->column('user_gender', __('User gender'));
        $grid->column('user_address', __('User address'));
        $grid->column('user_email', __('User email'));
        $grid->column('verified', __('Verified'))->using(['1' => 'Verified', '0' => 'Unverified']);
        $grid->column('user_phone', __('User phone'));
        $grid->column('user_status', __('User status'))->using(['1' => 'Online', '0' => 'Offline']);
        $grid->disableCreateButton();

        $grid->filter(function ($filter) {
            // Xóa ID filter mặc định
            $filter->disableIdFilter();
            $filter->like('user_name', 'User name');
            $filter->like('user_email', 'User email');
            $filter->like('user_phone', 'User phone');
            $filter->in('verified')->checkbox([
                '1' => 'Verified',
                '0' => 'Unverified',
            ]);
            $filter->in('user_status')->checkbox([
                '1' => 'Online',
                '0' => 'Offline',
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
        $show = new Show(UserMixue::findOrFail($id));

        $show->field('user_id', __('User id'));
        $show->field('user_name', __('User name'));
        $show->field('user_gender', __('User gender'));
        $show->field('user_address', __('User address'));
        $show->field('user_email', __('User email'));
        $show->field('verified', __('Verified'))->using(['1' => 'Verified', '0' => 'Unverified']);
        $show->field('user_phone', __('User phone'));
        $show->field('user_password', __('User password'));
        $show->field('user_status', __('User status'))->using(['1' => 'Online', '0' => 'Offline']);
        $show->field('remember_token', __('Remember token'));
        $show->field('otp_code', __('Otp code'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new UserMixue());

        $form->text('user_name', __('User name'));
        $form->text('user_gender', __('User gender'));
        $form->text('user_address', __('User address'));
        $form->text('user_email', __('User email'));
        $form->switch('verified', __('Verified'));
        $form->text('user_phone', __('User phone'));
        $form->password('user_password', __('User password'))->rules('nullable|min:6');
        $form->switch('user_status', __('User status'))->default(1);

        $form->saving(function (Form $form) {
            if ($form->user_password) {
                // Hash the password if it is set
                $form->user_password = Hash::make($form->user_password);
            } else {
                // If password is not set, retain the old password
                unset($form->user_password);
            }
        });

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
