<?php
//database connection
include_once '../../controls/conn.php'; 

// Check if order_id is provided in the URL
if(isset($_GET['id']) && !empty($_GET['id'])) {
    // Sanitize the order_id to prevent SQL injection
    $order_id = htmlspecialchars($_GET['id']);

    // Update order status to processed
    $updateSql = "UPDATE orders SET status = 'cancelled' WHERE order_id = '$order_id'";

    if ($conn->query($updateSql) === TRUE) {
        header("Location: ".$_SERVER['HTTP_REFERER']); 
    } else {
        echo "Error updating order status: " . $conn->error;
    }

    // Close the database connection
    //close database connection 
    $conn->close();
} else {
    echo "Order ID not provided.";
}
?>
