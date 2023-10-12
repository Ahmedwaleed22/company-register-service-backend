<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\GetOrders;
use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'User';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());
        
        $grid->model()->orderBy('id', 'desc');

        $grid->actions(function ($actions) {
            $actions->add(new GetOrders());
        });

        $grid->filter(function($filter){
            // Remove the default id filter
            $filter->disableIdFilter();
        
            // Add a column filter
            $filter->where(function ($query) {
                $query->whereRaw("concat(first_name, ' ', last_name) like '%" .$this->input. "%' ")
                    ->orWhere('id', 'like', "%{$this->input}%")
                    ->orWhere('email', 'like', "%{$this->input}%")
                    ->orWhere('address', 'like', "%{$this->input}%")
                    ->orWhere('whatsapp_number', 'like', "%{$this->input}%");
            }, 'Name, email, address, whatsapp number');
        });

        $grid->column('id', __('Id'));
        $grid->column('first_name', __('First name'));
        $grid->column('last_name', __('Last name'));
        $grid->column('email', __('Email'));
        $grid->column('email_verified_at', __('Email verified at'));
        $grid->column('password', __('Password'));
        $grid->column('nationality', __('Nationality'));
        $grid->column('country', __('Country'));
        $grid->column('city', __('City'));
        $grid->column('address', __('Address'));
        $grid->column('whatsapp_number', __('Whatsapp number'));
        $grid->column('dob', __('Date of Birth'));
        $grid->column('share_holds', __('Share holds'));
        $grid->column('passport', __('Passport'))->downloadable();
        $grid->column('remember_token', __('Remember token'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(User::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('first_name', __('First name'));
        $show->field('last_name', __('Last name'));
        $show->field('email', __('Email'));
        $show->field('email_verified_at', __('Email verified at'));
        $show->field('password', __('Password'));
        $show->field('nationality', __('Nationality'));
        $show->field('country', __('Country'));
        $show->field('city', __('City'));
        $show->field('address', __('Address'));
        $show->field('whatsapp_number', __('Whatsapp number'));
        $show->field('dob', __('Date of Birth'));
        $show->field('share_holds', __('Share holds'));
        $show->field('passport', __('Passport'));
        $show->field('remember_token', __('Remember token'));
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
        $form = new Form(new User());

        $form->text('first_name', __('First name'));
        $form->text('last_name', __('Last name'));
        $form->email('email', __('Email'));
        $form->datetime('email_verified_at', __('Email verified at'))->default(date('Y-m-d H:i:s'));
        $form->password('password', __('Password'));
        $form->text('nationality', __('Nationality'));
        $form->text('country', __('Country'));
        $form->text('city', __('City'));
        $form->textarea('address', __('Address'));
        $form->text('whatsapp_number', __('Whatsapp number'));
        $form->date('dob', __('Date of Birth'));
        $form->text('share_holds', __('Share holds'));
        $form->image('passport', __('Passport'));
        $form->text('remember_token', __('Remember token'));

        return $form;
    }
}
