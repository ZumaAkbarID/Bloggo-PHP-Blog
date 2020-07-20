<?php
    $to = "zumaakbar.id@gmail.com";
    $subject = "Message From Bloggo";
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];
    $headers = "From: ".$email;

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

// $mail->SMTPDebug = 3;    
$mail->isSMTP();            
$mail->Host = "smtp.gmail.com";
//Set this to true if SMTP host requires authentication to send email
$mail->SMTPAuth = true;                          
//Provide username and password     
$mail->Username = "youremail@gmail.com";                 
$mail->Password = "very_sceret_password";    
$mail->SMTPSecure = "tls";                   
$mail->Port = 587;                                   

$mail->From = $email;
$mail->FromName = $name;

$mail->addAddress($to, "Admin");

$mail->isHTML(true);

$mail->Subject = "Message From Bloggo";
$mail->Body = "
                Hi, Admin you have message from $name. <br>
                Email : $email <br>
                Phone : $phone <br>
                Message : $message
              ";

try {
    $mail->send();
    echo "<script>alert('Message has been sent successfully')</script>";
} catch (Exception $e) {
    echo "<script>alert('Oh no, failed to send')</script>";
}