<?php
//start_session
 @session_start();

// database connection
include_once('../../../controls/conn.php');

// show connection error if it occured
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// get user id from session
$userID = $_SESSION["user_id"];

$deleteSql = "DELETE FROM endusers WHERE id = '$userID'";

if ($conn->query($deleteSql) === TRUE) {
    // Unset all session variables
    session_unset();

    // Destroy the session
    session_destroy();

    echo '
            <script>
            window.location.href = "../login/";
            </script>
            ';
} else {
    echo "Error deleting account: " . $conn->error;
}

//close database connection 
    $conn->close();
?>
