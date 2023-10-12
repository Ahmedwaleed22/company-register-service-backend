<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Partner;

class PartnerController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Partner';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Partner());
        
        $grid->model()->orderBy('id', 'desc');

        $grid->filter(function($filter){
            // Remove the default id filter
            $filter->disableIdFilter();
        
            // Add a column filter
            $filter->like('order_id');
        });

        $grid->column('order_id', __('Order ID'));
        $grid->column('id', __('Id'));
        $grid->column('first_name', __('First name'));
        $grid->column('last_name', __('Last name'));
        $grid->column('email', __('Email'));
        $grid->column('nationality', __('Nationality'));
        $grid->column('country', __('Country'));
        $grid->column('city', __('City'));
        $grid->column('address', __('Address'));
        $grid->column('whatsapp_number', __('Whatsapp number'));
        $grid->column('dob', __('Date of Birth'));
        $grid->column('share_holds', __('Share holds'));
        $grid->column('passport', __('Passport'))->downloadable();
        $grid->column('company_id', __('Company ID'));
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
        $show = new Show(Partner::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('first_name', __('First name'));
        $show->field('last_name', __('Last name'));
        $show->field('email', __('Email'));
        $show->field('nationality', __('Nationality'));
        $show->field('country', __('Country'));
        $show->field('city', __('City'));
        $show->field('address', __('Address'));
        $show->field('whatsapp_number', __('Whatsapp number'));
        $show->field('dob', __('Date of Birth'));
        $show->field('share_holds', __('Share holds'));
        $show->field('passport', __('Passport'));
        $show->field('company_id', __('Company ID'));
        $show->field('order_id', __('Order ID'));
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
        $form = new Form(new Partner());

        $form->text('first_name', __('First name'));
        $form->text('last_name', __('Last name'));
        $form->email('email', __('Email'));
        $form->text('nationality', __('Nationality'));
        $form->text('country', __('Country'));
        $form->text('city', __('City'));
        $form->textarea('address', __('Address'));
        $form->text('whatsapp_number', __('Whatsapp number'));
        $form->date('dob', __('Date of Birth'));
        $form->text('share_holds', __('Share holds'));
        $form->image('passport', __('Passport'));
        $form->number('order_id', __('Order ID'));

        return $form;
    }
}
