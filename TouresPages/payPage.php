<?php

include "navbar.php";
$id=$_GET['tour_id'];
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "Hasan20Diab";
$db = "project";
$conn = new mysqli($dbhost, $dbuser, $dbpass,$db);
$sql = "SELECT * FROM tours where Tour_id = '$id'";

$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
    $email1=$row['organizer_name'];
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pay Page</title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />

<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
    <form method="POST" action="sumbit_order.php">
<section style="background-color: #eee;">
  <div class="container py-5">
    <div class="card">
      <div class="card-body">
        <div class="row d-flex justify-content-center pb-5">
        <div class="col-md-7 col-xl-5 mb-4 mb-md-0">
            <div class="py-4 d-flex flex-row">
              <h5><span class="far fa-check-square pe-2"></span><b>ELIGIBLE</b> |</h5>
              <span class="ps-2">Pay</span>
              
            </div>
            <h4 class="text-success"><?php echo $row['price']?>$</h4>
            <h4><?php echo $row['name']?></h4>
            <img src="../ORGPages/<?php echo $row['photo']?>"  alt="Tour Photo" style="width:200px; height:200px;"/>
            
            <p>
            <div class="form-group"> <!-- Date input -->
        <label class="control-label" for="date"></label>
        <input type="hidden" name="tour_id" value="<?php echo $id; ?>">
        <input class="form-control" id="date" name="startDate" placeholder="MM/DD/YYY" type="date"/>
        <label class="control-label" for="date">Until</label>
        <input class="form-control" id="date" name="endDate" placeholder="MM/DD/YYY" type="date"/>
      </div>
      <br>
      <div class="form-group"> <!-- Date input -->
        <label class="control-label" for="date">Group/Single</label>
        <select name="group-single" id="">
            <option value="group">Group</option>
            <option value="Single">Single</option>
        </select>
        
      </div>
            
            <hr />
            <div class="pt-2">
              <div class="d-flex pb-2">
                <div>
                    <?php
                    
                  ?>
                </div>
                <?php
                session_start();
                $email = $_SESSION['Email'];
                $data="SELECT * FROM payment_tourest WHERE  VisaOwnerEmail = '$email'";
                $res = $conn->query($data);
                if ($res->num_rows == 0) {
                echo' <div class="ms-auto">
                  <p class="text-primary">
                    <a href="../TouresPages/addCredit.php"><i class="fas fa-plus-circle text-primary pe-1"></i>Add payment card</a>
                  </p>
                </div>
              </div>
              <p>Please Add Payment Method Payment</p>
              <p>
                This is an estimate for the portion of your order (not covered by
                insurance) due today . once insurance finalizes their review refunds
                and/or balances will reconcile automatically.
              </p>
              ';
                }else{
                    echo'<form class="pb-3">';
                    while($row2 = $res->fetch_assoc()) {
                      echo'<div class="d-flex flex-row pb-3">
                <div class="d-flex align-items-center pe-2">
                  <input class="form-check-input" type="radio" name="radioNoLabel" id="radioNoLabel1"
                    value="" aria-label="..." checked />
                </div>';
                    if($row2['type'] == 'visa'){
                      echo'
                <div class="rounded border d-flex w-100 p-3 align-items-center">
                  <p class="mb-0">
                    <i class="fab fa-cc-visa fa-lg text-primary pe-2"></i>Visa Debit
                    Card
                  </p>
                  <div class="ms-auto">*************'.substr($row2['CreditcardNumber'],12,4).'</div>
                </div>
              </div>';
                    }elseif($row2['type'] == 'Mastercard'){
                      echo'<div class="d-flex flex-row">
                    <div class="d-flex align-items-center pe-2">
                      <input class="form-check-input" type="radio" name="radioNoLabel" id="radioNoLabel2"
                        value="" aria-label="..." />
                    </div>
                    <div class="rounded border d-flex w-100 p-3 align-items-center">
                      <p class="mb-0">
                        <i class="fab fa-cc-mastercard fa-lg text-dark pe-2"></i>Mastercard
                        Office
                      </p>
                      <div class="ms-auto">*************'.substr($row2['CreditcardNumber'],12,4).'</div>
                    </div>
                  </div>';
                    }
                    elseif($row2['type'] == 'American Express'){
                        echo'<div class="d-flex flex-row">
                      <div class="d-flex align-items-center pe-2">
                        <input class="form-check-input" type="radio" name="radioNoLabel" id="radioNoLabel2"
                          value="" aria-label="..." />
                      </div>
                      <div class="rounded border d-flex w-100 p-3 align-items-center">
                        <p class="mb-0">
                          <i class="fab fa-cc-amex fa-lg text-dark pe-2"></i>American Express
                          
                        </p>
                        <div class="ms-auto">*************'.substr($row2['CreditcardNumber'],12,4).'</div>
                      </div>
                    </div>';
                      }
                  }
                  
                }
               
            }
                ?>
              </div>
            </div>
          </div>
        </div>
        <div class="d-flex justify-content-center">
          <button type="submit" class="btn btn-success px-5" name="order">Pay</button>
        </div>
      </div>
    </div>
  </div>
</section>
</form>
</body>
</html>
<?php
closecon($conn);
?>
