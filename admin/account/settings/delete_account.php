<?php
session_start();

// database connection
include_once('../../../controls/conn.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$adminId = $_SESSION["admin_id"];

$deleteSql = "DELETE FROM adminusers WHERE id = $adminId";

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

$conn->close();
?>
