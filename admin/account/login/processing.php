<?php
include_once "../../../controls/conn.php";
// define global variables
 
if(isset($_POST['accessAccount']))
{	
    //create session
    @session_start();
    
    //store values submitted in the  form in variables
	 $accInput = htmlspecialchars($_POST['accInput']);
    
    
        $sql_a=mysqli_query($conn,"SELECT * FROM adminUsers where phoneNumber='$accInput' || emailAddress='$accInput'");
        if(mysqli_num_rows($sql_a)>0)
        {
            echo '<script> 
            window.location.href = "index.php?login=1";
            </script>';
        }else {    
                echo '<script> 
                window.location.href = "index.php?e=1"
                </script>';
        }
}

// log in user
if(isset($_POST['logIn']))
{	
    //create session
    @session_start();
    
    //store values submitted in the  form in variables
	 $accInput = htmlspecialchars($_POST['accInput']);
     $password = htmlspecialchars($_POST['password']);

      // Hash the new password
      $password = password_hash($password, PASSWORD_DEFAULT);    
    
        $sql_a=mysqli_query($conn,"SELECT * FROM adminUsers where phoneNumber || emailAddress='$accInput' && password = '$password'");
        if(mysqli_num_rows($sql_a)>0)
        {
            $row  = mysqli_fetch_array($sql_a);
            if(is_array($row)){
                $_SESSION["emailAdress"]=$row['emailAddress'];
                $_SESSION["admin"] = true;
                $_SESSION["admin_id"] = $row['id'];
                $_SESSION["admin_password"] = $password;

                
            echo '<script> 
            window.location.href = "../../product-upload/"
            </script>';
            }
        }else{
            echo '<script> 
            window.location.href = "index.php?e=2"
            </script>';
        }
    }

?>