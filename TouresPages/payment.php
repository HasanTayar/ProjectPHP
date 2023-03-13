<?php

include "navbar.php";
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "Hasan20Diab";
$db = "project";
$conn = new mysqli($dbhost, $dbuser, $dbpass,$db);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
</head>
<body>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<div class="container-xl px-4 mt-4">


    <!-- Account page navigation-->
    <nav class="nav nav-borders">
        <a class="nav-link ms-0" href="profile.php" >Profile</a>
        <a class="nav-link" href="Security.php">Security</a>
        <a class="nav-link" href="Payment.php"  >Payment</a>
    </nav>
    <hr class="mt-0 mb-4">

        
    <!-- Payment methods card-->
    <div class="card card-header-actions mb-4">
        <div class="card-header">
            Payment Methods
            <a href="addCredit.php"><button class="btn btn-primary">Add Payment Methods</button></a>
            
            </button>

        </div>
        <?php
        $sql ="SELECT * FROM payment_tourest";
        $result= $conn->query($sql);
        if(mysqli_num_rows($result) > 0){
        while($row = $result->fetch_assoc()) {
            if($row['type'] == 'visa'){
                echo'<div class="card-body px-0">
                <!-- Payment method 1-->
                <div class="d-flex align-items-center justify-content-between px-4">
                    <div class="d-flex align-items-center">
                         <i class="fab fa-cc-visa fa-2x cc-color-visa"></i>
                        <div class="ms-4">
                            <div class="small">Visa ending in<b> '.substr($row['CreditcardNumber'],12,4).'</b></div>
                            <div class="text-xs text-muted">Expires '.date('M/Y',strtotime($row['Expirationdate'])).'</div>
                        </div>
                    </div>
                    <div class="ms-4 small">
                        <div class="badge bg-light text-dark me-3">Default</div>
                        <a href="#!">Edit</a>
                    </div>
                </div>';
            }elseif($row['type']=='Mastercard'){
               echo' <hr>
                <!-- Payment method 2-->
                <div class="d-flex align-items-center justify-content-between px-4">
                    <div class="d-flex align-items-center">
                        <i class="fab fa-cc-mastercard fa-2x cc-color-mastercard"></i>
                        <div class="ms-4">
                            <div class="small">Mastercard ending in '.substr($row['CreditcardNumber'],12,4).'</div>
                            <div class="text-xs text-muted">Expires '.date('M/Y',strtotime($row['Expirationdate'])).'</div>
                        </div>
                    </div>
                    <div class="ms-4 small">
                        <a class="text-muted me-3" href="#!">Make Default</a>
                        <a href="#!">Edit</a>
                    </div>
                </div>';
            }
            elseif($row['type'] == 'American Express'){
                echo'<hr>
                <!-- Payment method 3-->
                <div class="d-flex align-items-center justify-content-between px-4">
                    <div class="d-flex align-items-center">
                        <i class="fab fa-cc-amex fa-2x cc-color-amex"></i>
                        <div class="ms-4">
                            <div class="small">American Express ending in '.substr($row['CreditcardNumber'],12,4).'</div>
                            <div class="text-xs text-muted">Expires '.date('M/Y',strtotime($row['Expirationdate'])).'</div>
                        </div>
                    </div>
                    <div class="ms-4 small">
                        <a class="text-muted me-3" href="#!">Make Default</a>
                        <a href="#!">Edit</a>
                    </div>
                </div>
            </div>
        </div>';
            }
           
        } 
    }else{
        echo'<div class="d-flex align-items-center">
        <p>You Dont have any payment methods please add one</p>
        </div>
        ';
    }  
    ?>
    

</body>
</html>