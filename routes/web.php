<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group([
  'prefix'        => '',
  'namespace'     => config('admin.route.namespace'),
  'middleware'    => config('admin.route.middleware'),
  'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

  Route::get('/{route?}/{subroute?}/{subsubroute?}', [AdminController::class, 'index']);

});