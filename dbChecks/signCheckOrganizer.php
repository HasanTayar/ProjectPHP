<?php
if(isset($_POST['SignUpOR'])){
include '../dbConnection.php';
$conn = OpenCon();
$OrganizerName=$_POST['OrganizerName'];
$OrganizerLName=$_POST['OrganizerLName'];
$OrganizerEmail=$_POST['OrganizerEmail'];
$OrganizerPass1=$_POST['OrganizerPass1'];
$OrganizerPass2=$_POST['OrganizerPass2'];
if($OrganizerPass1 == $OrganizerPass2){
    $sql = "INSERT INTO organizerssign (Fname, Lname, Email , Pass , Birthday , rating,	country,phone,bday,activity)
    VALUES ('$OrganizerName', '$OrganizerLName', '$OrganizerEmail','$OrganizerPass1',NULL,'0',?,?,?,'0')";
}else{
    echo"Password isnt match";
    header("Location: signup.php");
}
if($conn->query($sql) === TRUE){
  $sql = "INSERT INTO old_password (Email,Currect_pass)
  VALUES ('$TourestEmail', '$TourestPass1')";
  $conn->query($sql);
  echo "New record created successfully";
  header("Location: ..\Opages\login.php");
} 
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

CloseCon($conn);
?>
