<?php

namespace App\Listeners;

use App\Events\ProductPurchased;
use App\Notifications\PaymentReceived;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendPurchasedMail
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PeoductPurchased  $event
     * @return void
     */
    public function handle(ProductPurchased $event)
    {
        $user = $event->user;
        $amount = $event->amount;
        $user->notify(new PaymentReceived($amount));
    }
}
