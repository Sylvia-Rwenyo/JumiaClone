<?php
//start_session
 @session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // database connection
    include_once('../../../controls/conn.php');

    // show connection error if it occured
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get user input
    $email = $_POST["emailAddress"];
    $oldPassword = $_POST["oldPassword"];
    $newPassword = $_POST["password"];

    // Get the current admin's information from the session
    $adminId = $_SESSION["admin_id"];
    // $currentEmail = $_SESSION["accInput"];
    $currentPassword = $_SESSION["admin_password"];

    // Validate old password
    if (password_verify($oldPassword, $currentPassword)) {
        // Hash the new password
        $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update admin credentials in the database
        $updateSql = "UPDATE adminusers SET emailAddress = '$email', password = '$hashedNewPassword' WHERE id = $adminId";

        if ($conn->query($updateSql) === TRUE) {
            // Update session variables with new information
            $_SESSION["accInput"] = $email;
            $_SESSION["admin_password"] = $hashedNewPassword;

            echo '
            <script>
            window.location.href = "index.php";
            </script>
            ';
        } else {
            echo "Error updating credentials: " . $conn->error;
        }
    } else {
        echo "Invalid old password.";
    }

    //close database connection 
    $conn->close();
}
?>
