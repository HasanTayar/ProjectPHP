<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include "../dbConnection.php";
$conn=openCon();
require_once '../PHPMailer-master/src/PHPMailer.php';
require_once '../PHPMailer-master/src/Exception.php';
require_once '../PHPMailer-master/src/SMTP.php';
$Email= $_POST['to'];
$id = $_POST['message_id'];
$msg= $_POST['message'];
  
 
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
$mail->Subject = 'WorldTours-ReplayToContact'; 


// Mail body content 
$bodyContent = '<h1>Replay</h1>'; 
$bodyContent .= '<p>'.$msg.'.</p><br>The Ticket id:'.$id.' Hass Benn Clused'; 
$mail->Body    = $bodyContent; 
 
// Send email 
if(!$mail->send()) { 
    echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo; 
} else { 
    $sql = "DELETE FROM contact WHERE message_id ='$id'";
    $conn->query($sql);
    if($conn->query($sql) === TRUE){
    header("Location:../adminpages/contact.php");
    exit;
}


    }

closecon($conn);
