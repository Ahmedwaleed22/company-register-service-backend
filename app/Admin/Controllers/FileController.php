<?php

namespace App\Admin\Controllers;

use App\Mail\OrderCompletedMail;
use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\File;
use Illuminate\Support\Facades\Mail;

class FileController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'File';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new File());

        $grid->model()->orderBy('id', 'desc');

        $grid->filter(function($filter){
            // Remove the default id filter
            $filter->disableIdFilter();
        
            // Add a column filter
            $filter->like('order_id');
        });

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('description', __('Description'));
        $grid->column('path', __('Path'))->downloadable();
        $grid->column('order_id', __('Order id'));
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
        $show = new Show(File::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('description', __('Description'));
        $show->field('path', __('Path'));
        $show->field('order_id', __('Order id'));
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
        $form = new Form(new File());

        $form->saved(function (Form $form) {
            if (strtolower($form->model()->order->status) === 'pending') {
                $order = $form->model()->order;
                $order->status = 'completed';
                $order->save();

                $user = $order->user;

                Mail::to($form->model()->order->user)->send(new OrderCompletedMail($order, $order->company, $user, $order->service, $order->package, $form->model()->path));
            }
        });

        $form->text('name', __('Name'));
        $form->textarea('description', __('Description'));
        $form->multipleFile('path', __('Files'));
        $form->number('order_id', __('Order id'));

        return $form;
    }
}
