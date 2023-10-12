<?php

namespace App\Admin\Controllers;

use App\Models\Package;
use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\SubPackage;

class SubPackageController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'SubPackage';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new SubPackage());

        $grid->model()->orderBy('id', 'desc');

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('discounted_price', __('Discounted price'));
        $grid->column('renewal_price', __('Renewal price'));
        $grid->column('features', __('Features'));
        $grid->column('package_id', __('Package'));
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
        $show = new Show(SubPackage::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('discounted_price', __('Discounted price'));
        $show->field('renewal_price', __('Renewal price'));
        $show->field('features', __('Features'));
        $show->field('package_id', __('Package id'));
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
        $form = new Form(new SubPackage());

        $form->text('name', __('Name'));
        $form->decimal('discounted_price', __('Discounted price'));
        $form->decimal('renewal_price', __('Renewal price'));
        $form->textarea('features', __('Features'));
        $form->select('package_id', __('Package'))->options(Package::all()->pluck('name', 'id'));

        return $form;
    }
}
