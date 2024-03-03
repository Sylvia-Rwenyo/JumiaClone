<?php
    include_once '../../controls/conn.php';
    echo '<a href="../../">Home<br /></a>';

    $content = file_get_contents('php://input'); // Receives the JSON Result from Safaricom
    $res = json_decode($content, true); // Convert the JSON to an array 

    // Sanitize data if necessary

    $dataToLog = array(
        date("Y-m-d H:i:s"), // Date and time
        " MerchantRequestID: ".$res['Body']['stkCallback']['MerchantRequestID'],
        " CheckoutRequestID: ".$res['Body']['stkCallback']['CheckoutRequestID'],
        " ResultCode: ".$res['Body']['stkCallback']['ResultCode'],
        " ResultDesc: ".$res['Body']['stkCallback']['ResultDesc'],
        " MpesaReceiptNumber: ".$res['Body']['stkCallback']['CallbackMetadata']['Item'][1]['Value'],
    );

    $data = implode(" - ", $dataToLog) . PHP_EOL;
    file_put_contents('mpesastk_log', $data, FILE_APPEND); // Create a txt file and log the results to our log file

    // Function to execute SQL queries
    function execute_query($query) {
        global $conn;
        $result = mysqli_query($conn, $query);
        if ($result) {
            return $result;
        } else {
            file_put_contents('error_log', "Error executing query: " . mysqli_error($conn), FILE_APPEND);
            return false;
        }
    }

    // Get the last record from orders table
    $query = "SELECT * FROM orders WHERE created_at = (SELECT MAX(created_at) FROM orders)";
    $result = execute_query($query);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $mpesastk_id = $row['mpesastk_id'];
        $app_id = $row['mpesastk_appid'];
        $ResultCode = $res['Body']['stkCallback']['ResultCode'];
        $ResultDesc = $res['Body']['stkCallback']['ResultDesc'];
        $MpesaReceiptNumber = $res['Body']['stkCallback']['CallbackMetadata']['Item'][1]['Value'];

        $mpesastk_status = $res['Body']['stkCallback']['ResultCode'] == '1032' ? '0' : '1';

        // Update mpesastk table
        $update_query = "UPDATE mpesastk SET mpesastk_status = '$mpesastk_status', ResultCode = '$ResultCode',
            ResultDesc = '$ResultDesc', MpesaReceiptNumber = '$MpesaReceiptNumber' WHERE mpesastk_id = $mpesastk_id";
        $update_rs = execute_query($update_query);

        if ($update_rs) {
            file_put_contents('error_log', "Records Inserted", FILE_APPEND);
        } else {
            file_put_contents('error_log', "Failed to insert Records", FILE_APPEND);
        }
    } else {
        file_put_contents('error_log', "No records found in the orders table", FILE_APPEND);
    }

    // Now update a different table in the database
    // Not the $app_id as set in the submit :)
    if ($res['Body']['stkCallback']['ResultCode'] != '1032') {
        $asql_query = "UPDATE tblX SET tblX_status = '3' WHERE tblX_id = $app_id";
        $ars = execute_query($asql_query);

        if (!$ars) {
            file_put_contents('error_log', "Failed to update tblX", FILE_APPEND);
        }
    }
?>
