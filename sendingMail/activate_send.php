<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include "../dbConnection.php";
$conn=openCon();
require_once '../PHPMailer-master/src/PHPMailer.php';
require_once '../PHPMailer-master/src/Exception.php';
require_once '../PHPMailer-master/src/SMTP.php';
$Email= $_POST['email'];
    $sql = "UPDATE organizerssign SET activity = 1 WHERE Email ='$Email'";
    $conn->query($sql);
    if($conn->query($sql) === TRUE){
 
// Create an instance; Pass `true` to enable exceptions 
$mail = new PHPMailer; 

// Server settings 
//$mail->SMTPDebug = SMTP::DEBUG_SERVER;    //Enable verbose debug output 
$mail->isSMTP();                            // Set mailer to use SMTP 
$mail->Mailer = "smtp";
$mail->Host = 'smtp.gmail.com';           // Specify main and backup SMTP servers 
$mail->SMTPAuth = true;                     // Enable SMTP authentication 
$mail->Username = 'Hasantayar1602@gmail.com';       // SMTP username 
$mail->Password = 'kncgfbomqjzcyfte';         // SMTP password 
$mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted 
$mail->Port = 587;                          // TCP port to connect to 
 
// Sender info 
$mail->setFrom('Hasantayar1602@gmail.com', 'WorldTours'); 
//$mail->addReplyTo('reply@example.com', 'SenderName'); 
 
// Add a recipient 

$mail->addAddress($Email); 
 
//$mail->addCC('cc@example.com'); 
//$mail->addBCC('bcc@example.com'); 
 
// Set email format to HTML 
$mail->isHTML(true); 
 
// Mail subject 
$mail->Subject = 'WorldTours-Activated'; 


// Mail body content 
$bodyContent = '<h1>Congrat You Have Been Activated!</h1>'; 
$bodyContent .= '<p>Your Email Has Been Activated by The Admin Gratz on that <br> Now You Can Post Your Own Tours And Accept Private Toures!</p>'; 
$mail->Body    = $bodyContent; 
 
// Send email 
if(!$mail->send()) { 
    echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo; 
} else { 
    header("Location:../adminpages/Orgainzer.php");
    exit;
}


    }

closecon($conn);
