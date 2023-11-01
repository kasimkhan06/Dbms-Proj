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
        $mail->Subject = 'Email Verification From Heavenly Homes';

        $email_template = "
        <h2>You Have Registered With Heavenly Homes</h2>
        <h5>Verify your email address to Login with the below given link</h5>
        <br></br>
        <a href='http://localhost/Myproj/authentication/verify_email.php?token=$verify_token'> Click me </a>";
        $mail->Body    = $email_template;

        $mail->send();
    }

    if(isset($_POST['send-btn']))
    {
        $email = $_POST['email'];
        //to check if he has registered or not
        $check_query = "SELECT* FROM users WHERE email= '$email' LIMIT 1";
        $check_query_run = mysqli_query($con , $check_query);

        if(mysqli_num_rows($check_query_run) > 0)
        {
            $row = mysqli_fetch_array($check_query_run);
            $name = $row['name'];
            $verify_token = $row['verify_token'];
            $verified_status = $row['verify_status'];
            if($verified_status)
            {
                $_SESSION['status'] = "Email is Already Verified No need to Verify Again!";
                header("Location: login.php");
            }
            else
            {
                sendemail_verify("$name" , "$email" , "$verify_token");
                $_SESSION['status'] = "'Email Sent Successfully!'";
                header("Location: login.php");
            }
        }
        else
        {
            $_SESSION['status'] = "Email Doesnt Exist Register First";
            header("Location: register.php");
        }
    }
