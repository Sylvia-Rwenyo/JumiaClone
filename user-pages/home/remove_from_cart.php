<?php
session_start(); // Start the session to access session variables

// Check if the product ID is provided in the URL
if(isset($_GET['id'])) {
    // Get the product ID from the URL
    $product_id = $_GET['id'];

    // Check if the product ID exists in the cart session variable
    if(isset($_SESSION['cart']) && isset($_SESSION['cart'][$product_id])) {
        // Remove the product from the cart session variable
        unset($_SESSION['cart'][$product_id]);

        // Redirect back to the previous page
        header("Location: ".$_SERVER['HTTP_REFERER']);
        exit();
    } else {
        // If the product ID is not found in the cart, redirect to an error page or the homepage
        header("Location: error.php");
        exit();
    }
} else {
    // If the product ID is not provided in the URL, redirect to an error page or the homepage
    header("Location: error.php");
    exit();
}

?>
