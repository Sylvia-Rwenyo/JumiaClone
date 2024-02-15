<?php
session_start();

include_once('../../../controls/conn.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $emailAddress = htmlspecialchars($_POST["emailAddress"]);
    $firstName = htmlspecialchars($_POST["firstName"]);
    $lastName = htmlspecialchars($_POST["lastName"]);
    $phoneNumber = htmlspecialchars($_POST["phoneNumber"]);
    $password = htmlspecialchars($_POST['password']);
    $password = password_hash($password, PASSWORD_DEFAULT);

    $insertSql = "INSERT INTO adminusers (emailAddress, firstName, lastName, phoneNumber, password)
                 VALUES ('$emailAddress', '$firstName', '$lastName', '$phoneNumber', '$password')";

    if ($conn->query($insertSql) === TRUE) {
        echo '
            <script>
            window.location.href = "index.php";
            </script>
            ';
    } else {
        echo "Error adding new admin: " . $conn->error;
    }

    $conn->close();
}
?>
