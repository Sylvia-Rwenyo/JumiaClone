<?php
// Start session
@session_start();
include_once "../../../controls/conn.php";

// Sign up user
if (isset($_POST['signup'])) {
    // Store values submitted in the form in variables after input sanitization
    $accInput = htmlspecialchars($_POST['accInput']);
    $password = htmlspecialchars($_POST['password']);
    $confirmPassword = htmlspecialchars($_POST['confirmPassword']);

    if ($password == $confirmPassword) {
        // Hash the new password
        $password = password_hash($password, PASSWORD_DEFAULT);
    } else {
        // Show error if the password entries don't match
        echo '<script> 
        window.location.href = "index.php?e=2"
        </script>';
        exit; // Stop execution if passwords don't match
    }

    // Check if accInput is in email format
    if (filter_var($accInput, FILTER_VALIDATE_EMAIL)) {
        // Check if the email exists in the database
        $sql_check = "SELECT * FROM endusers WHERE emailAddress = '$accInput'";
    } else {
        // Remove '254' if it exists among the first 4 characters
        if(substr($accInput, 0, 3) === "254") {
            // If yes, remove "254" from the accInput
            $accInput = substr($accInput, 3); // Removes "254"
        }
        if(substr($accInput, 0, 3) === "+") {
            // If yes, remove "+" from the accInput
            $accInput = str_replace( "+", "",$accInput); // Removes "+"
        }
        if(substr($accInput, 0, 0) === "0") {
            // If yes, remove "0" from the accInput
            $accInput = str_replace( "0", "",$accInput); // Removes "0"
        }
        
        // Check if the phoneNumber exists in the database
        $sql_check = "SELECT * FROM endusers WHERE phoneNumber = '$accInput'";
    }

    // Execute the SELECT query
    $result_check = mysqli_query($conn, $sql_check);

    // Check if any matching record is found
    if (mysqli_num_rows($result_check) > 0) {
        // Show error if a matching record is found
        echo '<script> 
        window.location.href = "index.php?e=1"
        </script>';
        exit; // Stop execution if a matching record is found
    }

    // Insert the new user into the database
    if (filter_var($accInput, FILTER_VALIDATE_EMAIL)) {
        $sql_insert = "INSERT INTO endusers (emailAddress, password) VALUES ('$accInput', '$password')";
    } else {
        $sql_insert = "INSERT INTO endusers (phoneNumber, password) VALUES ('$accInput', '$password')";
    }

    $result_insert = mysqli_query($conn, $sql_insert);

    if ($result_insert) {
        $sql_getID = "SELECT * FROM endusers WHERE phoneNumber = '$accInput' ||   emailAddress = '$accInput'";
        $result_getID = mysqli_query($conn, $sql_getID);

    // Check if any matching record is found
    if (mysqli_num_rows($result_getID) > 0) {
        $row  = mysqli_fetch_array($result_getID);
        if(is_array($row)){
        $_SESSION['user_id'] = $row['id'];
        $_SESSION["accInput"] = $accInput;
        $_SESSION["user"] = true;
        $_SESSION["user_password"] = $password;

        // Redirect to home page after successful registration
        echo '<script> 
        window.location.href = "../../home/"
        </script>';
        }
    }
    } else {
        // Show error if registration fails
        echo '<script> 
        window.location.href = "index.php?e=3"
        </script>';
    }
}
?>
