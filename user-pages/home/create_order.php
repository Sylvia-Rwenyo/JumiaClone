<?php
@session_start();
include_once '../../controls/conn.php';
require '../../vendor/autoload.php';

use Carbon\Carbon;

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the M-Pesa number is provided
    if (isset($_POST["mpesa_phoneNumber"]) && !empty(trim($_POST["mpesa_phoneNumber"]))) {
        // Generate a unique order ID
        $order_id = uniqid("ORDER");

        // Get the M-Pesa number from the form
        $mpesa_number = trim('254' . $_POST["mpesa_phoneNumber"]);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {   

         // Retrieve client information from session
         if (isset($_SESSION['client_info'])) {
            $client_info = $_SESSION['client_info'];
            
            // Extract client information
            $first_name = $client_info['first_name'];
            $last_name = $client_info['last_name'];
            $phone_number = $client_info['phone_number'];
            $additional_phone_number = $client_info['additional_phone_number'];
            $address = $client_info['address'];
            $additional_info = $client_info['additional_info'];
            $region = $client_info['region'];
            $city = $client_info['city'];

// function lipaNaMpesaPassword()
// {
//     //timestamp
//     $timestamp = Carbon::now()->format('YmdHis');
//     //passkey
//     $passKey ="TgM6wrM1M+sPi8GRAIeUDaPoqokZ4pUxIsAbzdGn8iRW/Kbxm7CUgLSP1aK5+83d19kfKcADd/mn3aO7iyMyuUB+VnCoAkwGIKiy1ccJe0UDFsG+kcHrE2xTjwQ8Lx+iVto5ZpvCwMEcgOccyv6qN6LQvgtdOQdYikZQc+f1++iTa6yghiqfWhgar45GgFC2FtlYuXEOGk8ee5cX+TqW8gkfyaUoRVtR0W2i57Ak9ynUje9lALSXqlm4qteCvUp+QqHRcjA/h0dFlARUTHRE6g67zMTTSrD21h9Nah7vHnVUE6IPAKTD8U5Zhl698YqEO0jmPD7a2iBSxBXXQu2OLA==";
//     $businessShortCOde =174379;
//     //generate password
//     $mpesaPassword = base64_encode($businessShortCOde.$passKey.$timestamp);

//     return $mpesaPassword;
// }
    

//    function newAccessToken()
//    {
//        $consumer_key="TCkOpqbWapPTfXnGtmlCvlQCu9QvxWdvJJ1jNbvqNPTvKLhv";
//        $consumer_secret="aMy3rMeDLoArHnpmwJdSPxG8c5h6WaNm65eFhPRUo9p4hYMTQGKokpBTJJGS4bMH";
//        $credentials = "VWpElWE7lRJKSnnJFXV1sR/MAeHZXn634NLq2Q2aKUZ/yuVhuu+hNPETkAi/Z9jevMLT8Z3EHUNC8PdmZ00sgvik4p6S5/Y+ynND4pX2pq60N5jafd4RDfpf/ig5sbl/oEHAm2XBXsUpMtpEdlHiQHMoyCzstw6Hdwk+Yo1qQgXxm6978ct0grB8ik44hKDLmwARpkfIeqffgJ105Tb5eX7ZD6DZlazkUHK44HPjqbjfVyCq7rVvIcX37qPVnukjCx2O1Sp05hywNIac26B8UOs03p5Q91t+DS5SwD6qKstfkQmwKR92VAQ6Xmwh2adYVUbCbEeYm+RXCsNLreacwA==";
//        $url = "https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";


//        $curl = curl_init();
//        curl_setopt($curl, CURLOPT_URL, $url);
//        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Basic ".$credentials,"Content-Type:application/json"));
//        curl_setopt($curl, CURLOPT_HEADER, false);
//        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
//        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//        $curl_response = curl_exec($curl);
//        $access_token=json_decode($curl_response);
//        curl_close($curl);
       
//        return $access_token->access_token;
//    }



//    function stkPush($amount, $first_name, $last_name, $mpesa_number)
//    {
//         $user = $first_name .' '. $last_name;   

//        $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
//        $curl_post_data = [
//             'BusinessShortCode' =>174379,
//             'Password' => lipaNaMpesaPassword(),
//             'Timestamp' =>  Carbon::now()->format('YmdHis'),
//             'TransactionType' => 'CustomerPayBillOnline',
//             'Amount' => $amount,
//             'PartyA' => $mpesa_number,
//             'PartyB' => 174379,
//             'PhoneNumber' => $mpesa_number,
//             'CallBackURL' => 'https://5fc6-2c0f-fe38-2404-734a-c171-a478-6d1-d13f.ngrok-free.app/work/kshan/j-clone/user-pages/home/callback.php',
//             'AccountReference' => "KSHAN Central Agency",
//             'TransactionDesc' => "lipa Na M-PESA"
//         ];


//        $data_string = json_encode($curl_post_data);


//        $curl = curl_init();
//        curl_setopt($curl, CURLOPT_URL, $url);
//        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.newAccessToken()));
//        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($curl, CURLOPT_POST, true);
//        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
//        $curl_response = curl_exec($curl);
//        print_r($curl_response);
//    }

//    stkPush($_SESSION['total_amount'], $first_name, $last_name, $mpesa_number);



   


            // Insert client information into the database
            $insert_client_sql = "INSERT INTO clients (first_name, last_name, phone_number, additional_phone_number, address, additional_information, region, city) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $insert_client_stmt = $conn->prepare($insert_client_sql);
            
            if ($insert_client_stmt) {
                // Bind parameters
                $insert_client_stmt->bind_param("ssssssss", $first_name, $last_name, $phone_number, $additional_phone_number, $address, $additional_info, $region, $city);
                
                // Execute the statement
                if ($insert_client_stmt->execute()) {
                    foreach ($_SESSION['cart'] as $product_id => $quantity){
                    // Insert the order into the database
                    $insert_order_sql = "INSERT INTO orders (order_id, mpesa_phone_number, client_id) VALUES (?, ?, LAST_INSERT_ID())";
                    $insert_order_stmt = $conn->prepare($insert_order_sql);
                    
                    if ($insert_order_stmt) {
                        // Bind parameters
                        $insert_order_stmt->bind_param("ss", $order_id, $mpesa_number);
                        
                        // Execute the statement
                        if ($insert_order_stmt->execute()) {
                            // Loop through each product in the cart and insert into order_items table
                            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                                foreach ($_SESSION['cart'] as $product_id => $quantity) {
                                    // Insert product into order_items table
                                    $insert_item_sql = "INSERT INTO order_items (order_id, product_id, quantity) VALUES (?, ?, ?)";
                                    $insert_item_stmt = $conn->prepare($insert_item_sql);
                                    if ($insert_item_stmt) {
                                        // Bind parameters
                                        $insert_item_stmt->bind_param("sii", $order_id, $product_id, $quantity);
                                        
                                        // Execute the statement
                                        $insert_item_stmt->execute();
                                    }
                                }
                            
                                // Clear the cart and total amount after the order is created
                                unset($_SESSION['cart']);
                                unset($_SESSION['total_amount']);
                                // Redirect to a success page or display a success message
                                header("Location: checkout.php?ordersuccess=1");
                                exit();
                            } else {
                                // Handle empty cart case
                                echo "Cart is empty";
                            }
                        } else {
                            // Handle execution error
                            echo "Error executing order insertion statement: " . $insert_order_stmt->error;
                        }
                    } else {
                        // Handle prepared statement error
                        echo "Error preparing order insertion statement: " . $conn->error;
                    }
                    // Close order statement
                    $insert_order_stmt->close();
                }} else {
                    // Handle execution error
                    echo "Error executing client insertion statement: " . $insert_client_stmt->error;
                }
            } else {
                // Handle prepared statement error
                echo "Error preparing client insertion statement: " . $conn->error;
            }
            // Close client statement
            $insert_client_stmt->close();
        } else {
            // Handle missing client information in session
            echo "Client information is missing";
        }
    } else {
        // Handle missing M-Pesa number
        echo "M-Pesa number is required";
    }
}
}
?>
