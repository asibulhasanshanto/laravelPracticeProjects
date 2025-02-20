<?php

namespace App\Http\Controllers;
use App\Models\Payment;
use Illuminate\Http\Request;
use Twocheckout;
use Twocheckout_Charge;
use Twocheckout_Error;

// require_once('app/2checkout-php/lib/Twocheckout.php');


class PaymentController extends Controller
{
    public function pay(Request $request)
    {
        // dd($request);
        // Token info
        $token  = $request->token;

        // Card info
        $card_num = $request->card_num;
        $card_cvv = $request->cvv;
        $card_exp_month = $request->exp_month;
        $card_exp_year = $request->exp_year;


        // Buyer info
        $name = $request->name;
        $email = $request->email;
        $phoneNumber = '555-555-5555';
        $addrLine1 = '123 Test St';
        $city = 'Columbus';
        $state = 'OH';
        $zipCode = '43123';
        $country = 'USA';

        // Item info
        $itemName = 'Premium Script tutorialswebsite';
        $itemNumber = 'TWPS235';
        $itemPrice = '10.00';
        $currency = 'USD';
        $orderID = 'SKA92712382139';
        // Include 2Checkout PHP library
        // include( base_path().'app/2checkout-php/lib/Twocheckout.php');
        // require_once('app/2checkout-php/lib/Twocheckout.php');
        Twocheckout::privateKey('3457A21E-81F2-4A6C-B488-A768AA534852');
        Twocheckout::sellerId('250613669231');
        Twocheckout::verifySSL(false);

        try {
            // Charge a credit card
            $charge = Twocheckout_Charge::auth(array(
                "merchantOrderId" => $orderID,
                "token"      => $token,
                "currency"   => $currency,
                "total"      => $itemPrice,
                "billingAddr" => array(
                    "name" => $name,
                    "addrLine1" => $addrLine1,
                    "city" => $city,
                    "state" => $state,
                    "zipCode" => $zipCode,
                    "country" => $country,
                    "email" => $email,
                    "phoneNumber" => $phoneNumber
                ),
                "demo"=> true
            )); // Check whether the charge is successful
            if ($charge['response']['responseCode'] == 'APPROVED') {

                // Order details
                $orderNumber = $charge['response']['orderNumber'];
                $total = $charge['response']['total'];
                $transactionId = $charge['response']['transactionId'];
                $currency = $charge['response']['currencyCode'];
                $status = $charge['response']['responseCode'];

                // // Include database config file
                // include_once 'dbconfig.php';

                // // Insert order info to database
                // $sql = "INSERT INTO order_transaction(name, email, card_num, card_cvv, card_exp_month, card_exp_year, item_name, item_number, item_price, currency, paid_amount, order_number, txn_id, payment_status, created, modified) VALUES('".$name."', '".$email."', '".$card_num."', '".$card_cvv."', '".$card_exp_month."', '".$card_exp_year."', '".$itemName."', '".$itemNumber."','".$itemPrice."', '".$currency."', '".$total."', '".$orderNumber."', '".$transactionId."', '".$status."', NOW(), NOW())";
                // $insert = $db->query($sql);
                // $insert_id = $db->insert_id;

                $statusMsg = '<h2>Thanks for your Order!</h2>';
                $statusMsg .= '<h4>The transaction was successful. Order details are given below:</h4>';
                // $statusMsg .= "<p>Order ID: {$insert_id}</p>";
                $statusMsg .= "<p>Order Number: {$orderNumber}</p>";
                $statusMsg .= "<p>Transaction ID: {$transactionId}</p>";
                $statusMsg .= "<p>Order Total: {$total} {$currency}</p>";
            }
        } catch (Twocheckout_Error $e) {
            $statusMsg = '<h2>Transaction failed!</h2>';
            $statusMsg .= '<p>'.$e->getMessage().'</p>';
        }

        dd($statusMsg);
    }
}
