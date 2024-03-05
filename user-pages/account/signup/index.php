<?php
//start_session
 @session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- stylesheet files and cdn links -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/2751fbc624.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../home/home_pages_forms_styling.css" />
    <link rel="stylesheet" href="../../../css/accounts/forms-styling.css" />
    <title>KShan  Sign Up</title>
    <link rel="icon" type="image/png" href="../../../images/favicon-16x16.png">
</head>
<body class="account-form-body">
        <!-- logo w Company name-->
        <img src="../../../images/logo.jpeg" style="width: 3em; height: 3em;" alt="Kshan Logo"/>
    <!-- welcome message with input prompt -->
    <div class="account-welcome-div">
        <h5>Welcome to K-Shan Shop </h5>
        <p>Let's get started by creating your account.</p>
        <p>To keep your account safe, we need a strong password.</p>
    </div>

    <!-- warning messages -->

    <?php
        if(isset($_GET['e'])){
            if($_GET['e'] == 1){
            ?>
             <p class="msg" style="font-weight: bolder;">Therer is another account registered under that email address or phone number. Please try using a different one</p>
            <?php
        }  if($_GET['e'] == 2){
            ?>
             <p class="msg" style="font-weight: bolder;">Password entries do not match. Please try again.</p>
            <?php
        }if($_GET['e'] == 3){
            ?>
             <p class="msg" style="font-weight: bolder;">Registration failed. Please try again later.</p>
            <?php
        }}
    ?>

    <!-- sign up form -->
            <form method="POST" action="processing.php" class="signUp-form" style=" margin-bottom: 3em">
                <div class="form-group mb-3" style="position: relative;">
                    <div class="input-group disabled">
                        <input class="form-control" placeholder="Email address or phone number" name="accInput" type="text" value="<?php echo $_SESSION["accInput"]; ?>"/>
                        <div class="input-group-append">
                            <a href="../login/index.php" class="input-group-text" style="color: #f68b1e;">Edit</a>
                        </div>
                    </div>
                    <label class="floating-label" style="margin-left: 10px">Email address or phone number*</label>                          
                </div>
                <div class="form-group mb-3" style="position: relative;">
                    <div class="input-group">
                        <input type="password" class="form-control" aria-label="password" onkeyup="checkPasswordStrength(this.value)"  placeholder="password" aria-describedby="password" name="password" id="newPW1">
                        <div class="input-group-append">
                            <span class="input-group-text" id="newPW1Toggle"><i class="fa-solid fa-eye-slash"></i></span>
                        </div>
                        <label class="floating-label">New password*</label>                          
                    </div>
                    <div class="password-strength">
                        <div class="dash dash-1"></div>
                        <div class="dash dash-2"></div>
                        <div class="dash dash-3"></div>
                    </div>
                    <span id="strengthIndicator">
                    <span>
                </div>
                <div class="form-group mb-3" style="position: relative;">
                    <div class="input-group">
                        <input type="password" class="form-control" aria-label="confirm password" placeholder="confirm password" aria-describedby="confirm password" name="confirmPassword" id="newPW12">
                        <div class="input-group-append">
                            <span class="input-group-text" id="newPW12Toggle"><i class="fa-solid fa-eye-slash"></i></span>
                        </div>
                        <label class="floating-label">Confirm password*</label>                          
                    </div>
                </div>
                <button type="submit" name="signup" class="btn">Continue</button>
            </form>
            <br><br><br>
    <!--other sign up options -->
    <!-- <button  class="btn lg-facebook"> <i class="fa fa-facebook"></i>  sign up with Facebook</button> -->
    <br><br>
    <p class="msg">For further support you may visit out Help Center or contact our customer service team</p>


</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/2751fbc624.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../home/form_script.js"></script>
<script>
    togglePasswordVisibility('newPW1', 'newPW1Toggle');
    togglePasswordVisibility('newPW12', 'newPW12Toggle');
</script>
</html>