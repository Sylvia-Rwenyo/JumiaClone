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

            $sql_a=mysqli_query($conn,"SELECT * FROM endusers where emailAddress='$accInput' && password = '$password'");
            if(mysqli_num_rows($sql_a)>0)
            {
                $row  = mysqli_fetch_array($sql_a);
                if(is_array($row)){
                    $_SESSION["user"] = true;
                    $_SESSION["user_id"] = $row['id'];
                    $_SESSION["user_password"] = $password;

                
            echo '<script> 
            window.location.href = "../../home/"
            </script>';
        }}}else{
            echo '<script> 
            window.location.href = "index.php?e=2"
            </script>';
        }
    }

?>