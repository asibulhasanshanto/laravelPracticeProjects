
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="container container-fluid container-sm">
            <form
            class="email-form"
            method="POST"
            action="/payments/create"
            >
            @csrf
                <button type="submit" class="btn btn-primary email">make payments</button>
              </form>
        </div>
    </div>
</x-app-layout>
