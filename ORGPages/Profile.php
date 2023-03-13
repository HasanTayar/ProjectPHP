<?php include 'navbar.php';

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "Hasan20Diab";
$db = "project";
$conn = new mysqli($dbhost, $dbuser, $dbpass,$db);
$email=$_SESSION['Email'];
$sql = "SELECT * FROM 	organizerssign WHERE Email = '$email'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
   
?>

</script>
<link rel="stylesheet" type="text/css" href="../css/profile.css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<div class="container-xl px-4 mt-4">
    <!-- Account page navigation-->
    <nav class="nav nav-borders">
        <a class="nav-link active ms-0" href="profile.php" >Profile</a>
        <a class="nav-link" href="Security.php">Security</a>
        <a class="nav-link" href="payment.php" >Payment</a>
    </nav>
    <hr class="mt-0 mb-4">
    <div class="row">
        <div class="col-xl-4">
        <form method="POST" enctype="multipart/form-data" action="photoUploade.php">
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Profile Picture
                </div>
                <div class="card-body text-center">
                    <?php
                   
                    if(file_exists($row["photoOR"])) {
                        echo "<img src='".$row["photoOR"]."' alt='User Photo' width='200' height='200'>";
                        } else {
                              echo "<img src='https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png' alt='Default Photo' width='200' height='200'>";
                         }  
                    ?>
                    <!-- Profile picture help block-->
                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                    <!-- Profile picture upload button-->
                    <input class="btn btn-primary" type="file" name="photo"  id="photo" accept="image/png, image/gif, image/jpeg" hidden>
                    <label style="background-color: blue;
  color: white;
  padding: 0.5rem;
  font-family: sans-serif;
  border-radius: 0.3rem;
  cursor: pointer;
  margin-top: 1rem;" for="photo" >Upload Photo</label>
                    <button class="btn btn-primary" type="sumbit" name="Upload">Sumbit</button>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Account Details</div>
                <div class="card-body">
                    <form method="POST" action="profileUpdate/files.php" enctype="multipart/form-data">
					<div class="row gx-3 mb-3">
                            <!-- Form Group (first name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="Rating">Rating:</label>
                               <p><?php echo $row['rating']?></p>
                            </div>
                            <!-- Form Group (last name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="active">active:</label>
                                <?php
								if($row['activity']=='0'){
									echo"<p style='color:red;'>
									Not Activiate!
								  </p>";
								}else{
									echo "<p style='color:green;'>
									Activiate
								  </p>";
								}
								?>
                            </div>
                        </div>
                      
                 
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (first name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">First name</label>
                                <input class="form-control" name="Fname" type="text" placeholder="Enter your phone number" value="<?php echo $row['Fname']?>">
                            </div>
                            <!-- Form Group (last name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">Last name</label>
                                <input class="form-control" name="lname" type="text" placeholder="Enter your phone number" value="<?php echo $row['Lname']?>">
                            </div>
                        </div>
						<div class="row gx-3 mb-3">
                            <!-- Form Group (first name)-->
                            <div class="col-md-6">
                            <?php 
                            if(isset($row['country'])){
                                echo "<p> Your Currect Loaction is:<p style=color:Green;><b>".$row['country']."</b></p></p>";
                            }
                            ?>
							<label class="small mb-1" for="inputLocation">Location</label><br>
                            
                                <select name="country" id="" style="width:200px;" class="form-control">
                               
									<?php
									$data = "SELECT * FROM 	country";
									$result2 = $conn->query($data);
									if ($result2->num_rows > 0) {
										// output data of each row
										while($row2 = $result2->fetch_assoc()) {
											
											echo'<option value='.$row2["iso3"].' >'.$row2["nicename"].'</option>';
										}
									}
									?>
								</select>
                            </div>
                           
                            <div class="col-md-6">
    <label class="form-label" for="inputPhone">Cvv</label><br>
    <label class="form-label" for="inputPhone">Your Currect File is:</label><br>
   
    <bold><p style="color:blue; ">
    
    <?php 
    $email=$row["Email"];
    $sql = "SELECT * FROM organizefiles where user_Email = '$email'";
    $result2 = $conn->query($sql);
    if ($result2->num_rows > 0) {
        while($row2 = $result2->fetch_assoc()) {
            echo $row2["name"];
        }
    }else{
        echo "Error: " . $conn->error;
    }
    ?></p><bold>
    <input type="file" name="cvv" id="fileToUpload" class="form-control"value="">
</div>

					
                      
                
						
				
                        <!-- Form Group (email address)-->
                        <div class="mb-3">
    					<label class="small mb-1" for="inputEmailAddress">Email address:</label>
    						<p><?php echo $_SESSION['Email'];?></p>
  							


                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (phone number)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Phone number</label>
                                <input class="form-control" id="inputPhone" type="tel" name="phone"placeholder="Enter your phone number" value="<?php echo $row['phone']?>">
                            </div>
                            <!-- Form Group (birthday)-->
							<div class="col-md-6">
							<label for="datepicker">Select a date:</label><br>
							<input type="text" id="datepicker" class="datepicker" class="form-control" name="date" value=<?php echo $row['bday']?>>
                            </div>
                        </div>
                        <!-- Save changes button-->
                        <input class="btn btn-primary" type="submit" value="Save changes" name="save">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

	
<script>
$(document).ready(function() {
    $(".datepicker").datepicker();
});
</script>

<?php
  }
}

$conn->close();
?>