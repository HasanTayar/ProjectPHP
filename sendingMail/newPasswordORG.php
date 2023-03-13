<?php 
include "../dbConnection.php";
function generate_password($length = 8) {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $count = mb_strlen($chars);

    for ($i = 0, $result = ''; $i < $length; $i++) {
        $index = rand(0, $count - 1);
        $result .= mb_substr($chars, $index, 1);
    }

    return $result;
}

$conn=opencon();
session_start();
$pass=generate_password();
$_SESSION['NEWPASS'] = $pass;
$email = $_SESSION['Email'];
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../PHPMailer-master/src/PHPMailer.php';
require_once '../PHPMailer-master/src/Exception.php';
require_once '../PHPMailer-master/src/SMTP.php';


$sql = "SELECT * FROM  organizerssign where Email = '$email'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {

 
 
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
$mail->Subject = 'WorldTours-Password'; 


// Mail body content 
$bodyContent = '<h1>Password Has Been Updated!!</h1>'; 
$bodyContent .= '<p>Hi , '.$row['Fname'].'.<br> Your Password For <b style="color:blue;">'.$row['Email'].'.</b><br> Hass Been Updated Because Your Entred 3 Time Password wrong attempt!
<br> Your New PassWord is: <br> <b style="color:red">'.$pass.'</b><br>Please Login With That New Password To Update New one!'; 
$mail->Body    = $bodyContent; 
 
// Send email 
if(!$mail->send()) { 
    echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo; 
} else { 
    
    $sql="UPDATE organizerssign SET Pass = '$pass' WHERE Email = '$email'";
    $conn->query($sql);
    header("Location:../opages/LoginOrgainzer.php");
    exit;
}
}
}

else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

closecon($conn);
