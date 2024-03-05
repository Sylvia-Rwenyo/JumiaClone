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
            }}}else{
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
    <link rel="stylesheet" href="home_pages_forms_styling.css"/>
    <link rel="icon" type="image/png" href="../../images/favicon-16x16.png">
</head>
<style>
    .account-info{
        padding-left: 5%;
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
    .account-info .col-3, .account-info .col-7{
        border: none;
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
    }
    .account-info .col-7.account-info-cards{
        padding: 0;
        display: grid;
        grid-template-columns: 47.5% 47.5%;
        row-gap: 5%;
        column-gap: 5%;
        height: 100%;
    }
    .account-info .col-7.card{
        height: 100%;
        display: flex;
        flex-direction: column;
        
    }
    .account-info .col-7.card strong{
        font-weight: 600;
    }
    .account-info .col-7.card p, .account-info .col-7.card h6, .account-info .col-7.card a{
        padding-left: 1em;
        padding-right: 1em;
        margin-bottom: 0.5em;
    }

    .account-welcome-div{
        padding: 1em;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-evenly;
        height: 25%;
    }
    .account-info .list-group{
        height: 20%;
    }
    .account-info .col-3, .account-info .col-7{
        height: 80vh;
    }
    .floating-label{
            font-size: 14px;
        } 
</style>
<body class="account-form-body">        
    <section class="container">
        <!-- account info links -->
        <div class="row account-info">
            <div class="col-3  card" style="padding: 0;" >
            <!-- welcome message -->
                <div class="account-welcome-div">
                    <img src="../../images/logo.jpeg" style="width: 3em; height: 3em;" alt="Kshan Logo"/>
                    <h5 style="margin-top: 1em">Hello <?php echo $username; ?> </h5>
                </div>
                <ul class="list-group" id="list-group">
                    <li class="list-group-item" id="profile-details">
                        <a href="#" style="display: flex; flex-direction: row; justify-content: space-between; padding-left: 0.5em; padding-right: 1em">
                            <i class="fa-solid fa-circle-user"></i> Profile Details <i class="fa fa-angle-right" id="angle-icon2" style="color: #f68b1e"></i>
                        </a>
                    </li>
                        <li class="list-group-item collapse b-d"><a href="basic_details.php">Basic Details</a></li>
                        <li class="list-group-item collapse b-d"><a href="basic_details.php?ep=1">Edit Phone number</a></li>
                    <li class="list-group-item" id="security-credentials">
                        <a href="#" style="display: flex; flex-direction: row; justify-content: space-between; padding-left: 0.5em;padding-right: 1em">
                            <i class="fa-solid fa-lock"></i>Security Credentials<i id="angle-icon" class="fa fa-angle-right" style="color: #f68b1e"></i>
                        </a>
                    </li>
                    <li class="list-group-item collapse s-c"><a href="basic_details.php?ePW=1" style="padding-left: 0.5em;padding-right: 1em">Change password</a></li>
                    <li class="list-group-item collapse s-c"><a href="basic_details.php?setPin=1" style="padding-left: 0.5em;padding-right: 1em">Pin settings</a></li>
                    <li class="list-group-item collapse s-c"><a href="../account/settings/delete_account.php" style="padding-left: 0.5em;padding-right: 1em; color: red;">Delete Account</a></li>
                </ul>
            </div>
            <!-- account info display -->
            <div class="col-7  card" style="height: fit-content; padding: 0;" >
                <div style="display: flex; flex-direction: row; justify-content: space-between;">
                    <h6 class="mgmt-links-header">Profile Details</h6>
                    <h6 class="mgmt-links-header-link"><a href="basic_details.php?edit=1" style="text-decoration: none; color: #f68b1e;">Edit Profile</a></h6>
                </div>
                <?php
                    $client_id = $_SESSION['user_id'];
                    $usersSql = "SELECT * FROM endusers WHERE id = ?";
                    $stmt = $conn->prepare($usersSql);
                    $row = [];
                    $birthdate = '';
                    
                    $stmt->bind_param("i", $client_id);
                    $stmt->execute();
                    
                    $usersResult = $stmt->get_result();
                    
                    if ($usersResult->num_rows > 0) {
                        $row = $usersResult->fetch_assoc(); 
                    }  
                    $birthdate = !empty($row['birthDate']) ? date('d/m/Y', strtotime($row['birthDate'])) : null; 
                    
                    // show form to set pin depending on GET variable
                    if(isset($_GET['setPin'])){
                        echo '<style>
                        .mgmt-links-header-link,  .mgmt-links-header{
                            display:none;
                        </style>';
                        ?>
                        <form method="POST" class="edit-details-form" action="save-user-info.php" style="padding: 1em; display: flex; flex-direction: column; position: relative;" id="pinForm">              
                            <div>
                                <h5 style="text-align: center">Set your pin</h5>
                                <p style="font-size: 1.1em">Set your pin for an easy and secure log in on K-Shan</p>
                            </div>
                            <div class="form-group mb-3" style="position: relative; width:80%;margin-left:10%">
                                <div class="input-group">
                                    <input type="text" class="form-control single-char-input" maxlength="1" aria-label="new pin" aria-describedby="new pin" name="newPin[]" id="newPin1">
                                    <input type="text" class="form-control single-char-input" maxlength="1" aria-label="new pin" aria-describedby="new pin" name="newPin[]" id="newPin2">
                                    <input type="text" class="form-control single-char-input" maxlength="1" aria-label="new pin" aria-describedby="new pin" name="newPin[]" id="newPin3">
                                    <input type="text" class="form-control single-char-input" maxlength="1" aria-label="new pin" aria-describedby="new pin" name="newPin[]" id="newPin4">
                                    <input type="text" class="form-control single-char-input" maxlength="1" aria-label="new pin" aria-describedby="new pin" name="newPin[]" id="newPin5">
                                    <input type="text" class="form-control single-char-input" maxlength="1" aria-label="new pin" aria-describedby="new pin" name="newPin[]" id="newPin6">
                                </div>
                            </div>
                            <h6 style="text-align: center">Confirm your pin</h6>
                            <div class="form-group mb-3" style="position: relative; width:80%;margin-left:10%">
                                <div class="input-group">
                                    <input type="text" class="form-control single-char-input" maxlength="1" aria-label="confirm new pin" aria-describedby="confirm new pin" name="newPin2[]" id="confirmNewPin1">
                                    <input type="text" class="form-control single-char-input" maxlength="1" aria-label="confirm new pin" aria-describedby="confirm new pin" name="newPin2[]" id="confirmNewPin2">
                                    <input type="text" class="form-control single-char-input" maxlength="1" aria-label="confirm new pin" aria-describedby="confirm new pin" name="newPin2[]" id="confirmNewPin3">
                                    <input type="text" class="form-control single-char-input" maxlength="1" aria-label="confirm new pin" aria-describedby="confirm new pin" name="newPin2[]" id="confirmNewPin4">
                                    <input type="text" class="form-control single-char-input" maxlength="1" aria-label="confirm new pin" aria-describedby="confirm new pin" name="newPin2[]" id="confirmNewPin5">
                                    <input type="text" class="form-control single-char-input" maxlength="1" aria-label="confirm new pin" aria-describedby="confirm new pin" name="newPin2[]" id="confirmNewPin6">
                                </di2v>
                            </div>
                        </form>

                        <?php
                        // show form to edit password depending on GET variable
                        }else if(isset($_GET['ePW'])){
                        echo '<style>
                        .mgmt-links-header-link,  .mgmt-links-header{
                            display:none;
                        </style>';
                        ?>
                        <form method="POST" class="edit-details-form" action="save-user-info.php" style="padding: 1em; display: flex; flex-direction: column; position: relative;">              
                            <div>
                                <h5>Password settings</h5>
                            </div>
                            <div class="form-group mb-3" style="position: relative;">
                                <div class="input-group">
                                    <input type="password" class="form-control" aria-label="current password" placeholder="current password" aria-describedby="current password" name="currentPW" id="currentPW">
                                    <div class="input-group-append" style="background: transparent; border:none;">
                                        <span class="input-group-text" id="currentPWToggle"><i class="fa-solid fa-eye-slash"></i></span>
                                    </div>
                                    <label class="floating-label">Current password*</label>                          
                                </div>
                            </div>
                            <div class="form-group mb-3" style="position: relative;">
                                <div class="input-group">
                                    <input type="password" class="form-control" aria-label="new password"  placeholder="new password" aria-describedby="new password" name="newPW" id="newPW">
                                    <div class="input-group-append" style="background: transparent; border:none;">
                                        <span class="input-group-text" id="newPWToggle"><i class="fa-solid fa-eye-slash"></i></span>
                                    </div>
                                    <label class="floating-label">New password*</label>                          
                                </div>
                            </div>
                            <div class="form-group mb-3" style="position: relative;">
                                <div class="input-group">
                                    <input type="password" class="form-control" aria-label="confirm new password" placeholder="confirm new password" aria-describedby="confirm new password" name="newPW2" id="newPW2">
                                    <div class="input-group-append" style="background: transparent; border:none;">
                                        <span class="input-group-text" id="newPW2Toggle"><i class="fa-solid fa-eye-slash"></i></span>
                                    </div>
                                    <label class="floating-label">Confirm password*</label>                          
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" class="btn" style="background-color: #f68b1e; color: white; border-radius: 0; width: 100%">Save</button>
                            </div>
                        </form>
                        <?php
                        // show form to edit phone number depending on GET variable
                        }else if(isset($_GET['ep'])){
                        echo '<style>
                        .mgmt-links-header-link,  .mgmt-links-header{
                            display:none;
                        </style>';
                        ?>
                        <form method="POST" class="edit-details-form" action="save-user-info.php" style="padding: 1em; display: flex; flex-direction: column; position: relative;">              
                            <div>
                                <h5 style="text-align: center">Current phone number</h5>
                                <p style="font-size: 1.1em">This is the phone number currently associated to your profile. You can change it by clicking on the button below</p>
                            </div>
                            <div class="form-group mb-3" style="position: relative;">
                            <div class="input-group">
                                    <input type="text" class="form-control" aria-label="phoneNumber" aria-describedby="user-phoneNumber" name="phoneNumber" id="phoneNumber" value="<?php echo isset($row['phoneNumber']) ? $row['phoneNumber'] : ''; ?>">
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" class="btn" style="background-color: #f68b1e; color: white; border-radius: 0; width: 100%">Edit Phone Number</button>
                            </div>
                        </form>
                        <?php
                        // show form to edit general user account info depending on GET variable
                    }else if(isset($_GET['edit'])){
                        if(isset($_GET['success'])){
                            echo"<script> window.location.href='basic_details.php'</script>";
                        }
                        echo '<style>
                                .mgmt-links-header-link{
                                    display:none;
                                </style>';
                ?>                
                        <form method="POST" class="edit-details-form" action="save-user-info.php" style="padding: 1em; display: flex; flex-direction: column; position: relative;">
                            <div class="form-group mb-3" style="position: relative;">
                                <input  type="text" class="form-control" value="<?php echo isset($row['firstName']) ? $row['firstName'] : ''; ?>" aria-label="First name" aria-describedby="user-first-name" name="firstName">
                                <label class="floating-label">First Name*</label>
                            </div>
                            <div class="form-group mb-3" style="position: relative;">
                                <input type="text" class="form-control" value="<?php echo isset($row['middleName']) ? $row['middleName'] : ''; ?>" aria-label="Middle Name" name="middleName" aria-describedby="user-middle-name">
                                <label class="floating-label">Middle Name</label>
                            </div>
                            <div class="form-group mb-3" style="position: relative;">
                                <input type="text" class="form-control" value="<?php echo isset($row['lastName']) ? $row['lastName'] : ''; ?>" aria-label="Last Name" name="lastName" aria-describedby="user-last-name">
                                <label class="floating-label">Last Name*</label>
                            </div>
                            <div class="form-group mb-3" style="position: relative;">
                                <input type="text" class="form-control" value="<?php echo isset($row['emailAddress']) ? $row['emailAddress'] : ''; ?>" aria-label="Email address" aria-describedby="user-emailAddress" name="emailAddress">
                                <label class="floating-label">Email Address*</label>
                            </div>
                            <div class="form-group mb-3" style="position: relative;">
                                <select class="custom-select" id="gender" name="gender">
                                    <?php echo (isset($row['gender']) && $row['gender'] == '') ? '<option value="" disabled></option>' : ''; ?>
                                    <option value="male" <?php echo (isset($row['gender']) && $row['gender'] == 'male') ? 'selected' : ''; ?>>Male</option>
                                    <option value="female" <?php echo (isset($row['gender']) && $row['gender'] == 'female') ? 'selected' : ''; ?>>Female</option>
                                </select>
                                <label class="floating-label">Gender*</label>
                            </div>
                        <div class="form-group mb-3" style="position: relative;">
                            <input type="date" class="form-control" aria-label="birthdate" aria-describedby="user-birthdate" name="birthdate" id="birthdate" value="<?php echo $row['birthDate']?>">
                            <label class="floating-label">Birthdate*</label>
                        </div>
                        <div class="form-group mb-3" style="position: relative;">
                        <div class="input-group">
                                <input type="text" class="form-control" aria-label="phoneNumber" aria-describedby="user-phoneNumber" name="phoneNumber" id="phoneNumber" value="<?php echo isset($row['phoneNumber']) ? $row['phoneNumber'] : ''; ?>">
                            </div>
                            <label class="floating-label">Phone number*</label>
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn" style="background-color: #f68b1e; color: white; right: 0; width: 30%">Save</button>
                        </div>
                    </form>
                    <?php
                    // show account info
                        }else{
                    ?>
                    <div class="acc-details" style="padding: 1em; display: flex; flex-direction: column; position: relative;">
                        <div class="form-group mb-3" style="position: relative;">
                            <input disabled type="text" class="form-control" value="<?php echo isset($row['firstName']) ? $row['firstName'] : ''; ?>" aria-label="First name" aria-describedby="user-first-name" name="firstName">
                            <label class="floating-label">First Name</label>
                        </div>
                        <div class="form-group mb-3" style="position: relative;">
                            <input disabled type="text" class="form-control" value="<?php echo isset($row['middleName']) ? $row['middleName'] : ''; ?>" aria-label="Middle Name" name="middleName" aria-describedby="user-middle-name">
                            <label class="floating-label">Middle Name</label>
                        </div>
                        <div class="form-group mb-3" style="position: relative;">
                            <input disabled type="text" class="form-control" value="<?php echo isset($row['lastName']) ? $row['lastName'] : ''; ?>" aria-label="Last Name" name="lastName" aria-describedby="user-last-name">
                            <label class="floating-label">Last Name</label>
                        </div>
                        <div class="form-group mb-3" style="position: relative;">
                            <input disabled type="text" class="form-control" value="<?php echo isset($row['emailAddress']) ? $row['emailAddress'] : ''; ?>" aria-label="Email address" aria-describedby="user-emailAddress" name="emailAddress">
                            <label class="floating-label">Email Address</label>
                        </div>
                        <div class="form-group mb-3" style="position: relative;">
                            <input disabled type="text" class="form-control" value="<?php echo isset($row['gender']) ? $row['gender'] : ''; ?>" aria-label="Gender" aria-describedby="user-gender" name="gender">
                            <label class="floating-label">Gender</label>
                        </div>
                        <div class="form-group mb-3" style="position: relative;">
                            <input disabled type="text" class="form-control" aria-label="birthdate" aria-describedby="user-birthdate" name="birthdate" id="birthdate" value="<?php echo $birthdate; ?>">
                            <label class="floating-label">Birthdate</label>
                        </div>
                        <div class="form-group mb-3" style="position: relative;">
                            <input disabled type="text" class="form-control" aria-label="phoneNumber" aria-describedby="user-phoneNumber" name="phoneNumber" id="phoneNumber" value="<?php echo isset($row['phoneNumber']) ? $row['phoneNumber'] : ''; ?>">
                            <label class="floating-label">Phone number</label>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
            </div>
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
<script src="form_script.js"></script>
<script>
    togglePasswordVisibility('currentPW', 'currentPWToggle');
    togglePasswordVisibility('newPW', 'newPWToggle');
    togglePasswordVisibility('newPW2', 'newPW2Toggle');
document.addEventListener("DOMContentLoaded", function() {
    // toggle user account info links
    var securityCredentials = document.getElementById("security-credentials");
    var angleIcon = document.getElementById("angle-icon");
    var optionsList = document.getElementById("list-group");
    var listItems = optionsList.querySelectorAll(".s-c");
    var listItems2 = optionsList.querySelectorAll(".b-d");
    var profileDetails = document.getElementById("profile-details");
    var angleIcon2 = document.getElementById("angle-icon2");

    securityCredentials.addEventListener("click", function() {
        listItems.forEach(function(item) {
            var isCollapsed = item.classList.contains("collapse");
            if (isCollapsed) {
                item.classList.remove("collapse");
                item.classList.add("show");
                item.style.borderBottom = '4px solid lightgray';
                optionsList.style.height = '80%';
                angleIcon.classList.remove("fa-angle-right");
                angleIcon.classList.add("fa-angle-down");
            } else {
                item.classList.add("collapse");
                item.classList.remove("show");
                optionsList.style.height = '20%';
                angleIcon.classList.remove("fa-angle-down");
                angleIcon.classList.add("fa-angle-right");
            }
        });

        listItems2.forEach(function(item) {
            item.classList.add("collapse");
            item.classList.remove("show");
            angleIcon2.classList.remove("fa-angle-down");
            angleIcon2.classList.add("fa-angle-right");
        });
    });

    profileDetails.addEventListener("click", function() {
        listItems2.forEach(function(item) {
            var isCollapsed = item.classList.contains("collapse");
            if (isCollapsed) {
                item.classList.remove("collapse");
                item.classList.add("show");
                item.style.borderBottom = '4px solid lightgray';
                optionsList.style.height = '40%';
                angleIcon2.classList.remove("fa-angle-right");
                angleIcon2.classList.add("fa-angle-down");
            } else {
                item.classList.add("collapse");
                item.classList.remove("show");
                optionsList.style.height = '20%';
                angleIcon2.classList.remove("fa-angle-down");
                angleIcon2.classList.add("fa-angle-right");
            }
        });

        listItems.forEach(function(item) {
            item.classList.add("collapse");
            item.classList.remove("show");
            angleIcon.classList.remove("fa-angle-down");
            angleIcon.classList.add("fa-angle-right");
        });
    });
});

</script>
</html>