<!DOCTYPE html>
<?php include 'navbar.php';?>
<?php
  include "../dbConnection.php";
  $conn=openCon();
  session_start();
  if(!isset($_SESSION['cnt'])){
    $_SESSION['cnt'] = 4;
  }
  if(isset($_POST['logeinTO'])){
    if(!isset($_POST['TourEmail']) || empty($_POST['TourEmail'])){
      $error = "Please enter your Email";
    }else if(!isset($_POST['TourPass']) || empty($_POST['TourPass'])){
      $error = "Please enter your Password";
    }else{
      $email = $_POST['TourEmail'];
      $pass = $_POST['TourPass'];
      $sql="SELECT * FROM tourestsign";
      $f1=0;
      $f2=0;
      $result = $conn->query($sql);
      if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          if($row['Email'] == $email){
            $f1 = 1;
          }
          if($row['Pass'] == $pass){
            $f2 = 1;
          }
         
           if($f1 == 1 && $f2 == 1){
            $_SESSION['fname'] =$row['Fname'];
            $_SESSION['lname'] =$row['Lname'];
            $_SESSION['Email'] =  $email;
            header("location: ../homepage/home.php");
            unset($_SESSION['cnt']);
          }
          if($f1 == 0){
            $error = "The Email isn't Exist PLease SignUp First";
            header("refresh:2;url= ../Opages/SignTourest.php");
          }
        }
        if($f2 == 0){
          $_SESSION['cnt']--;
          $error ="Password wrong attempt!(".$_SESSION['cnt'].")";
          //header("refresh:2;url=../Opages/LoginTourest.php");
          if($_SESSION['cnt'] == 0){
            header("location: ../sendingMail/newPasswordTOR.php");
            $_SESSION['Email'] =  $email;
            unset($_SESSION['cnt']);

            // send email using mail() function or PHPMailer
          }
        }
      }
    }
  }

?>



<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title></title>
      <link rel="stylesheet" href="..\css\Login.css">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   </head>
   <body>
   <section class="vh-100">
  <div class="container py-5 h-100">
    <div class="row d-flex align-items-center justify-content-center h-100">
      <div class="col-md-8 col-lg-7 col-xl-6">
        <img src="http://3.bp.blogspot.com/-GbpQKPDQqMk/VhiVWZKfvNI/AAAAAAAAALU/s5LpKhaOurg/s400/World%2BTour1.jpg "
          class="img-fluid" alt="Phone image" style="width:650px; height:500px">
      </div>
      <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
        <form  action="LoginTourest.php" method="POST">
          <div class="form-outline mb-4">
          <input type="email" id="form1Example13" class="form-control form-control-lg" name="TourEmail" />
          <label class="form-label" for="form1Example13">Email address</label>

          </div>
          <!-- Password input -->
          <div class="form-outline mb-4">
          <input type="password" id="form1Example23" class="form-control form-control-lg" name="TourPass" />
          <label class="form-label" for="form1Example23">Password</label>

          </div>
          <div class="d-flex justify-content-around align-items-center mb-4">
            <?php
            if(isset($error)){
              echo'<p class="text-danger">'.$error.'</p>';
            }
            ?>
          </div>
          <div class="d-flex justify-content-around align-items-center mb-4">
            
              
            <a href="ForgetPassword.php">Forgot password?</a>
          </div>
          
          <!-- Submit button -->
          <button type="submit" class="btn btn-primary btn-lg btn-block" name="logeinTO">Sign in</button>
          </form><br>
          <a class="btn btn-primary btn-lg btn-block" style="background-color: #55acee" href="../opages/signTourest.php"
            role="button">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="30" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
  <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
</svg> </i>Tourest Sign Up</a>
          <a class="btn btn-primary btn-lg btn-block" style="background-color: #3b5998" href="../Opages/LoginOrgainzer.php"
            role="button">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="30" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
  <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
</svg> </i>Organizer Sign
          </a>
          <a class="btn btn-primary btn-lg btn-block" style="background-color: #55acee" href="../opages/admin.php"
            role="button">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="30" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
  <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
</svg> </i>Admin Sign</a>

        
      </div>
    </div>
  </div>
</section>

  
   </body>
</html>
