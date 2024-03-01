<?php
//start_session
 @session_start();

// database connection
include_once('../../../controls/conn.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// get admin id stored in a corresponding session variable
$adminId = $_SESSION["admin_id"];

$deleteSql = "DELETE FROM adminusers WHERE id = $adminId";

if ($conn->query($deleteSql) === TRUE) {
    // Unset all session variables
    session_unset();

    // Destroy the session
    session_destroy();

    // redirect to login page
    echo '
            <script>
            window.location.href = "../login/";
            </script>
            ';
} else {
    // show error if it occurs
    echo "Error deleting account: " . $conn->error;
}

//close database connection 
    $conn->close();
?>
