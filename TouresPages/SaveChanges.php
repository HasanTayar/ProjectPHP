<?php
include "../dbConnection.php";
include "navbar.php";
if(session_id() == '' || !isset($_SESSION)) {
  session_start();
}
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "Hasan20Diab";
$db = "project";
$conn = new mysqli($dbhost, $dbuser, $dbpass,$db);
if(isset($_POST['save'])){
  if(isset($_SESSION['Email']) && isset($conn)){
    $email=$_SESSION['Email'];
    $fname=$_POST['Fname'];
    $lname=$_POST['lname'];
    $Location=$_POST['Location'];
    $phone=$_POST['phone'];
    $bdate = date('Y-m-d',strtotime($_POST['date']));
$sql = "UPDATE tourestsign SET Fname='$fname' , Lname='$lname' , LOC='$Location', Birthday= DATE_FORMAT('$bdate', '%Y-%m-%d'), phone='$phone' WHERE Email='$email'";

    if ($conn->query($sql) === TRUE) {
      header("Location: profile.php");
    } else {
      echo "Error updating record: " . $conn->error;
    }

    $conn->close();
  }
}
?>
