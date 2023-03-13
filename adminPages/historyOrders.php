<?php
include "navbar.php";
include "../dbConnection.php";
$conn=opencon();




$sql = "SELECT * FROM orders";
$result= $conn->query($sql);

if ($result && $result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $order_id= $row['order_id'];
        $query="SELECT * FROM feedback WHERE order_id = '$order_id'";
        $res= $conn->query($query);

  

        echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <div class="container mt-5">
<div class="row ">

<div class="card-deck">

<div class="card" style="width: 20rem;">
<img src=../orgpages/'.$row['photo'].' class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">'.$row['tour_name'].'</h5>
    <ul class="list-group list-group-flush">
    
    <li class="list-group-item">Location:'.$row['location'].'</li>
    <li class="list-group-item">Tour Type:'.$row['group_single'].'</li>
    <li class="list-group-item">Tour Date:<br>'.$row['startdate']." - ".$row['enddate'].'</li>
    <li class="list-group-item">Orderd By:'.$row['tourest_name'].'</li>
    <li class="list-group-item">Tourest Mail:<br>'.$row['tourest_Mail'].'</li>
    <li class="list-group-item">OrgainzerMail Mail:<br>'.$row['organzierMail'].'</li>
    <li class="list-group-item">price:'.$row['price'].'$</li>
  </ul>';
      if($row['statutes_tourest'] == 0 && $row['statutes_orgainzer'] == 0){
        echo'<li class="list-group-item"><p class="text-secondry">Pending..<b></p>
        </li>';
      }elseif($row['statutes_tourest'] == 1 && $row['statutes_orgainzer'] == 1){
      echo'<ul class="list-group list-group-flush">
      <li class="list-group-item"><p class="text-success">Accepted</p>
      </li>The Order! 
      </ul>';
      }
      elseif($row['statutes_tourest'] == 2 && $row['statutes_orgainzer'] == 2){
        echo'<ul class="list-group list-group-flush">
        <li class="list-group-item"><p class="text-danger"> Reject!</p>
        </li>
        </ul>';
        }
        elseif($row['statutes_tourest'] == 3 && $row['statutes_orgainzer'] == 3){
          echo'<ul class="list-group list-group-flush">
          <li class="list-group-item"><p class="text-warning"><b>Done<b></p>
          </li>
          </ul>';
          }
          elseif( $row['statutes_orgainzer'] == 4){
            if ($res && $res->num_rows > 0) {
                while($row2 = $res->fetch_assoc()) {
            echo'<ul class="list-group list-group-flush">
            <li class="list-group-item"><p class="text-success"><b>Feedback:'.$row2['feedback'].'<b></p>
            </li>
            </ul>';
                }
            }
            }
    
    

else{
    echo "No orders found ";
}





}
}


closecon($conn);
?>
