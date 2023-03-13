<?php 
include "../dbConnection.php";
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
        <h1 class="logo">World<span style="color:#273b91;">Tourest</span></h1>
        </a>
        <i class="menu-toggle-btn fas fa-bars"></i>
        <nav class="nav-menu">
  <a href="../homepage/home.php"><i class="fas fa-home home"></i> Home</a>
  <a href="../TouresPages/MyOrders.php"></i> My Orders</a>
  <a href="../TouresPages/tours.php"></i> Tourest</a>
  <a href="../TouresPages/contact.php"></i> Contact</a>
  
    <a href="../TouresPages/Profile.php"></i>Profile</a>
    <a href="../TouresPages/logout.php"></i> Logout</a>
</nav>
  
    </header>
  </body>
</html>'
; 

?>