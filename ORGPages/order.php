<?php
include "navbar.php";

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "Hasan20Diab";
$db = "project";
$conn = new mysqli($dbhost, $dbuser, $dbpass,$db);
$current_date = new DateTime();
$current_date_timestamp = $current_date->getTimestamp();
if(!isset($_SESSION['Email'])){
    header("Location: login.php");
    exit();
}

$email = $_SESSION['Email'];
$sql = "SELECT * FROM orders WHERE organzierMail = '$email'";
$result = $conn->query($sql);


if ($result && $result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
     



  

        echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <div class="container mt-5">
<div class="row ">

<div class="card-deck">

<div class="card" style="width: 20rem;">
<img src='.$row['photo'].' class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">'.$row['tour_name'].'</h5>
    <ul class="list-group list-group-flush">
    
    <li class="list-group-item">Location:'.$row['location'].'</li>
    <li class="list-group-item">Tour Type:'.$row['group_single'].'</li>
    <li class="list-group-item">Tour Date:<br>'.$row['startdate']." - ".$row['enddate'].'</li>
    <li class="list-group-item">Orderd By:'.$row['tourest_name'].'</li>
    <li class="list-group-item">Email To Contact:<br>'.$row['tourest_Mail'].'</li>
    <li class="list-group-item">price:'.$row['price'].'$</li>
  </ul>';
      if($row['statutes_tourest'] == 0 && $row['statutes_orgainzer'] == 0){
        echo'<form method="POST">
        <input type="hidden" name="tour_id" value='.$row['order_id'].'">
     <button type="sumbit" name="accept" class="btn btn-success">Accept</button>
     <button type="sumbit" name="Reject" class="btn btn-danger">Reject</button>
      </form>
    </div>
  </div>';
      }elseif($row['statutes_tourest'] == 1 && $row['statutes_orgainzer'] == 1){
      echo'<ul class="list-group list-group-flush">
      <li class="list-group-item"><p class="text-success">You Accepted The Order! <br> <b>We Will Update Your Rating After After The Tour End<b></p>
      </li>
      </ul>';
      }
      elseif($row['statutes_tourest'] == 2 && $row['statutes_orgainzer'] == 2){
        echo'<ul class="list-group list-group-flush">
        <li class="list-group-item"><p class="text-danger"><b>You Reject The Order We Hope You Have A Good Reason!<b></p>
        </li>
        </ul>';
        }
        elseif($row['statutes_tourest'] == 3 && $row['statutes_orgainzer'] == 3){
          echo'<ul class="list-group list-group-flush">
          <li class="list-group-item"><p class="text-warning"><b>The Tour is Done<br> PLease Wait Until We Got Feedback From The Tourest<b></p>
          </li>
          </ul>';
          }
          elseif( $row['statutes_orgainzer'] == 4){
            echo'<ul class="list-group list-group-flush">
            <li class="list-group-item"><p class="text-success"><b>We Got The Feedback From The Tourest <br> Your Rating has Benn Updated!<b></p>
            </li>
            </ul>';
            }
    
    

else{
    echo "No orders found for the logged in organizer";
}
$pdo=opencon();
if(isset($_POST['accept'])){
  $id=$_POST['tour_id'];
  $stmt = $pdo->prepare("UPDATE orders SET statutes_tourest = 1 , statutes_orgainzer = 1 WHERE organzierMail = ? and order_id = ?");
  $stmt->bind_param('si', $email,$id);
  if($stmt->execute()){
      // success, do nothing
  }else{
      echo "Error updating record: " . $stmt->error;
  }
}
elseif(isset($_POST['Reject'])){
  $id=$_POST['tour_id'];
  $stmt = $pdo->prepare("UPDATE orders SET statutes_tourest = 2 , statutes_orgainzer = 2 WHERE organzierMail = ? and order_id = ?");
  $stmt->bind_param('si', $email,$id);
  if($stmt->execute()){
      // success, do nothing
  }else{
      echo "Error updating record: " . $stmt->error;
  }
}


$enddate = new DateTime($row['enddate']);
$enddate_timestamp = $enddate->getTimestamp();

if ($current_date_timestamp > $enddate_timestamp) {
    $order_id = $row['order_id'];
    $update_status_query = "UPDATE orders SET statutes_tourest = 3, statutes_orgainzer = 3 WHERE order_id = '$order_id'";
    $update_status = $conn->query($update_status_query);
}




}
}


closecon($conn);
?>
