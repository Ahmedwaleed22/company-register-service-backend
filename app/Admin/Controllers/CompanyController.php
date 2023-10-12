<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Company;

class CompanyController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Company';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Company());

        $grid->model()->orderBy('id', 'desc');

        $grid->filter(function($filter){
            // Remove the default id filter
            $filter->disableIdFilter();
        
            // Add a column filter
            $filter->where(function ($query) {
                $query->where('order_id', 'like', "%{$this->input}%")
                    ->orWhere('id', 'like', "%{$this->input}%")
                    ->orWhere('name', 'like', "%{$this->input}%")
                    ->orWhere('number', 'like', "%{$this->input}%")
                    ->orWhere('auth_code', 'like', "%{$this->input}%")
                    ->orWhere('registered_office', 'like', "%{$this->input}%");
            }, 'Order ID, ID, Name, Number, Auth Code, Registered Office');
        });

        $grid->column('order_id', __('Order ID'));
        $grid->column('id', __('Id'));
        $grid->column('name', __('Company Name'));
        $grid->column('country', __('Country'));
        $grid->column('activities', __('Activities'));
        $grid->column('number', __('Number'));
        $grid->column('auth_code', __('Auth code'));
        $grid->column('registered_office', __('Registered office'));
        $grid->column('company_creator_share_holds', __('Company Creator Share Holds'));
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
        $partnersDetails = Company::with('partners')
        ->where('id', $id)
        ->firstOrFail()->partners;
        $show = new Show(Company::findOrFail($id));
        
        $show->field('order_id', __('Order ID'));
        $show->field('id', __('Id'));
        $show->field('name', __('Company Name'));
        $show->field('country', __('Country'));
        $show->field('activities', __('Activities'));
        $show->field('number', __('Number'));
        $show->field('auth_code', __('Auth code'));
        $show->field('registered_office', __('Registered office'));
        $show->field('company_creator_share_holds', __('Company Creator Share Holds'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        $show->field("Partners", "Partners")->unescape()->as(function ($partners) use ($partnersDetails) {
            $partnerDetails = "";

            foreach ($partnersDetails as $key => $partner) {
                $partnerDetails .= "<div style='margin-bottom: 1em'>";
                $partnerDetails .= "<h2>Partner " . strval(++$key) . "</h2>";
                $partnerDetails .= "<b>First Name</b>: " . $partner->first_name . "<br>";
                $partnerDetails .= "<b>Last Name</b>: " . $partner->last_name . "<br>";
                $partnerDetails .= "<b>E-Mail</b>: " . $partner->email . "<br>";
                $partnerDetails .= "<b>Nationality</b>: " . $partner->country . "<br>";
                $partnerDetails .= "<b>City</b>: " . $partner->city . "<br>";
                $partnerDetails .= "<b>Address</b>: " . $partner->address . "<br>";
                $partnerDetails .= "<b>Whatsapp Number</b>: " . $partner->whatsapp_number . "<br>";
                $partnerDetails .= "<b>Date of Birth</b>: " . $partner->dob . "<br>";
                $partnerDetails .= "<b>Shareholds</b>: " . $partner->share_holds . "<br>";
                $partnerDetails .= "<b>Passport</b>: <img src='" . $partner->passport . "' /><br>";
                $partnerDetails .= "</div>";
            }

            return "<div>{$partnerDetails}</div>";
       });

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Company());

        $form->text('name', __('Company Name'));
        $form->select('country', __('Country'))->options([
            'uk' => 'UK',
            'usa' => 'USA',
            'canada' => 'Canada',
        ]);
        $form->textarea('activities', __('Activities'));
        $form->text('number', __('Number'));
        $form->text('auth_code', __('Auth code'));
        $form->textarea('registered_office', __('Registered office'));
        $form->number('order_id', __('Order ID'));
        $form->number('company_creator_share_holds', __('Company Creator Share Holds'));

        return $form;
    }
}
