<?php
    session_start();
    include('../includes/dbcon.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require 'vendor/autoload.php';

    //mibqzllfbcmcmdiy
    function sendemail_verify($name , $email , $verify_token)
    {
        //Our Email Part
        $mail = new PHPMailer(true);
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through

        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication

        $mail->Username   = 'heavenlyhomes.proj@gmail.com';                     //SMTP username
        $mail->Password   = 'mibqzllfbcmcmdiy';                               //SMTP password
        $mail->SMTPSecure = "tls";                                  //Enable implicit TLS encryption
        $mail->Port       = 587;   


        //to Send Part
        $mail->setFrom('heavenlyhomes.proj@gmail.com', 'heavenly Homes');
        $mail->addAddress($email, $name);     //Add a recipient
        $mail->addReplyTo('heavenlyhomes.proj@gmail.com');

        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Password Change Request';

        $email_template = "
        <h2>Password Reset</h2>
        <h5>click The Below Link To Reset Password</h5>
        <br></br>
        <a href='http://localhost/Myproj/authentication/reset_pass.php?token=$verify_token&email=$email'> Click me </a>";
        $mail->Body    = $email_template;

        $mail->send();
    }

    if(isset($_POST['send-btn']))
    {
        $email = $_POST['email'];

        //to check if the email is registered or not
        $query = "SELECT* FROM users WHERE email = '$email' LIMIT 1";
        $query_run = mysqli_query($con , $query);

        if(mysqli_num_rows($query_run) > 0)
        {   
            //To check if the Email was verified or not;
            $row = mysqli_fetch_array($query_run);

            $verify_status = $row['verify_status'];
            if($verify_status)
            {
                $email = $row['email'];
                $name = $row['name'];
                $verify_token = $row['verify_token'];

                sendemail_verify("$name" , "$email" , "$verify_token");
                $_SESSION['status'] = "Password Reset Link Sent Successful";
                header("Location: forgot_pass.php");
            }
            else
            {
                $_SESSION['status'] = "Email is Not Verfied Verify First!";
                header("Location: login.php");
            }
        }
        else
        {
            $_SESSION['status'] = "Email is Not Registered , Register First!";
            header("Location: register.php");
        }
    }


    if(isset($_POST['reset-btn']))
    {   
        //get all details
        $email = mysqli_real_escape_string($con , $_POST['email']);
        $password = mysqli_real_escape_string($con , $_POST['password']);
        $conf_password = mysqli_real_escape_string($con , $_POST['conf-password']);
        $token = mysqli_real_escape_string($con , $_POST['token']);

        //to check if the token is valid or not
        //fetch details
        $query = "SELECT* FROM users WHERE email = '$email' LIMIT 1";
        $query_run = mysqli_query($con , $query);

        if($query_run)
        {
            $row = mysqli_fetch_array($query_run);
            $db_token = $row['verify_token'];

            if($token == $db_token)
            {
                //to check if the password and confirm password are same or not
                if($password == $conf_password)
                {
                    //to hash the password
                    $hashed_password = password_hash($password , PASSWORD_DEFAULT);

                    //update the password
                    $query = "UPDATE users SET password = '$hashed_password' WHERE email = '$email'";
                    $query_run = mysqli_query($con , $query);

                    if($query_run)
                    {
                         //change token
                        $new_token = md5(rand());
                        $token_change = "UPDATE users SET verify_token = '$new_token' WHERE email = '$email'";
                        $token_change_run = mysqli_query($con , $token_change);
                        if($token_change_run)
                        {
                            $_SESSION['status'] = "Password Changed Successfully";
                            header("Location: login.php");
                        }
                        else
                        {
                            $_SESSION['status'] = "Something Went Wrong";
                            header("Location: forgot_pass.php");
                        }
                        $_SESSION['status'] = "Password Changed Successfully";
                        header("Location: login.php");
                    }
                    else
                    {
                        $_SESSION['status'] = "Something Went Wrong";
                        header("Location: forgot_pass.php");
                    }

                }
                else
                {
                    $_SESSION['status'] = "Password and Confirm Password Does Not Match";
                    header("Location: forgot_pass.php");
                }
            }
            else
            {
                $_SESSION['status'] = "Invalid Token";
                header("Location: forgot_pass.php");
            }
        }
        else
        {
            $_SESSION['status'] = "Something Went Wrong";
            header("Location: forgot_pass.php");
        }

    }

?>