<?php
//start_session
 @session_start();
 
//database connection
include_once '../../controls/conn.php';
echo '<a href="index.php"<br/></a>';

    $content = file_get_contents('php://input');
    $res = json_decode($content, true);

    $dataToLog = array(
        date("Y-m-d H:I:s"),
        "MerchantRequestID: " .$res['Body']['stkCallback']['MerchantRequestID'],
        "CheckoutRequestID: " .$res['Body']['stkCallback']['CheckoutRequestID'],
        "ResultCode: " .$res['Body']['stkCallback']['ResultCode'],
        "ResultDesc: " .$res['Body']['stkCallback']['ResultDesc'],
    );

    $order_id = $_SESSION['order_id'];

    $stmt = $conn->prepare("SELECT * FROM orders where order_id = ?");
                    $row = [];
                    
                    // Bind the parameter and execute the statement
                    $stmt->bind_param("s", $order_id);
                    $stmt->execute();
                    
                    // Get the result
                    $ordersResult = $stmt->get_result();
                    
                    if ($ordersResult->num_rows > 0) {
                        // Fetch the row from the result set
                        $row = $ordersResult->fetch_assoc();  
                    }

    foreach($rows as $row){
        $ID = $row['order_id'];

        if($res['Body']['stkCallback']['ResultCode'] == 1032){
            $sql = $conn->prepare("UPDATE orders SET status = 'cancelled' where order_id = ?");
                    $row = [];
                    
                    // Bind the parameter and execute the statement
                    $sql->bind_param("s", $order_id);
                    $rs = $sql->execute();
        }
        if($rs){
            file_put_contents('error_log', "Record Inserted", FILE_APPEND);
        }else{
            file_put_contents('error_log', "Failed to insert Record ", FILE_APPEND);
        }
    }
    ?>