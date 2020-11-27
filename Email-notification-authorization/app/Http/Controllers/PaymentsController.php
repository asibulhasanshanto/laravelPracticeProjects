<?php

namespace App\Http\Controllers;

use App\Events\ProductPurchased;
use App\Notifications\PaymentReceived;
use App\Notifications\Recharged;
use Faker\Provider\ar_SA\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class PaymentsController extends Controller
{
    public function create()
    {
        return view('dashboard');
    }
    public function store()
    {
        // sending notification by events and listeners
        // =================================================

        // event(new ProductPurchased(request()->user(),500));



        // sending direct notification
        // ===================================
        // request()->user()->notify(new PaymentReceived(500)); // in this way the user model must have to use notifyable trait

        Notification::send(request()->user(), new PaymentReceived(request()->paymentamount));

        return redirect('/dashboard');
    }
    public function recharge()
    {
        // sending notification by events and listeners
        // =================================================

        // event(new ProductPurchased(request()->user(),500));



        // sending direct notification
        // ===================================
        // request()->user()->notify(new PaymentReceived(500)); // in this way the user model must have to use notifyable trait
        Notification::send(request()->user(), new Recharged(request()->rechargeamount));

        return redirect('/dashboard');
    }
}
