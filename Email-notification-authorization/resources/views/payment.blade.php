<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- 2Checkout JavaScript library -->
<script src="https://www.2checkout.com/checkout/api/2co.min.js"></script>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="col-xs-12 col-md-12">
                            <div class="panel panel-default">
                              <div class="panel-heading">
                                <h3 class="panel-title">Charge $10 USD with 2Checkout</h3>
                              </div>
                              <div class="panel-body">
                                <!-- display errors returned by createToken -->
                                <p class="payment-status"></p>
                                <form id="paymentForm" method="post" action="{{route('payment.pay')}}">
                                    @csrf

                                  <div class="form-group">
                                    <label>NAME</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" required="" autofocus="" value="John Doe">
                                  </div>
                                  <div class="form-group">
                                    <label>EMAIL</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" required="" value="asibul@hosen.com">
                                  </div>
                                  <div class="form-group">
                                    <label>CARD NUMBER</label>
                                    <input type="text" class="form-control" name="card_num" id="card_num" placeholder="Enter card number" autocomplete="off" required="" value="5555555555554444">
                                  </div>
                                  <div class="d-flex flex-column justify-content-center align-items-center">
                                    <div class="col-xs-4">
                                      <div class="form-group">
                                        <label style="display: block;">EXPIRY DATE</label>
                                        <div class="col-xs-6">
                                          <input type="number" name="exp_month" id="exp_month" class="form-control" style="padding: 6px 10px;" placeholder="MM" required="" value="10">
                                        </div>
                                        <div class="col-xs-6">
                                          <input type="number" name="exp_year" id="exp_year" class="form-control" style="padding: 6px 10px;" placeholder="YY" required="" value="2021">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-xs-4 float-right">
                                      <div class="form-group">
                                        <label>CVV</label>
                                        <input type="number" name="cvv" id="cvv" class="form-control" autocomplete="off" required="" value="123">
                                      </div>
                                    </div>
                                  </div>

                                  <!-- hidden token input -->
                                  <input id="token" name="token" type="hidden" value="">

                                  <!-- submit button -->
                                  <input type="submit" class="btn btn-success btn-lg btn-block" value="Submit Payment">
                                </form>
                              </div>
                            </div>
                          </div>
                    </div>
                </div>
            </div>
            <script>
                // Called when token created successfully.
                var successCallback = function(data) {
                  var payForm = document.getElementById('paymentForm');

                  // Set the token as the value for the token input
                  payForm.token.value = data.response.token.token;

                  // Submit the form
                  payForm.submit();
                };

                // Called when token creation fails.
                var errorCallback = function(data) {
                  if (data.errorCode === 200) {
                    tokenRequest();
                  } else {
                    alert(data.errorMsg);
                  }
                };

                var tokenRequest = function() {
                  // Setup token request arguments
                  var args = {
                    sellerId: "250613669231", //sandbox-seller-id is (Account Number
                    publishableKey: "17463AB7-FA18-42ED-855E-360E992C4B0A", //sandbox-publishable-key is (Publishable Key)
                    ccNo: $("#card_num").val(),
                    cvv: $("#cvv").val(),
                    expMonth: $("#exp_month").val(),
                    expYear: $("#exp_year").val()
                  };

                  // Make the token request
                  TCO.requestToken(successCallback, errorCallback, args);
                };

                $(function() {

                  // Pull in the public encryption key for our environment
                  TCO.loadPubKey('17463AB7-FA18-42ED-855E-360E992C4B0A');

                  $("#paymentForm").submit(function(e) {
                    // Call our token request function
                    tokenRequest();

                    // Prevent form from submitting
                    return false;
                  });
                });
              </script>
        </main>
    </div>
</body>
</html>


