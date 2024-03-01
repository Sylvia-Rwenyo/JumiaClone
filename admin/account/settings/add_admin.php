<?php
//start_session
 @session_start();

//  database connection
include_once('../../../controls/conn.php');

// check if a form is submitted using the post method
if ($_SERVER["REQUEST_METHOD"] === "POST") {

     // show connection error if it occured
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // sanitize user input and store the values in variables
    $emailAddress = htmlspecialchars($_POST["emailAddress"]);
    $firstName = htmlspecialchars($_POST["firstName"]);
    $lastName = htmlspecialchars($_POST["lastName"]);
    $phoneNumber = htmlspecialchars($_POST["phoneNumber"]);
    $password = htmlspecialchars($_POST['password']);
    $password = password_hash($password, PASSWORD_DEFAULT);

    // query to insert user record in database
    $insertSql = "INSERT INTO adminusers (emailAddress, firstName, lastName, phoneNumber, password)
                 VALUES ('$emailAddress', '$firstName', '$lastName', '$phoneNumber', '$password')";

    // execute the above query
    if ($conn->query($insertSql) === TRUE) {
        echo '
            <script>
            window.location.href = "index.php";
            </script>
            ';
    } else {
        // show error if it occurs
        echo "Error adding new admin: " . $conn->error;
    }
    //close database connection 
    $conn->close();
}
?>
