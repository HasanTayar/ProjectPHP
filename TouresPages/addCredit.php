<?php 

include "navbar.php";
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "Hasan20Diab";
$db = "project";
$conn = new mysqli($dbhost, $dbuser, $dbpass,$db);
session_start();
$email = $_SESSION['Email'];
if(isset($_POST['add-credit'])){
$cardholder=$_POST['username'];
$cardnumber=$_POST['cardNumber'];
$month=$_POST['month'];
$year=$_POST['year'];
$cvv=$_POST['cvv'];
$type=$_POST['type'];
$sql="INSERT INTO payment_tourest (VisaOwnerEmail ,type,CreditcardNumber,cvv,Expirationdate,CardHolder) VALUES
('$email','$type','$cardnumber','$cvv','$year-$month-01','$cardholder')";
if($conn->query($sql) === TRUE){
$vaild="Card Added Succsufly";
}else{
   $error="SomeThing Went Wrong PLease Re type Your Detials";
}

}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <center>
<div class="card-body p-5" style="width:50rem;">

<div class="tab-content">
<div class="tab-pane fade show active" id="nav-tab-card">
    <?php if(isset($vaild)){
        echo'<p class="alert alert-success">'.$vaild.'</p>';
    }elseif(isset($error)){
        echo'<p class="alert alert-danger">'.$error.'</p>';
    }
    ?>
	
	<form role="form" method="POST" action="addCredit.php">
	<div class="form-group">
		<label for="username">Full name (on the card)</label>
		<input type="text" class="form-control" name="username" placeholder="" required="">
	</div> <!-- form-group.// -->

	<div class="form-group">
		<label for="cardNumber">Card number</label>
		<div class="input-group">
			<input type="number" class="form-control" name="cardNumber" placeholder="">
			<div class="input-group-append">
				<span class="input-group-text text-muted">
					<i class="fab fa-cc-visa"></i>   <i class="fab fa-cc-amex"></i>   
					<i class="fab fa-cc-mastercard"></i> 
				</span>
			</div>
		</div>
	</div> <!-- form-group.// -->

	<div class="row">
	    <div class="col-sm-8">
	        <div class="form-group">
	            <label><span class="hidden-xs">Expiration</span> </label>
	        	<div class="input-group">
	        		<input type="number" class="form-control" placeholder="MM" name="month">
		            <input type="number" class="form-control" placeholder="YY" name="year">
	        	</div>
	        </div>
	    </div>
	    <div class="col-sm-4">
	        <div class="form-group">
	            <label data-toggle="tooltip" title="" data-original-title="3 digits code on back side of the card">CVV <i class="fa fa-question-circle"></i></label>
	            <input type="number" class="form-control" name="cvv"required="">
	        </div> <!-- form-group.// -->
            <div class="col-sm-4">
            <div class="form-group">
	            <label data-toggle="tooltip" title="" data-original-title="">Type </label>
	            <select name="type" id="">
                    <option value="visa">visa</option>
                    <option value="Mastercard">Mastercard</option>
                    <option value="American Express">American Express</option>
                </select>
	        </div> <!-- form-group.// -->
	    </div>
</div>
	</div> <!-- row.// -->
	<button class="subscribe btn btn-primary btn-block" type="sumbit" name="add-credit"> Confirm  </button>
	</form>
</div> <!-- tab-pane.// -->
<div class="tab-pane fade" id="nav-tab-paypal">
<p>Paypal is easiest way to pay online</p>
<p>
<button type="button" class="btn btn-primary"> <i class="fab fa-paypal"></i> Log in my Paypal </button>
</p>
<p><strong>Note:</strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. </p>
</div>
<div class="tab-pane fade" id="nav-tab-bank">
<p>Bank accaunt details</p>
<dl class="param">
  <dt>BANK: </dt>
  <dd> THE WORLD BANK</dd>
</dl>
<dl class="param">
  <dt>Accaunt number: </dt>
  <dd> 12345678912345</dd>
</dl>
<dl class="param">
  <dt>IBAN: </dt>
  <dd> 123456789</dd>
</dl>
<p><strong>Note:</strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. </p>
</div> <!-- tab-pane.// -->
</div> <!-- tab-content .// -->

</div> <!-- card-body.// -->
</article> <!-- card.// -->


	</aside> <!-- col.// -->
</div> <!-- row.// -->

</div> 
</center>
<!--container end.//-->
</body>
</html>
<?php closecon($conn);?>