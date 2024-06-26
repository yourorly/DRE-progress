<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if(isset($_POST['SendContact'])){

    $name = $_POST['contact_name'];
    $email = $_POST['contact_email'];
    $subject = $_POST['contact_subject'];
    $message = $_POST['contact_message'];

    $mail = new PHPMailer(true);

    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->Username   = 'dummyaccdre@gmail.com';                     //SMTP username
        $mail->Password   = 'rqcdpcqjmjuyiaxp';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('dummyaccdre@gmail.com', 'Dre');
        $mail->addAddress('dummyaccdre@gmail.com', 'DRE Recipient');     //Add a recipient


        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'New enquiry - DRE';
        $mail->Body    = '<h3> Hello Looks like someone trying to contact you </h3>
        <h4><b>Name :</b> '.$name.'</h4>
        <h4><b>Email :</b> '.$email.'</h4>
        <h4><b>Subject :</b> '.$subject.'</h4>
        <h4><b>Message :</b> '.$message.'</h4>
        ';

        if ($mail->send()) {
            $_SESSION['status'] = "Thank you for contacting us";
            header("Location: {$_SERVER["HTTP_REFERER"]}");
            exit(0);
        }else{
            $_SESSION['status'] = "Thank you for contacting us";
            header("Location: {$_SERVER["HTTP_REFERER"]}");
            exit(0);
        }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}else{
    header('Location: contact.php');
    exit(0);
}


?>