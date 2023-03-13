<?php
include "../dbConnection.php";
include "navbar.php";
if(session_id() == '' || !isset($_SESSION)) {
  session_start();
}
$conn=opencon();
if(isset($_POST['save'])){
  if(isset($_SESSION['adminID']) && isset($conn)){
    $id=$_SESSION['adminID'];
    $phone=$_POST['phone'];
    $bdate = date('Y-m-d',strtotime($_POST['date']));
$sql = "UPDATE admins SET  bday= DATE_FORMAT('$bdate', '%Y-%m-%d'), phone='$phone' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
      header("Location: profile.php");
    } else {
      echo "Error updating record: " . $conn->error;
    }

    $conn->close();
  }
}
?>
