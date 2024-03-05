<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/accounts/forms-styling.css" />
    <script src="https://kit.fontawesome.com/2751fbc624.js" crossorigin="anonymous"></script>
    <title>Admin Log In</title>
    <link rel="icon" type="image/png" href="../../../images/favicon-16x16.png">
</head>
<body class="account-form-body">
        <!-- logo w Company name-->
        <img src="../../../images/logo.jpeg" style="width: 3em; height: 3em;" alt="Kshan Logo"/>
    <!-- welcome message with input prompt -->
    <div class="account-welcome-div">
        <h5>Welcome to K-Shan Shop Manager</h5>
        <p>Type your email address or phone number to log in or create an account.</p>
    </div>

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
            <form method="POST" action="processing.php">
                <input placeholder="Email address or phone number" name="accInput" type="text"/>
                <input placeholder="Password" name="password" type="password"/>
                <button type="submit" name="logIn">Log In</button>
            </form>
        <?php
            }else{
                echo '<style>
                .account-form-body form{
                  margin-bottom: 0;
                }
                </style>';
        ?>

    <form method="POST" action="processing.php">
        <input placeholder="Email address" name="accInput" type="text"/>
        <button type="submit" name="accessAccount">Continue</button>
    </form>
    <?php
            }
    ?>

    <!--other log in options -->
    <!-- <button  class="btn lg-facebook"> <i class="fa fa-facebook"></i> &nbsp;&nbsp;&nbsp;&nbsp;Log in with Facebook</button> -->
    <p class="msg">For further support you may contact other admin users.</p>


</body>
</html>