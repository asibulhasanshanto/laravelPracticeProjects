<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('product', 'App\Http\Controllers\ProductController');
// Route::get('product', '');
// Route::get('product/{product_id}', function ($product_id) {

// });
// Route::post('product', function (Request $request) {

// });
// Route::put('product/{product_id?}', function (Request $request, $product_id) {

// });
// Route::delete('product/{product_id?}', function ($product_id) {

// });


// Route::get('/', 'App\Http\Controllers\TestController@index');

// Route::resource('todo', 'App\Http\Controllers\CrudController');

//Ajax Crud Laravel

// Route::resource('ajax-crud', 'App\Http\Controllers\AjaxController');
