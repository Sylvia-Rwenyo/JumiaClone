<?php
session_start();

// Check if productId and quantity are provided in the POST request
if(isset($_POST['productId']) && isset($_POST['quantity'])) {
    $productId = $_POST['productId'];
    $quantity = $_POST['quantity'];

    // Check if the cart session variable exists
    if(isset($_SESSION['cart'])) {
        // Update the quantity of the product in the cart session variable
        $_SESSION['cart'][$productId] = $quantity;
        
        // Send success response
        echo json_encode(['success' => true]);
    } else {
        // Cart session variable does not exist, handle error
        echo json_encode(['success' => false, 'message' => 'Cart session variable does not exist']);
    }
} else {
    // productId or quantity not provided, handle error
    echo json_encode(['success' => false, 'message' => 'productId or quantity not provided']);
}
?>
