<?php
//start_session
 @session_start();
//database connection
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
    $birthDate = !empty($_POST['birthdate']) ? $_POST['birthdate'] : null;
    $currentPW = !empty($_POST['currentPW']) ? $_POST['currentPW'] : null;
    $newPW = !empty($_POST['newPW']) ? $_POST['newPW'] : null;
    $newPW2 = !empty($_POST['newPW2']) ? $_POST['newPW2'] : null;


    // Get user ID from session
    $client_id = $_SESSION['user_id'];

    if(isset( $_POST['newPin']) && isset($_POST['newPin2'])){
    $newPin = '';
    foreach ($_POST['newPin'] as $digit) {
        $newPin .= $digit;
    }

    // Retrieve the confirmed new pin from the form
    $confirmNewPin = '';
    foreach ($_POST['NewPin2'] as $digit) {
        $confirmNewPin .= $digit;
    }

    // Check if new pin and confirm new pin are not empty
    if (!empty($newPin) && !empty($confirmNewPin)) {
        // Check if new pin and confirm new pin match
        if ($newPin === $confirmNewPin) {

            $hashedPin = password_hash($newPin, PASSWORD_DEFAULT);
            // Prepare and execute SQL statement to update pin in the database
            $updatePinSql = "UPDATE endusers SET pin = ? WHERE id = ?";
            $stmt = $conn->prepare($updatePinSql);
            $stmt->bind_param("si", $hashedPin, $client_id);

            if ($stmt->execute()) {
                header("Location: account_management.php");
            } else {
                // Update failed
                echo "Error updating pin: " . $conn->error;
            }
        } else {
            // New pin and confirm new pin do not match
            echo "New pin and confirm new pin do not match!";
        }
    } else {
        // New pin or confirm new pin is empty
        echo "New pin or confirm new pin is empty!";
    }
} 

    // Fetch current password from the database
    $fetchPasswordSql = "SELECT password FROM endusers WHERE id = ?";
    $stmt = $conn->prepare($fetchPasswordSql);
    $stmt->bind_param("i", $client_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $storedPassword = $row['password'];

    // Verify if the entered current password matches the password stored in the database
    if (password_verify($currentPW, $storedPassword)) {
        // Check if new password and confirmation match
        if ($newPW === $newPW2) {
            // Hash the new password before updating
            $hashedPassword = password_hash($newPW, PASSWORD_DEFAULT);

            // Update password in the database
            $updatePasswordSql = "UPDATE endusers SET password = ? WHERE id = ?";
            $stmt = $conn->prepare($updatePasswordSql);
            $stmt->bind_param("si", $hashedPassword, $client_id);
            
            if ($stmt->execute()) {
                header("Location: {$_SERVER['HTTP_REFERER']}");
            } else {
                // Update failed
                echo "Error updating password: " . $conn->error;
            }
        } else {
            // New password and confirmation do not match
            echo "New password and confirmation password do not match!";
        }
    } else {
        // Current password is incorrect
        echo "Current password is incorrect!";
    }


    // Format birth date for MySQL
    $formattedBirthDate = !empty($birthDate) ? date('Y-m-d', strtotime($birthDate)) : null;


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
