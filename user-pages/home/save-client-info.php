<?php
//start_session
 @session_start();
//database connection
include_once '../../controls/conn.php';
// Include the Composer autoload file
require_once '../../vendor/autoload.php';

// Retrieve the form data and store it in variables
$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];
$phoneNumber = $_POST['phone_number'];
$additionalPhoneNumber = $_POST['additional_phone_number'];
$address = $_POST['address'];
$additionalInfo = $_POST['additional_info'];
$area = $_POST['area'];
$city = $_POST['city'];

// Check if $phoneNumber does not begin with '+254'
if (substr($phoneNumber, 0, 4) !== '+254') {
    // Prepend '+254' to $phoneNumber
    $phoneNumber = '+254' . $phoneNumber;
}

// Check if $additionalPhoneNumber does not begin with '+254'
if (substr($additionalPhoneNumber, 0, 4) !== '+254') {
    // Prepend '+254' to $additionalPhoneNumber
    $additionalPhoneNumber = '+254' . $additionalPhoneNumber;
}


// Store the form data in session variables
$_SESSION['client_info'] = array(
    'first_name' => $firstName,
    'last_name' => $lastName,
    'phone_number' => $phoneNumber,
    'additional_phone_number' => $additionalPhoneNumber,
    'address' => $address,
    'additional_info' => $additionalInfo,
    'area' => $area,
    'city' => $city
);

$address_id = uniqid('ADDRESS');

$client_id = $_SESSION['user_id'];

// Check if the client record exists in the client_addresses table
$checkClientAddressSql = "SELECT * FROM client_addresses WHERE client_id = ?";
$checkClientAddressStmt = $conn->prepare($checkClientAddressSql);
$checkClientAddressStmt->bind_param("i", $client_id);
$checkClientAddressStmt->execute();
$clientAddressResult = $checkClientAddressStmt->get_result();

if ($clientAddressResult->num_rows > 0) {
    // Prepare the SQL statement for updating client information
    $updateSql = "UPDATE client_addresses 
                  SET first_name = ?, 
                      last_name = ?, 
                      phone_number = ?, 
                      additional_phone_number = ?, 
                      address = ?, 
                      additional_information = ?, 
                      area = ?, 
                      city = ? 
                  WHERE client_id = ?";

    // Prepare and execute the update statement
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param("ssssssssi", $firstName, $lastName, $phoneNumber, $additionalPhoneNumber, $address, $additionalInfo, $area, $city, $client_id);
    
    if ($stmt->execute()) {
        // Redirect 
        header("Location: {$_SERVER['HTTP_REFERER']}?success=1");
        exit();
    } else {
        // Update failed
        echo "Error updating client information: " . $conn->error;
    }
} else {
    // Insert client information into the database
    $insertClientSql = "INSERT INTO client_addresses (first_name, last_name, phone_number, additional_phone_number, address, additional_information, area, city, client_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $insertClientStmt = $conn->prepare($insertClientSql);
                    
    if ($insertClientStmt) {
        // Bind parameters
        $insertClientStmt->bind_param("ssssssssi", $firstName, $lastName, $phoneNumber, $additionalPhoneNumber, $address, $additionalInfo, $area, $city, $client_id);
                        
        // Execute the statement
        if ($insertClientStmt->execute()) {
            // Redirect 
            header("Location: {$_SERVER['HTTP_REFERER']}?success=1");
            exit();
        } else {
            // Insert failed
            echo "Error inserting client information: " . $conn->error;
        }
    }
}
?>