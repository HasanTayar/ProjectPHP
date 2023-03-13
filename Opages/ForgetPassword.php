<?php include 'navbar.php';
session_start();

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "Hasan20Diab";
$db = "project";
$conn = new mysqli($dbhost, $dbuser, $dbpass,$db);
$f1 = 0 ;
$f2 = 0;
if(isset($_POST['Forget'])){
$email = $_POST['email'];

$sql = "SELECT COUNT(*) FROM organizerssign WHERE Email = '$email'";
$result = $conn->query($sql);
$row = $result->fetch_row();
$f1 = $row[0];
$sql = "SELECT COUNT(*) FROM tourestsign WHERE Email = '$email'";
$result = $conn->query($sql);
$row = $result->fetch_row();
$f2 = $row[0];
if($f1 == 0 && $f2 == 1 ){
   $_SESSION['EmailTU'] = $email ;
    header("location: ../sendingMail/FpassTu.php");
}
if($f1 == 1 && $f2 == 0){
   $_SESSION['EmailOR']  = $email  ;
    header("location: ../sendingMail/FpassOR.php");
}

}
?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>

  <body>
    <div class="container d-flex flex-column">
      <div class="row align-items-center justify-content-center
          min-vh-100">
        <div class="col-12 col-md-8 col-lg-4">
          <div class="card shadow-sm">
            <div class="card-body">
              <div class="mb-4">
                <h5>Forgot Password?</h5>
                <p class="mb-2">Enter your registered email ID to reset the password
                </p>
              </div>
              <form action="ForgetPassword.php" method="POST">
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" id="email" class="form-control" name="email" placeholder="Enter Your Email"
                    required="">
                </div>
                <div class="mb-3 d-grid">
                  <button type="submit" name="Forget" class="btn btn-primary">
                    Reset Password
                  </button>
                </div>
                <span>Don't have an account? <a href="signTourest.php">sign in</a></span>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>

</html>