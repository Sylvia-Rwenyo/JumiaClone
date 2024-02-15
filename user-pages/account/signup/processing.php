<?php
include_once "../../../controls/conn.php";

  //create session
  @session_start();
 
// sign up user
if(isset($_POST['signup']))
{	
  
    
    //store values submitted in the  form in variables
	 $accInput = htmlspecialchars($_POST['accInput']);
     $password = htmlspecialchars($_POST['password']);
     $confirmPassword = htmlspecialchars($_POST['confirmPassword']);

     if($password == $confirmPassword){
         // Hash the new password
      $password = password_hash($password, PASSWORD_DEFAULT);
     }else{
        echo '<script> 
        window.location.href = "index.php?e=2"
        </script>';
     }

         
    
        $sql_a=mysqli_query($conn,"INSERT INTO endusers (emailAddress, password) VALUES ('$accInput', '$password')");
        if($sql_a)
        {
            $_SESSION["emailAddress"]= $accInput;
            $_SESSION["user"] = true;
            $_SESSION["user_password"] = $password;

                
            echo '<script> 
            window.location.href = "../../home/"
            </script>';
        }else{
            echo '<script> 
            window.location.href = "index.php?e=2"
            </script>';
        }
    }

?>