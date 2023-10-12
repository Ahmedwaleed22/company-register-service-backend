<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('packages', PackageController::class);
    $router->resource('sub-packages', SubPackageController::class);
    $router->resource('companies', CompanyController::class);
    $router->resource('orders', OrderController::class);
    $router->resource('users', UserController::class);
    $router->resource('partners', PartnerController::class);
    $router->resource('files', FileController::class);
    $router->resource('addons', AddonController::class);
    $router->resource('invoices', InvoiceController::class);
    $router->resource('services', ServiceController::class);
    $router->resource('promo-codes', PromoCodeController::class);

});
