<?php
//start_session
@session_start();

// Check if the product ID is provided in the URL
if(isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $quantity = 1;

    if(!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Check if the product is already in the cart
    if(isset($_SESSION['cart'][$product_id])) {
        // If it is, update the quantity
        $_SESSION['cart'][$product_id] += $quantity;
    } else {
        // If not, add the product to the cart with its quantity
        $_SESSION['cart'][$product_id] = $quantity;
    }

    // var_dump($_SESSION['cart']);

    // Redirect back to the page where the add to cart button was clicked
    header("Location: ".$_SERVER['HTTP_REFERER']);
    exit();
    // var_dump($_SESSION['cart']);
} else {
    // Redirect to a generic error page if the product ID is not provided
    header("Location: error.php");
    exit();
}
?>
