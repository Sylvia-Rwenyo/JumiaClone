<?php
session_start();
include_once '../../controls/conn.php';

// Check if the form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data and store it in variables
    $firstName = !empty($_POST['firstName']) ? $_POST['firstName'] : null;
    $middleName = !empty($_POST['middleName']) ? $_POST['middleName'] : null;
    $lastName = !empty($_POST['lastName']) ? $_POST['lastName'] : null;
    $emailAddress = !empty($_POST['emailAddress']) ? $_POST['emailAddress'] : null;
    $phoneNumber = !empty($_POST['phoneNumber']) ? $_POST['phoneNumber'] : null;
    $gender = !empty($_POST['gender']) ? $_POST['gender'] : null;
    $birthDate = !empty($_POST['birthdate']) ? $_POST['birthdate'] : null; // Ensure correct field name

    // Format birth date for MySQL
    $formattedBirthDate = !empty($birthDate) ? date('Y-m-d', strtotime($birthDate)) : null;

    $client_id = $_SESSION['user_id'];

    // Prepare the SQL statement for updating user information
    $updateSql = "UPDATE endusers 
                  SET firstName = IFNULL(?, firstName), 
                      middleName = IFNULL(?, middleName), 
                      lastName = IFNULL(?, lastName), 
                      emailAddress = IFNULL(?, emailAddress),
                      phoneNumber = IFNULL(?, phoneNumber), 
                      gender = IFNULL(?, gender), 
                      birthDate = IFNULL(?, birthDate)
                  WHERE id = ?";

    // Prepare and execute the update statement
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param("sssssssi", $firstName, $middleName, $lastName, $emailAddress, $phoneNumber, $gender, $formattedBirthDate, $client_id); // Use formatted birth date
    
    if ($stmt->execute()) {
        // Redirect 
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    } else {
        // Update failed
        echo "Error updating user information: " . $conn->error;
    }
}
?>
