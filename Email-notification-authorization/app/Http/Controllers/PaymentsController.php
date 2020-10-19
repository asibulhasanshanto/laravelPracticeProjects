<?php

namespace App\Http\Controllers;

use App\Notifications\PaymentReceived;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class PaymentsController extends Controller
{
    public function create()
    {
        return view('notifications.create');
    }
    public function store()
    {
        request()->user()->notify(new PaymentReceived(500)); // in this way the user model must have to use notifyable trait

        // Notification::send(request()->user(), new PaymentReceived());

        return redirect('/payments/create');
    }
}
