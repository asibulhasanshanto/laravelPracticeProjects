@extends('layouts.app')

@section('content')
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
@endsection
