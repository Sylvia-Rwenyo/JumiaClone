<?php
include_once '../../controls/conn.php';

if(isset($mpesa_number)){
        $app_id = mysqli_real_escape_string($conn, $_POST['app_id']);// Value to be updated in a different table during the mpesa callback url process.
        $amount = '1'; //Amount to be paid
        $phone = mysqli_real_escape_string($conn, $_POST['pay_phone']); //Phone Number

        $config = array(
            "env"              => "sandbox",
            "BusinessShortCode"=> "174379",
            "key"              => "TCkOpqbWapPTfXnGtmlCvlQCu9QvxWdvJJ1jNbvqNPTvKLhv", //Enter your consumer key here
            "secret"           => "aMy3rMeDLoArHnpmwJdSPxG8c5h6WaNm65eFhPRUo9p4hYMTQGKokpBTJJGS4bMH", //Enter your consumer secret here
            "username"         => "apitest",
            "TransactionType"  => "CustomerPayBillOnline",
            "passkey"          => "MSBrScqgoDumkS5TCRgh3c63BOkoLcScFVuTrOnJr8nHZkrsbHpA0qPP1gMn5k4k7ghztZg0g5TikwIkkcELvEgE7UHZ/p7H5Yu+OSyLm0BLECh7E7z8dSwl1mYoXX5S5f4fSt6JUIFX0ZQvbXVixbXoV3KE/pa6KG09GAfeLnq7Y4H/ib5dfFHbbrSgIQJvYi7OUXqrjI8TMvQUEuaVCbIM5VAIep4NJXSsNmzxUQD0C2ZPhkXAIl7Ew94Chl1sEv3i4HVV2Uw7i9tWVcMML4r3D+ETA5JNkkA8bIMg19e1vG9RrlAocvksi+yObO091GTsOUxSeGf9e0WMJ6jvMw==", //Enter your passkey here
            "CallBackURL"      => "https://3051-154-159-252-110.ngrok-free.app/work/E-Shop/userpages/home/callback.php", //Must have SSL When using localhost, Use Ngrok to forward the response to your Localhost
            "AccountReference" => "Jumia Clone Central Agency",
            "TransactionDesc"  => "Payment of order ",
        );
        
        $phone = $mpesa_number;

        
        $access_token = ($config['env']  == "live") ? "https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials" : "https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials"; 
        //$access_token = "https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials"; 
        $credentials = base64_encode($config['key'] . ':' . $config['secret']); 
        
        $ch = curl_init($access_token);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Basic " . $credentials]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
        $response = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($response); 
        $token = isset($result->{'access_token'}) ? $result->{'access_token'} : "N/A";
    
        $timestamp = date("YmdHis");
        $password  = base64_encode($config['BusinessShortCode'] . "" . $config['passkey'] ."". $timestamp);
    
        $curl_post_data = array( 
            "BusinessShortCode" => $config['BusinessShortCode'],
            "Password" => $password,
            "Timestamp" => $timestamp,
            "TransactionType" => $config['TransactionType'],
            "Amount" => $amount,
            "PartyA" => $phone,
            "PartyB" => $config['BusinessShortCode'],
            "PhoneNumber" => $phone,
            "CallBackURL" => $config['CallBackURL'],
            "AccountReference" => $config['AccountReference'],
            "TransactionDesc" => $config['TransactionDesc'],
        ); 
    
        $data_string = json_encode($curl_post_data);
    
        //$endpoint = "https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest"; 
        $endpoint = ($config['env'] == "live") ? "https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest" : "https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest"; 

    
        $ch = curl_init($endpoint );
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer '.$token,
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response     = curl_exec($ch);
        curl_close($ch);
    
        $result = json_decode(json_encode(json_decode($response)), true);
    
        if(!preg_match('/^[0-9]{10}+$/', $phone) && array_key_exists('errorMessage', $result)){
            $errors['phone'] = $result["errorMessage"];
        }

        if($result['ResponseCode'] === "0"){
            $MerchantRequestID = $result['MerchantRequestID'];
            $CheckoutRequestID = $result['CheckoutRequestID'];
            echo 'mpesa transaction successful';
        }else{
            echo 'mpesa transaction failed';
        }
    }
?>