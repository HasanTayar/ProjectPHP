<?php 
include "navbar.php";
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "Hasan20Diab";
$db = "project";
$conn = new mysqli($dbhost, $dbuser, $dbpass,$db);
$data ="SELECT * FROM country";
$result2 = $conn->query($data);
while($row2 = $result2->fetch_assoc()) {
    
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/album/">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <title>edit Tours</title>
</head>
<body>

<form action="addTour.php" method="POST" enctype="multipart/form-data">
<center>
<div class="col-sm-4 col-md-4 col-lg-4">
            <div class="card shadow-sm">
                <img src="https://media.istockphoto.com/id/1248723171/vector/camera-photo-upload-icon-on-isolated-white-background-eps-10-vector.jpg?s=612x612&w=0&k=20&c=e-OBJ2jbB-W_vfEwNCip4PW4DqhHGXYMtC3K_mzOac0=" class="card-img-top" width="100%" height="225" />
                <input class="btn btn-primary" type="file" name="photo"  id="photo" accept="image/png, image/gif, image/jpeg" hidden>
                    <label style="background-color: blue;
  color: white;
  padding: 0.5rem;
  font-family: sans-serif;
  border-radius: 0.3rem;
  cursor: pointer;
  margin-top: 1rem;" for="photo" >Upload Photo</label>
                <div class="card-body">
                <label class="small mb-1" for="inputLastName">Tour name:</label><br>
                <input type="text" name="name" value="" placeholder="Tourest name"><br>
                <label class="small mb-1" for="Description">Description:</label><br>
                    <textarea name="bio" id="bio" cols="30" rows="10"></textarea><br>
                    <label class="small mb-1" for="inputLastName">Location:</label>
                    <select name="loc" id="" style="width:200px;" class="form-control"><?php 
                            while($row2 = $result2->fetch_assoc()) {
											
                                echo'<option value='.$row2["nicename"].' >'.$row2["nicename"].'</option>';
                            }
                        
                        ?>
                        </select> 
                        <label class="small mb-1" for="inputLastName">price:</label><br>
                        <input type="text" name="price" value="" placeholder="Price without '$'">
                        
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <br><br>
                        
                            <div class="btn-group">
                            <input type="submit"name="Save-Changes" value="Upload Tour" class="btn btn-primary">
                            </div>
                       
                        <small class="text-muted"></small>
                    </div>
                </div>
            </div>
        </div>
    
</form>
</center>
</body>
</html>
<?php
}
closecon($conn);
?>