<?php
    session_start();
    include('../includes/dbcon.php');
    if(isset($_POST['log_btn']))
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        //to check if the email exists in the database
        $check_email_query = "SELECT* FROM users WHERE email = '$email' LIMIT 1";
        $check_email_query_run = mysqli_query($con , $check_email_query);

        if(mysqli_num_rows($check_email_query_run) > 0)
        {
            //to check if the password entered is correct or not
            $row = mysqli_fetch_array($check_email_query_run);

            $verify_status = $row['verify_status'];
            if($verify_status)
            {
                $stored_password_hash = $row['password'];
                if(password_verify($password , $stored_password_hash))
                {
                    $_SESSION['authenticated'] = TRUE;
                    $_SESSION['auth_user'] = [
                        'username' => $row['name'],
                        'phone' => $row['phone'],
                        'email' => $row['email'],
                        'id' => $row['user_id'],
                    ]; 
                    $_SESSION['status'] = "Login Success";
                    header("Location: http://localhost/Myproj/home.php");
                }
                else
                {
                    $_SESSION['status'] = 'Wrong Password';
                    header("Location: login.php");
                }
            }
            else
            {
                $_SESSION['status'] = "Email Not Verified , Verify First";
                header("Location : login.php");
            }
            
        }
        else
        {
            $_SESSION['status'] = 'Email Doesnt Exist';
            header("Location: login.php");
        }
    }
?>