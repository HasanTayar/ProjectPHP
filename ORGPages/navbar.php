<?php  
include "../dbConnection.php";
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "Hasan20Diab";
$db = "project";
$conn = new mysqli($dbhost, $dbuser, $dbpass,$db);
if(session_id() == '' || !isset($_SESSION)) {
  session_start();
}

$email=$_SESSION['Email'];
$sql = "SELECT * FROM organizerssign WHERE Email='$email'";
$result = mysqli_query($conn, $sql);
while($row=mysqli_fetch_assoc($result)){
  if($row['activity']== 1){
echo'
<!DOCTYPE html>

<!-- Coding by MultiWebPress /////// https://multiwebpress.com/ -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..\css\navbarONLOGIN.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <link rel="stylesheet" href="..\css\navbarONLOGIN.css">
  </head>
  <body>
    <header>
    <a href="../homepage/home.php">
    <h1 class="logo">World<span style="color:#273b91;">Toures</span></h1>
</a>
        <i class="menu-toggle-btn fas fa-bars"></i>
        <div class="main-content">
        <nav class="nav-menu">
  <a href="../homepage/home.php"><i class="fas fa-home home"></i> Home</a>
  <a href="../ORGPages/edittour.php"></i> Edit Tours</a>
  <a href="../ORGPages/order.php"></i> Orders</a>
  <a href="../ORGPages/contact.php"></i> Contact</a>
    <a href="../ORGPages/Profile.php"></i>Profile</a>
    <a href="../ORGPages/addyourtours.php"></i>Tours</a>
    <a href="../ORGPages/logout.php"></i> Logout</a>
</nav>
      </div>
      </div>
    </header>
  </body>
</html>'
; 
  }
  else{
    echo'
    <!DOCTYPE html>
    
    <!-- Coding by MultiWebPress /////// https://multiwebpress.com/ -->
    <html lang="en" dir="ltr">
      <head>
        <meta charset="utf-8">
        <title> </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="..\css\navbarONLOGIN.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
        <link rel="stylesheet" href="..\css\navbarONLOGIN.css">
      </head>
      <body>
        <header>
        <div class="main-content">
        <a href="../homepage/home.php">
        <h1 class="logo">World<span style="color:#273b91;">Toures</span></h1>
    </a>
            <i class="menu-toggle-btn fas fa-bars"></i>
            <nav class="nav-menu">
      <a href="../homepage/home.php"><i class="fas fa-home home"></i> Home</a>
      <a href="../ORGPages/contact.php"></i> Contact</a>
        <a href="../ORGPages/Profile.php"></i>Profile</a>
        <a href="../ORGPages/logout.php"></i> Logout</a>
    </nav>
          </div>
          </div>
        </header>
      </body>
    </html>';
  }
}
closecon($conn);

?>