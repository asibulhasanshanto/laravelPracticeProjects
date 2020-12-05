<?php

use App\Http\Controllers\EmailController;
use App\Http\Controllers\PaymentsController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('payment');
});
Route::post('payment/pay',[PaymentsController::class,'pay'])->name('payment.pay');
// Route::get('email', [EmailController::class, 'show']);
// Route::post('email', [EmailController::class, 'store']);

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
// Route::get('payments/create', [PaymentsController::class, 'create'])->name('create-payment')->middleware('auth');
// Route::post('payments/create', [PaymentsController::class, 'store'])->middleware('auth');
// Route::post('recharge/create', [PaymentsController::class, 'recharge'])->middleware('auth');
