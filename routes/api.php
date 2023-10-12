<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Companies\AddonController;
use App\Http\Controllers\Companies\AddonsController;
use App\Http\Controllers\Companies\CompaniesController;
use App\Http\Controllers\mail\MailController;
use App\Http\Controllers\Orders\InvoicesController;
use App\Http\Controllers\Orders\OrdersController;
use App\Http\Controllers\Orders\ServicesController;
use App\Http\Controllers\Packages\MainPackagesController;
use App\Http\Controllers\Packages\SubPackagesController;
use App\Http\Controllers\Subscriptions\PromoCodesController;
use App\Http\Controllers\Subscriptions\StripePaymentsController;
use App\Http\Controllers\Users\AuthenticationController;
use App\Http\Controllers\Users\PasswordResetController;
use App\Http\Controllers\Users\RegisterationController;
use App\Http\Controllers\Users\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group([
  'prefix' => 'auth',
], function () {
  Route::post('/register', [RegisterationController::class, 'register']);
  Route::post('/login', [AuthenticationController::class, 'login']);
  Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLinkEmail']);
  Route::post('/reset-password', [PasswordResetController::class, 'reset']);
});

Route::group([
  'prefix' => 'users',
], function () {
  Route::group([
    'middleware' => 'auth:sanctum'
  ], function () {
    Route::get('/', [UsersController::class, 'get']);
    Route::put('/', [UsersController::class, 'update']);
  });
  Route::post('/checkEmail', [UsersController::class, 'checkIfEmailUsed']);
});

Route::group([
  'prefix' => 'packages',
], function () {
  Route::get('/main', [MainPackagesController::class, 'get']);
  Route::get('/sub/{package:slug}', [SubPackagesController::class, 'get']);
});

Route::group([
  'prefix' => 'companies',
], function () {
  Route::group([
    'middleware' => 'auth:sanctum'
  ], function () {
    Route::get('/', [CompaniesController::class, 'get']);
    Route::post('/', [CompaniesController::class, 'store']);
  });
  Route::get('/addons', [AddonsController::class, 'get']);
  Route::get('/check/{comapnyName}', [CompaniesController::class, 'checkIfCompanyNamedUsed']);
});

Route::group([
  'prefix' => 'orders',
], function () {
  Route::group([
    'middleware' => 'auth:sanctum'
  ], function () {
    Route::get('/', [OrdersController::class, 'get']);
    Route::get('/services', [ServicesController::class, 'get']);
    Route::put('/services/{service}', [ServicesController::class, 'update']);
    Route::get('/invoices', [InvoicesController::class, 'get']);
  });
  Route::get('/{orderID}', [OrdersController::class, 'show']);
});

Route::group([
  'prefix' => 'mail',
  'middleware' => 'auth:sanctum'
], function () {
  Route::get('/', [MailController::class, 'get']);
});
Route::get('/mail/{file}/download', [MailController::class, 'download'])->name('file.download');

Route::group([
  'prefix' => 'payments',
  'middleware' => 'auth:sanctum'
], function () {
  Route::get('/cards', [StripePaymentsController::class, 'listCards']);
  Route::post('/cards/add', [StripePaymentsController::class, 'addCard']);
  Route::post('/pay', [StripePaymentsController::class, 'subscribe']);
});

Route::group([
  'prefix' => 'promo-codes',
], function () {
  Route::get('/{code:code}', [PromoCodesController::class, 'show']);
  Route::get('/{code:code}/{order}', [PromoCodesController::class, 'apply']);
});

Route::group([
  'prefix' => 'webhooks'
], function () {
  Route::any('/stripe', [StripePaymentsController::class, 'webhook']);
});


Route::post('/admin-orders', [AdminController::class, 'store']);