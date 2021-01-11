<?php

use App\Http\Controllers\EmailController;
use App\Http\Controllers\PaymentsController;
use App\Jobs\SendEmailJob;
use App\Mail\TestMail3;
use Illuminate\Support\Facades\Mail;
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
    return view('welcome');
});
Route::post('payment/pay', [PaymentsController::class, 'pay'])->name('payment.pay');
// Route::get('email', [EmailController::class, 'show']);
// Route::post('email', [EmailController::class, 'store']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
// Route::get('payments/create', [PaymentsController::class, 'create'])->name('create-payment')->middleware('auth');
// Route::post('payments/create', [PaymentsController::class, 'store'])->middleware('auth');
// Route::post('recharge/create', [PaymentsController::class, 'recharge'])->middleware('auth');
Route::get('/test_queue', function () {

    // Mail::to('abcd@abcd.com')->send(new TestMail3('first topic'));
    $details['command'] = 'test1';
    $details['to'] = 'a@gmail.com';
    SendEmailJob::dispatch($details);

    $details['command'] = 'test2';
    $details['to'] = 'b@gmail.com';
    dispatch(new SendEmailJob($details));

    $details['command'] = 'test3';
    $details['to'] = 'c@gmail.com';
    dispatch(new SendEmailJob($details));

    $details['command'] = 'test1';
    $details['to'] = 'd@gmail.com';
    dispatch(new SendEmailJob($details));

    $details['command'] = 'test2';
    $details['to'] = 'e@gmail.com';
    dispatch(new SendEmailJob($details));

    $details['command'] = 'test3';
    $details['to'] = 'f@gmail.com';
    dispatch(new SendEmailJob($details));

    $details['command'] = 'test1';
    $details['to'] = 'g@gmail.com';
    dispatch(new SendEmailJob($details));

    $details['command'] = 'test2';
    $details['to'] = 'e@gmail.com';
    dispatch(new SendEmailJob($details));

    $details['command'] = 'test3';
    $details['to'] = 'f@gmail.com';
    dispatch(new SendEmailJob($details));

    $details['command'] = 'test1';
    $details['to'] = 'g@gmail.com';
    dispatch(new SendEmailJob($details));

    $details['command'] = 'test2';
    $details['to'] = 'h@gmail.com';
    dispatch(new SendEmailJob($details));

    $details['command'] = 'test3';
    $details['to'] = 'i@gmail.com';
    dispatch(new SendEmailJob($details));

    dd('success');
});
