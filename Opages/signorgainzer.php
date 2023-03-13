<?php
include "navbar.php";

// Connect to the database
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "Hasan20Diab";
$db = "project";
$conn = new mysqli($dbhost, $dbuser, $dbpass,$db);

// Check if the form has been submitted
if(isset($_POST['reg'])){
    $email = $_POST['email'];
    $Fname= $_POST['fname'];
    $pass1 = $_POST['pass1'];
    $pass2= $_POST['pass2'];
    
    // Check if email already exists
    $sql = "SELECT COUNT(*) FROM organizerssign WHERE Email = '$email'";
    $result = $conn->query($sql);
    $row = $result->fetch_row();
    $f1 = $row[0];
    
    // Check if password is at least 8 characters
    $f2 = (strlen($pass1) < 8);
    
    // Check if passwords match
    $f3 = ($pass1 != $pass2);
    
    if($f1 == 1 ){
        $error = "Email Aready Exits!";
    }
    if($f2 == 1){
        $error = "The Passsword Most be 8 and up";
    }
    if($f3 == 1){
        $error = "The Password isnt match Please Re Type!";
    }
    if($f1 == 0 && $f2 == 0 && $f3 == 0){
        // Insert new user into tourestsign table
        $sql = "INSERT INTO organizerssign(fname  , Email , Pass) VALUES
        ('$Fname' , '$email' , '$pass1')";
        $conn->query($sql);
        
        // Insert new user into old_password table
        $sql = "INSERT INTO old_password (Email , Currect_pass) VALUES ('$email' , '$pass1')";
        $conn->query($sql);
        
        $vaild="Sign Up Completed!";
        header("Refresh:2; url=loginOrgainzer.php");
    }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>signUp</title>
</head>
<body>
   
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100" style="width:50rem;">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px; width:50rem; height:40rem;">
          <div class="card-body p-md-5" style="width:50rem;">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>
                <?php 
                if(isset($error)){
                    echo '<p style="color:red;">'.$error.'</p>';

                }if(isset($vaild)){
                    echo '<p  style="color:green;">'.$vaild.'</p>';

                }
                ?>
                <form class="mx-1 mx-md-4" action="signTourest.php" method="POST">

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" id="form3Example1c" class="form-control" name="fname" placeholder="First Name Only"/>
                      <label class="form-label" for="form3Example1c" >Your Name</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="email" id="form3Example3c" class="form-control" name="email"/>
                      <label class="form-label" for="form3Example3c">Your Email</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="password" id="form3Example4c" class="form-control" name="pass1"/>
                      <label class="form-label" for="form3Example4c">Password</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="password" id="form3Example4cd" class="form-control" name="pass2" />
                      <label class="form-label" for="form3Example4cd">Repeat your password</label>
                    </div>
                  </div>


                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="sumbit" class="btn btn-primary btn-lg" name="reg">Register</button>
                  </div>

                </form>

              </div>
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                <img src="http://3.bp.blogspot.com/-GbpQKPDQqMk/VhiVWZKfvNI/AAAAAAAAALU/s5LpKhaOurg/s400/World%2BTour1.jpg"
                  class="img-fluid" alt="Sample image">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>