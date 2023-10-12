<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Service;

class ServiceController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Service';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Service());

        $grid->model()->orderBy('id', 'desc');

        $grid->filter(function($filter){
            // Remove the default id filter
            $filter->disableIdFilter();
        
            // Add a column filter
            $filter->like('order_id');
        });

        $grid->column('order_id', __('Order id'));
        $grid->column('id', __('Id'));
        $grid->column('description', __('Description'));
        $grid->column('auto_renewal', __('Auto renewal'));
        $grid->column('end_date', __('End date'));
        $grid->column('company_id', __('Company id'));
        $grid->column('stripe_subscription_id', __('Stripe subscription id'));
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
        $show = new Show(Service::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('description', __('Description'));
        $show->field('auto_renewal', __('Auto renewal'));
        $show->field('end_date', __('End date'));
        $show->field('order_id', __('Order id'));
        $show->field('company_id', __('Company id'));
        $show->field('stripe_subscription_id', __('Stripe subscription id'));
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
        $form = new Form(new Service());

        $form->text('description', __('Description'));
        $form->switch('auto_renewal', __('Auto renewal'))->default(1);
        $form->date('end_date', __('End date'))->default(date('Y-m-d'));
        $form->number('order_id', __('Order id'));
        $form->number('company_id', __('Company id'));
        $form->text('stripe_subscription_id', __('Stripe subscription id'));

        return $form;
    }
}
