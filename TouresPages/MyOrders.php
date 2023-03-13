<?php
include "navbar.php";

session_start();
$email = $_SESSION['Email'];
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "Hasan20Diab";
$db = "project";
$conn = new mysqli($dbhost, $dbuser, $dbpass,$db);
$sql = "SELECT * FROM orders WHERE tourest_Mail = '$email'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <div class="container mt-5">
<div class="row ">

<div class="card-deck">

<div class="card" style="width: 20rem;">
<img src=../ORGPages/'.$row['photo'].' class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">'.$row['tour_name'].'</h5>
    <ul class="list-group list-group-flush">
    <li class="list-group-item">Location:'.$row['location'].'</li>
    <li class="list-group-item">Tour Date:<br>'.$row['startdate']." - ".$row['enddate'].'</li>
    <li class="list-group-item">Email To Contact:<br>'.$row['organzierMail'].'</li>
    <li class="list-group-item">price:'.$row['price'].'</li>';
    if($row['statutes_orgainzer'] == 0){
        echo '<li class="list-group-item">statutes: Pending...</li>';
        echo'</ul>
        <form method="POST">
        <center>
        <button type="sumbit" class="btn btn-danger" name="cancel">Cancel</button>
        </center>
        </form>
       </div>
     </div>';
        
    }elseif($row['statutes_orgainzer'] == 1){
        echo '<li class="list-group-item">statutes:<b> <p class="text-success">Accepted</p></b></li>';
    }
    elseif($row['statutes_orgainzer'] == 2){
      echo '<li class="list-group-item">statutes:<b> <p class="text-danger">We Really Sorry <br> The Order Has Been Cancled</p></b></li>';
  }
  
if (!isset($_SESSION['form_submitted'])) {
  $_SESSION['form_submitted'] = false;
}

if ($row['statutes_orgainzer'] == 3 && !$_SESSION['form_submitted']) {
  echo '<li class="list-group-item">statutes:<b> <p class="text-warning">The Tour Has Been Done <br> Please Fill Up The Form</p></b></li>';
  echo '<form action="submit_rating.php" method="post">
          <input type="hidden" name="order_id" value="'.$row['order_id'].'">
          <input type="hidden" name="organizer" value="'.$row['organzierMail'].'">
          <div class="form-group">
              <label for="rating">Rating:</label>
              <input type="number" name="rating" min="1" max="5" step="0.1" class="form-control">
          </div>
          <div class="form-group">
              <label for="feedback">Feedback:</label>
              <textarea name="feedback" class="form-control"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>';
}

    
 
    break;
    }
}else{
echo'<center><h1> You Dont Have any Order Please Make a Order First</h1></center>';
}
if(isset($_POST['cancel'])){
  $sql = "DELETE FROM orders WHERE tourest_Mail = '$email'";
  $result = $conn->query($sql);
  $conn->query($sql) ;
}

?>