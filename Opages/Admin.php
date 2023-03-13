<!DOCTYPE html>
<?php include 'navbar.php';?>
<?php 
  include "../dbConnection.php";
  $conn=openCon();
  session_start();
  if(isset($_POST['admin'])){
      $sql="SELECT * FROM admins";
      $id = $_POST['adminID'];
      $pass = $_POST['AdminPass'];
      $f1=0;
      $f2=0;
      $result = $conn->query($sql);
      if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if(!isset($_POST['adminID']) || empty($_POST['adminID'])){
                $error = "Please enter your ID";
              }else if(!isset($_POST['AdminPass']) || empty($_POST['AdminPass'])){
                $error = "Please enter your Password";
              }
              if($id == $row['id']){
                $f1 =1;
              }if($pass == $row['Pass']){
                $f2 = 1;
              }
              if($f1 == 1 && $f2 == 1){
                header("location:../homepage/home.php");
                $_SESSION['adminID'] = $id;
              }if($f1 == 0){
                $error = "The Admin id is inncorect";
              }if($f2 == 0){
                $error= "The Admin Password is inncorect!<br>If You Forget You'r Password PLease Update at On DataBase";
              }
              if($f1 == 0 && $f2 ==0){
                $error="You'r Not An Admin!!<br> PLease Sign in From Your Sign in Form!";
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
        <img src="http://3.bp.blogspot.com/-GbpQKPDQqMk/VhiVWZKfvNI/AAAAAAAAALU/s5LpKhaOurg/s400/World%2BTour1.jpg " class="img-fluid" alt="Phone image" style="width:650px; height:500px" />
      </div>
      <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
        <form  action="admin.php" method="POST">
          <div class="form-outline mb-4">
          <input type="text" id="form1Example13" class="form-control form-control-lg" name="adminID" />
          <label class="form-label" for="form1Example13">ID</label>

          </div>
          <!-- Password input -->
          <div class="form-outline mb-4">
          <input type="password" id="form1Example23" class="form-control form-control-lg" name="AdminPass" />
          <label class="form-label" for="form1Example23">Password</label>

          </div>
          <div class="d-flex justify-content-around align-items-center mb-4">
            <?php
            if(isset($error)){
              echo'<p class="text-danger">'.$error.'</p>';
            }
            ?>
          </div>
    
          
          <!-- Submit button -->
          <button type="submit" class="btn btn-primary btn-lg btn-block" name="admin">Sign in</button>
          </form><br>
          <a class="btn btn-primary btn-lg btn-block" style="background-color: #3b5998" href="../Opages/LoginOrgainzer.php"
            role="button">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="30" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
  <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
</svg> </i>Organizer Sign
          </a>
          <a class="btn btn-primary btn-lg btn-block" style="background-color: #3b5998" href="../opages/admin.php"
            role="button">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="30" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
  <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
</svg> </i>Tourest Sign</a>

        
      </div>
    </div>
  </div>
</section>

  
   </body>
</html>
