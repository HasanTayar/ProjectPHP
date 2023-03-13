<?php
include_once "../dbConnection.php";

$conn = OpenCon();
if(isset($_POST['logeinOR'])){
    // Retrieve the posted values
    $email = $_POST['OrganizerEmail'];
    $password = $_POST['OrganizerPass'];
    // Verify the entered username and password against the database
    $sql = "SELECT * FROM organizerssign WHERE Email='$email' AND Pass='$password'";
          
    $result = mysqli_query($conn, $sql);
    if($sql){
    $count = mysqli_num_rows($result);
    $row=mysqli_fetch_assoc($result);
    // If the entered credentials match a row in the database, the count will be 1
    if ($count > 0) {
      // The login is valid, so start a new session and save the username
      session_start();
      $_SESSION['fname'] =$row['Fname'];
      $_SESSION['lname'] =$row['Lname'];
      $_SESSION['Email'] =  $email;
     header('Location: ../homepage/home.php');
      exit;
    }
    header('Location: ../Opages/login.php');
  }
}


   
?>