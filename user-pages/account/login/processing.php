<?php
//start_session
@session_start();

include_once "../../../controls/conn.php";
// define global variables
 
if(isset($_POST['accessAccount']))
{	    
    //store values submitted in the  form in variables
	 $accInput = htmlspecialchars($_POST['accInput']);
     $_SESSION["emailAddress"]=$accInput;

    // check if corresponding user record is in database
        $sql_a=mysqli_query($conn,"SELECT * FROM endusers where phoneNumber='$accInput' || emailAddress='$accInput'");
        if(mysqli_num_rows($sql_a)>0)
        {
            echo '<script> 
            window.location.href = "index.php?login=1";
            </script>';
        }else {    
                echo '<script> 
                window.location.href = "../signup/"
                </script>';
        }
}

// log in user
if(isset($_POST['logIn']))
{     
    //store values submitted in the  form in variables
     $accInput = htmlspecialchars($_POST['accInput']);
     $password = htmlspecialchars($_POST['password']);
    
     // check if corresponding user record is in database
        $sql_a=mysqli_query($conn,"SELECT * FROM endusers where emailAddress='$accInput'");
        if(mysqli_num_rows($sql_a)>0)
        {
            $row  = mysqli_fetch_array($sql_a);
            if(is_array($row)){
                $hashed_password = $row['password'];
                // Verify password
                if(password_verify($password, $hashed_password)) {
                    // store relevant info in session variables
                    $_SESSION["user"] = true;
                    $_SESSION["user_id"] = $row['id'];
                    $_SESSION["user_password"] = $hashed_password;

                    // redirect user to home page
                    echo '<script> 
                    window.location.href = "../../home/"
                    </script>';
                } else {
                    // show error related to password
                    echo '<script> 
                    window.location.href = "index.php?e=2"
                    </script>';
                }
            }
        }else{
             // show error related to no record corresponding with input email address or phone number has been found
            echo '<script> 
            window.location.href = "index.php?e=1"
            </script>';
        }
    }


?>