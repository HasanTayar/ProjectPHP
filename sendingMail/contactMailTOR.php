<?php 
include "../dbConnection.php";
session_Start();
$conn=opencon();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../PHPMailer-master/src/PHPMailer.php';
require_once '../PHPMailer-master/src/Exception.php';
require_once '../PHPMailer-master/src/SMTP.php';
$Email= $_SESSION['Email'];
$Name= $_SESSION['fname'];
$msg=$_POST['message'];
if(isset($_POST['contact'])){
    $sql = "INSERT INTO contact (Email, Contact_name, message)
    VALUES ('$Email' , '$Name' , '$msg')";
    if($conn->query($sql) === TRUE){


$email=$_SESSION['Email'];

$sql = "SELECT * FROM  tourestsign where Email = '$email'";
$data ="SELECT * FROM contact where Email = '$email'";

$result = $conn->query($sql);
$res = $conn->query($data);

if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
if ($res->num_rows > 0) {
while($row2 = $res->fetch_assoc()) {
 
 
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

$mail->addAddress($row['Email']); 
 
//$mail->addCC('cc@example.com'); 
//$mail->addBCC('bcc@example.com'); 
 
// Set email format to HTML 
$mail->isHTML(true); 
 
// Mail subject 
$mail->Subject = 'WorldTours-Contact'; 


// Mail body content 
$bodyContent = '<h1>Contact Replay</h1>'; 
$bodyContent .= '<p>Hi , '.$row['Fname'].'.<br> We Will Contact You on <br><b style="color:blue;">72 Hour<b> Please be Patience <br> <b style="color:red;">Your Ticket Id is: '.$row2['message_id'].'</b></p>'; 
$mail->Body    = $bodyContent; 
 
// Send email 
if(!$mail->send()) { 
    echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo; 
} else { 
    header("Location:../TouresPages/contact.php");
    exit;
}
break;
}
break;
}
}
}
}
else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}
closecon($conn);
