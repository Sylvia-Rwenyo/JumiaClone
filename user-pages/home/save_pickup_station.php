<?php
// resume session
session_start();

// Check if location and sub_location are set in the POST request
if(isset($_POST['location']) && isset($_POST['sub_location'])) {
    // Store the selected pickup station details in session variables
    $_SESSION['pickup_station'] = array(
        'location' => $_POST['location'],
        'sub_location' => $_POST['sub_location']
    );
    header('Location: ' . $_SERVER['HTTP_REFERER'].'?save_st=1');
} else {
    header('Location: ' . $_SERVER['HTTP_REFERER'].'?save_st=0');
}
?>
