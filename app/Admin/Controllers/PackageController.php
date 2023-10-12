<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Package;

class PackageController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Package';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Package());

        $grid->model()->orderBy('id', 'desc');

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('slug', __('Slug'));
        $grid->column('price', __('Price'));
        $grid->column('renewal_price', __('Renewal price'));
        $grid->column('discounted_price', __('Discounted price'));
        $grid->column('features', __('Features'));
        $grid->column('card_badge', __('Card badge'));
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
        $show = new Show(Package::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('slug', __('Slug'));
        $show->field('price', __('Price'));
        $show->field('renewal_price', __('Renewal price'));
        $show->field('discounted_price', __('Discounted price'));
        $show->field('features', __('Features'));
        $show->field('card_badge', __('Card badge'));
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
        $form = new Form(new Package());

        $form->text('name', __('Name'));
        $form->text('slug', __('Slug'));
        $form->decimal('price', __('Price'));
        $form->decimal('renewal_price', __('Renewal price'));
        $form->decimal('discounted_price', __('Discounted price'));
        $form->textarea('features', __('Features'));
        $form->text('card_badge', __('Card badge'));

        return $form;
    }
}
