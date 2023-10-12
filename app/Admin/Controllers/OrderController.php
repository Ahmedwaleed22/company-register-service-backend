<?php

namespace App\Admin\Controllers;

use App\Mail\SupportCreatedOrderEmail;
use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Order;
use App\Models\SubPackage;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\MessageBag;
use OpenAdmin\Admin\Widgets\Table;

class OrderController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Order';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Order());

        $grid->model()->orderBy('id', 'desc');

        $grid->filter(function($filter){
            // Remove the default id filter
            $filter->disableIdFilter();
        
            // Add a column filter
            $filter->where(function ($query) {
                $query->where('id', 'like', "%{$this->input}%")
                    ->orWhere('user_id', 'like', "%{$this->input}%")
                    ->orWhere('status', 'like', "%{$this->input}%");
            }, 'Order ID or User ID or Status');
        });

        $grid->column('id', __('Order ID'));
        $grid->column('invoiced', __('Date of Order'));
        $grid->column('package_id', __('Package id'));
        $grid->column('description', __('Description'));
        $grid->column('status', __('Status'));
        $grid->column('user_id', __('User id'));
        $grid->column('total_price', __('Total Price'));
        $grid->column('base_price', __('Base Price'));
        $grid->column('renewal_price', __('Renewal Price'));
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
        $show = new Show(Order::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('invoiced', __('Date of Order'));
        $show->field('package_id', __('Package id'));
        $show->field('description', __('Description'));
        $show->field('status', __('Status'));
        $show->field('user_id', __('User id'));
        $show->field('total_price', __('Total Price'));
        $show->field('base_price', __('Base Price'));
        $show->field('renewal_price', __('Renewal Price'));
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
        $form = new Form(new Order());

        
        $form->saved(function ($form) {
            $success = new MessageBag([
                'title'   => 'Saved',
                'message' => 'Order Updated Successfully. OrderID: ' . $form->model()->id,
            ]);
            
            if (strtolower($form->model()->status) === 'canceled' || strtolower($form->model()->status) === 'refunded') {
                if ($form->model()->service->stripe_subscription_id) {
                    $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));
                    $stripe->subscriptionSchedules->cancel(
                        $form->model()->service->stripe_subscription_id,
                        []
                    );
                }
            }

            return back()->with(compact('success'));
        });

        $form->date('invoiced', __('Date of Order'));
        $form->select('package_id', __('Sub Package'))->options(SubPackage::all()->pluck('name', 'id'));
        $form->text('description', __('Description'));
        $form->select('status', __('Status'))->options([
            'Pending' => 'Pending',
            'Processing' => 'Processing',
            'Completed' => 'Completed',
            'Refunded' => 'Refunded',
            'Canceled' => 'Canceled',
            'Wise Processing' => 'Wise Processing',
            'Stripe Processing' => 'Stripe Processing',
            'Addons Processing' => 'Addons Processing',
        ]);
        $form->number('user_id', __('User id'));
        $form->decimal('total_price', __('Total Price'));
        $form->decimal('base_price', __('Base Price'));
        $form->decimal('renewal_price', __('Renewal Price'));

        return $form;
    }
}
