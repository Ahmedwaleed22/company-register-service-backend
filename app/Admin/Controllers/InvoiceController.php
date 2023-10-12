<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Invoice;

class InvoiceController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Invoice';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Invoice());

        $grid->model()->orderBy('id', 'desc');

        $grid->filter(function($filter){
            // Remove the default id filter
            $filter->disableIdFilter();
        
            // Add a column filter
            $filter->like('order_id');
        });

        $grid->column('order_id', __('Order id'));
        $grid->column('id', __('Id'));
        $grid->column('invoice', __('Invoice'));
        $grid->column('description', __('Description'));
        $grid->column('price', __('Price'));
        $grid->column('status', __('Status'));
        $grid->column('company_id', __('Company id'));
        $grid->column('service_id', __('Service id'));
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
        $show = new Show(Invoice::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('invoice', __('Invoice'));
        $show->field('description', __('Description'));
        $show->field('price', __('Price'));
        $show->field('status', __('Status'));
        $show->field('order_id', __('Order id'));
        $show->field('company_id', __('Company id'));
        $show->field('service_id', __('Service id'));
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
        $form = new Form(new Invoice());

        $form->text('invoice', __('Invoice'));
        $form->textarea('description', __('Description'));
        $form->decimal('price', __('Price'))->default(0.00);
        $form->select('status', __('Status'))->select([
            'Pending Payment' => 'Pending Payment',
            'Paid' => 'Paid',
        ]);
        $form->number('order_id', __('Order id'));
        $form->number('company_id', __('Company id'));
        $form->number('service_id', __('Service id'));

        return $form;
    }
}
