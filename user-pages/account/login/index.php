<?php
//start_session
@session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/2751fbc624.js" crossorigin="anonymous"></script> -->
    <link rel="stylesheet" href="../../../css/accounts/forms-styling.css" />
    <!-- <link rel="stylesheet" href="../../home/home_pages_forms_styling.css" /> -->
    <title>User Log In</title>
</head>
<body class="account-form-body">
        <!-- logo w Company name-->
        <img src="../../../images/logo.jpeg" style="width: 3em; height: 3em;" alt="Kshan Logo"/>
    <!-- warning messages -->

    <?php
        if(isset($_GET['e'])){
            if($_GET['e'] == 1){
            ?>
             <p class="msg" style="font-weight: bolder;">No account found registered under that email address or phone number.</p>
            <?php
        }  if($_GET['e'] == 2){
            ?>
             <p class="msg" style="font-weight: bolder;">Wrong password. Please try again</p>
            <?php
        }}
    ?>

    <!-- log in form -->
    <?php
        if(isset($_GET['login'])){
            echo '<style>
            .account-form-body form{
                height: 35%;
            }
            </style>';
            ?>
                <!-- welcome message with input prompt -->
            <div class="account-welcome-div">
                <h5>Welcome back! </h5>
                <p>Log in to your Kshan account.</p>
            </div>
            <form method="POST" action="processing.php">
                <div class="form-group mb-3" style="position: relative; ">
                    <div class="input-group" style="width: 100%">
                        <input placeholder="Email address" name="accInput" type="text" value="<?php  echo $_SESSION["emailAddress"];?>"/>
                        <!-- <div class="input-group-append" style="background: transparent; border:none;">
                            <span class="input-group-text" id="newPWToggle">Edit</span>
                        </div> -->
                        <!-- <label class="floating-label" style="margin-left: 20px">Email address*</label>                           -->
                    </div>
                </div>
                <div class="form-group mb-3" style="position: relative;">
                    <div class="input-group" style="width: 100%">
                        <input placeholder="Password" name="password" type="password"/>
                        <!-- <div class="input-group-append" style="background: transparent; border:none;">
                            <span class="input-group-text" id="newPWToggle"><i class="fa-solid fa-eye-slash"></i></span>
                        </div> -->
                    </div>
                </div>
                <button type="submit" name="logIn">Log In</button>
                <a href="#">Forgot your password</a>
            </form>
        <?php
            }else{
                echo '<style>
                .account-form-body form{
                  margin-bottom: 0;
                }
                </style>';
        ?>
    <!-- welcome message with input prompt -->
    <div class="account-welcome-div">
        <h5>Welcome to K-Shan Shop </h5>
        <p>Type your email address or phone number to log in or create an account.</p>
    </div>
    <form method="POST" action="processing.php">
        <div class="form-group mb-3" style="position: relative; margin-bottom: 1em">
            <div class="input-group" >
                <input name="accInput" placeholder="Email address" type="text" style="border: 2px solid #f68b1e; border-radius: 2px;"/>
                <!-- <label class="floating-label" style="margin-left: 20px; color: #f68b1e; top: -5px; font-size: 0.9em">Email address or mobile number*</label>                           -->
            </div>
        </div>
        <button type="submit" name="accessAccount">Continue</button>
    </form>
    <?php
            }
    ?>

    <!--other log in options -->
    <!-- <button  class="btn lg-facebook"><i class="fa fa-facebook"></i>  Log in with Facebook</button> -->

   <br>
   <br>
    <p class="msg">For further support you may visit out Help Center or contact our customer service team</p>

</body>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/2751fbc624.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script> -->
</html>