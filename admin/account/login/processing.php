<?php
    //start_session
    @session_start();

    // database connection
    include_once "../../../controls/conn.php";
    
    if(isset($_POST['accessAccount']))
    {	
        
        //store values submitted in the  form in variables
        $accInput = htmlspecialchars($_POST['accInput']);
        
        
        //  execute query to check if the user record with that emailAddress is in the database
            $sql_a=mysqli_query($conn,"SELECT * FROM adminUsers where emailAddress='$accInput' || phoneNumber='$accInput' ");
            if(mysqli_num_rows($sql_a)>0)
            {
                $_SESSION["emailAddress"]=$accInput;
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
        //store values submitted in the  form in variables
        $accInput = htmlspecialchars($_POST['accInput']);
        $password = htmlspecialchars($_POST['password']);

        $sql_a=mysqli_query($conn,"SELECT * FROM adminusers where emailAddress='$accInput' || phoneNumber='$accInput'");
        if(mysqli_num_rows($sql_a)>0)
        {
            $row  = mysqli_fetch_array($sql_a);
            if(is_array($row)){
                $hashed_password = $row['password'];
                // Verify password
                if(password_verify($password, $hashed_password)) {
        
                $_SESSION["emailAddress"]=$row['emailAddress'];
                $_SESSION["admin"] = true;
                $_SESSION["admin_id"] = $row['id'];
                $_SESSION["admin_password"] = $password;

                
            echo '<script> 
            window.location.href = "../../product-upload/"
            </script>';
            }
        else{
            echo '<script> 
            window.location.href = "index.php?e=2"
            </script>';
        }
    }
    }
    }
    

?>