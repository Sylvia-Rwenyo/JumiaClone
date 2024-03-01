<?php
//start_session
@session_start();

//database connection
include_once '../../controls/conn.php';

// check if user is logged in, if so store user name in variable
$username = '';
if(isset($_SESSION['user'])){
    $user_id =   $_SESSION["user_id"];
    $sql_a=mysqli_query($conn,"SELECT * FROM endusers where id = $user_id");
    if(mysqli_num_rows($sql_a)>0)
    {
        $row  = mysqli_fetch_array($sql_a);
        if(is_array($row)){
          $username = $row['firstName'];
            }
        }
    }else{
        // redirect user to login page
        echo '
        <script>window.location.href = "../account/login/"</script>
    ';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Management</title>
    <!-- stylesheet files and cdn links -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="home_page.css"/>
    <link rel="stylesheet" href="user_pages.css"/>
    <link rel="stylesheet" href="../../css/accounts/forms-styling.css" />
</head>
<style>
    .account-info{
        padding-left: 20%;
        padding-top: 5%;

    }
    .account-info .card{
        margin-right: 5%;
    }
    .account-info .card .list-group-item a{
    text-decoration: none;
    color: black;
    width: 100%;
    height: 100%;
    padding: calc((10em / number_of_a_elements) * 0.2);
    box-sizing: border-box;
    font-size: 1.2em;
    display: flex; /* Use flexbox */
    align-items: center; /* Vertically center the text */
    padding-left: 2em;
    }
    .account-info .card:nth-child(2) .list-group-item a{
        padding: calc((15em / number_of_a_elements) * 0.2);
    }

    .account-info .card h6{
        padding: 0.75em;
    } 
    .account-info .card h6 i{
        margin-right: 1em;
    }

    .account-info .list-group-item a:hover, .account-info .list-group-item.active{
        background-color: lightgray;
    }

    .account-info .list-group li {
        padding: 0;
        width: 100%;
        height: 100%;
    }

    .account-info .list-group {
        width: 100%;
        height: 100%;
    }
    .account-info .col-3, .account-info .col-8, .mgmt-links-header{
        border: none;
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
    }
    .account-info .col-8 .account-info-cards{
        padding: 0;
        display: grid;
        grid-template-columns: 47.5% 47.5%;
        row-gap: 5%;
        column-gap: 5%;
        height: 100%;
    }
    .account-info .col-8 .card{
        height: 100%;
        display: flex;
        flex-direction: column;
        
    }
    .account-info .col-8 .card strong{
        font-weight: 600;
    }
    .account-info .col-8 .card p, .account-info .col-8 .card h6, .account-info .col-8 .card a{
        padding-left: 1em;
        padding-right: 1em;
        margin-bottom: 0.5em;
    }
    .account-info .col-8 .card h6{
        text-transform: uppercase;
    }

</style>
<body class="account-form-body">
    <!-- logo w Company name-->
    <img src="../../images/logo.jpeg" style="width: 3em; height: 3em;" alt="Kshan Logo"/>

    <!-- welcome message with input prompt -->
    <div class="account-welcome-div">
        <h5>Hello <?php echo $username; ?> </h5>
    </div>
    
    <section class="container">
        <!-- links to more on account management -->
        <div class="row account-info">
        <div class="col-3  card" style="height: 10em; padding: 0;" >
                <h6 class="mgmt-links-header"><i class="fa-solid fa-circle-user"></i>Account Details</h6>
                <ul class="list-group">
                    <li class="list-group-item"><a href="basic_details.php">Basic Details</a></li>
                    <li class="list-group-item"><a href="">Edit Phone number</a></li>
                </ul>
            </div>
            <div class="col-3  card" style="height: 15em; padding: 0;" >
                <h6 class="mgmt-links-header"><i class="fa-solid fa-lock"></i>Security Credentials</h6>
                <ul class="list-group">
                    <li class="list-group-item"><a href="">Change Password</a></li>
                    <li class="list-group-item"><a href="">Pin Settings</a></li>
                    <li class="list-group-item" style="border-top: 1px solid lightgray;"><a style="color: red; align-items:center; width: 100%; height: 100%" href="../account/settings/logout.php">DELETE ACCOUNT</a></li>
                </ul>
            </div>
        </div>
    </section>
</body>
<!-- scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/2751fbc624.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</html>