<?php
session_start();

// Check if the form data is submitted using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $phoneNumber = $_POST['phone_number'];
    $additionalPhoneNumber = $_POST['additional_phone_number'];
    $address = $_POST['address'];
    $additionalInfo = $_POST['additional_info'];
    $region = $_POST['region'];
    $city = $_POST['city'];

    // Store the form data in session variables
    $_SESSION['client_info'] = array(
        'first_name' => $firstName,
        'last_name' => $lastName,
        'phone_number' => $phoneNumber,
        'additional_phone_number' => $additionalPhoneNumber,
        'address' => $address,
        'additional_info' => $additionalInfo,
        'region' => $region,
        'city' => $city
    );

    // redirect to checkout.php
    echo "<script>window.location.href = 'checkout.php#delivery-info';</script>";
    exit(); 
}
?>
