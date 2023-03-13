<?php
if(isset($_POST['SignUpTo'])){
include '../dbConnection.php';
$conn = OpenCon();
$TourestName=$_POST['TourestName'];
$TourestLName=$_POST['TourestLName'];
$TourestEmail=$_POST['TourestEmail'];
$TourestPass1=$_POST['TourestPassword1'];
$TourestPass2=$_POST['TourestPassword2'];
if($TourestPass1 == $TourestPass2){
    $sql = "INSERT INTO tourestsign (Fname, Lname, Email , Pass , Birthday)
    VALUES ('$TourestName', '$TourestLName', '$TourestEmail','$TourestPass1',NULL)";
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
