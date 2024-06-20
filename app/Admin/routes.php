<?php

use Illuminate\Routing\Router;
use App\Admin\Controllers\OrderDetailController;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('users', UserMixueController::class);
    $router->resource('products', ProductsController::class);
    $router->resource('restaurants', RestaurantController::class);
    $router->resource('staff', NhanVienController::class);
    $router->resource('orders', OrdersController::class);
    $router->resource('order-details', OrderDetailController::class);
    $router->resource('chart', \App\Admin\Controllers\ChartjsController::class);
});
