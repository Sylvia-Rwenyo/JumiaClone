<?php
//start_session
 @session_start();
//database connection
include_once '../../controls/conn.php';
require '../../vendor/autoload.php';


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the M-Pesa number is provided
    if (isset($_POST["mpesa_phoneNumber"]) && !empty(trim($_POST["mpesa_phoneNumber"]))) {
        // Generate a unique order ID
        $order_id = uniqid("ORDER");
        $_SESSION['order_id'] = $order_id;
        $totalItems = count($_SESSION['cart']);
        $totalPrice = 0;

        // Get the M-Pesa number from the form
        $mpesa_number = trim('254' . $_POST["mpesa_phoneNumber"]);
        $MerchantRequestID = 0;
        $CheckoutRequestID = 0;

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {   
    // Retrieve client information from the database   
    $client_id = $_SESSION['user_id'];
    $clientInfo = false;

    // Check if the client record exists in the client_addresses table
    $checkClientAddressSql = "SELECT * FROM client_addresses WHERE client_id = ?";
    $checkClientAddressStmt = $conn->prepare($checkClientAddressSql);
    $checkClientAddressStmt->bind_param("i", $client_id);
    $checkClientAddressStmt->execute();
    $clientAddressResult = $checkClientAddressStmt->get_result();

    if ($clientAddressResult->num_rows > 0) {
        $clientInfo = true;
    }
    if($clientInfo){
        foreach ($_SESSION['cart'] as $product_id => $quantity){
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
                        $totalPrice += $quantity;
                    }
                } else {
                    // Handle empty cart case
                    echo "Cart is empty";
        } }
        
        // Insert the order into the database
        $insert_order_sql = "INSERT INTO orders (order_id, mpesa_phone_number, client_id, merchant_rq_id, checkout_rq_id, total_items, total_price) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $insert_order_stmt = $conn->prepare($insert_order_sql);
        
        if ($insert_order_stmt) {
            // Bind parameters
            $insert_order_stmt->bind_param("sssssss", $order_id, $mpesa_number, $client_id, $MerchantRequestID, $CheckoutRequestID, $totalItems, $totalPrice);
            
            // Execute the statement
            if (!$insert_order_stmt->execute()) {
            // Handle prepared statement error
            echo "Error preparing order insertion statement: " . $conn->error;
        }else{
            // Clear the cart and total amount after the order is created
            unset($_SESSION['cart']);
            unset($_SESSION['total_amount']);
            // Redirect to existing orders page
            header("Location: existing_orders.php");
            exit();
        }
        // Close order statement
        $insert_order_stmt->close();
    }
// Close client statement
$insert_client_stmt->close();
    }
}
}
}
?>
