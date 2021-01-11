<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container container-fluid container-sm">
        <form
        class="email-form"
        method="POST"
        action="/payments/create"
        >
        <input type="number" name="paymentamount" id="">
        @csrf
            <button type="submit" class="btn btn-primary email">make payments</button>
          </form>
    </div>
    <div class="container container-fluid container-sm">
        <form
        class="email-form"
        method="POST"
        action="/recharge/create"

        >
        <input type="number" name="rechargeamount" id="">
        @csrf
            <button type="submit" class="btn btn-primary email">Recharge</button>
          </form>
    </div>
    <div>
        
    </div>
</x-app-layout>
