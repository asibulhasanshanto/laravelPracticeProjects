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


Route::get('product', function () {
    $products = Product::all();
    return view('ajax.index')->with('products', $products);
});
Route::get('/{product_id}', function ($product_id) {
    $product = Product::find($product_id);
    return response()->json($product);
});
Route::post('/product', function (Request $request) {
    $product = Product::create($request->input());
    return response()->json($product);
});
Route::put('/{product_id?}', function (Request $request, $product_id) {
    $product = Product::find($product_id);
    $product->name = $request->name;
    $product->details = $request->details;
    $product->save();
    return response()->json($product);
});
Route::delete('/{product_id?}', function ($product_id) {
    $product = Product::destroy($product_id);
    return response()->json($product);
});


// Route::get('/', 'App\Http\Controllers\TestController@index');

// Route::resource('todo', 'App\Http\Controllers\CrudController');

//Ajax Crud Laravel

// Route::resource('ajax-crud', 'App\Http\Controllers\AjaxController');
