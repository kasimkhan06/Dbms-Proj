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
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
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
        echo "Message has been sent";
    }


    if(isset($_POST['register_btn']))
    {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $verify_token = md5(rand());

        // TO check if the email already exists
        $check_email_query = "SELECT email FROM users WHERE email = '$email' LIMIT 1";
        $check_email_query_run = mysqli_query($con , $check_email_query);

        //Email Already Exists
        if(mysqli_num_rows($check_email_query_run) > 0)
        {
            $_SESSION['status'] = "Email Already Exists";
            header('Location: register.php');
        }
        else
        {
            //Insert The Record in the DB
            //do password hashing
            $hashed_password = password_hash($password , PASSWORD_DEFAULT);
            $query = "INSERT INTO users (name , phone , email , password , verify_token) VALUES ('$name' , '$phone' , '$email' , '$hashed_password' , '$verify_token')";      
            $query_run = mysqli_query($con , $query);

            if($query_run)
            {
                sendemail_verify("$name" , "$email" , "$verify_token");
                $_SESSION['status'] = "Registration Successfull , Please Verify Your Email Address";
                header("Location: register.php");
            }
            else
            {
                $_SESSION['status'] = "Registration Failed";
                header("Location: register.php");
            }

        }
    
    }

?>