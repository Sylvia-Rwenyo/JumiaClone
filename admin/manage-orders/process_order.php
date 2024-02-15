<?php
session_start();

include_once '../../controls/conn.php';

// Check if an order ID is provided in the URL
if (isset($_GET['id'])) {
    $orderId = $_GET['id'];

    // Update order status to processed
    $updateSql = "UPDATE orders SET status = 'processed' WHERE order_id = '$orderId'";

    if ($conn->query($updateSql) === TRUE) {
       echo "
        <script>
        window.location.href = 'index.php';
        </script>
        "; 
    } else {
        echo "Error updating order status: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Order ID not provided.";
}
?>
