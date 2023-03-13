<?php 

include "navbar.php";
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "Hasan20Diab";
$db = "project";
$conn = new mysqli($dbhost, $dbuser, $dbpass,$db);
$id = $_GET['id'];
$data ="SELECT * FROM country";
$sql = "SELECT * FROM tours WHERE Tour_id = $id";
$result = $conn->query($sql);
$result2 = $conn->query($data);
while($row = $result->fetch_assoc()) {
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

<form action="saveTourChange" method="POST" enctype="multipart/form-data">
<center>
<div class="col-sm-4 col-md-4 col-lg-4">
<input type="text" name="id" value="<?php echo $row['Tour_id']?>" hidden>
            <div class="card shadow-sm">
                <img src="<?php echo $row["photo"]?>" class="card-img-top" width="100%" height="225" />
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
                <input type="text" name="name" value="<?php echo $row["name"]?>"><br>
                <label class="small mb-1" for="Description">Description:</label><br>
                    <textarea name="bio" id="bio" cols="30" rows="10"><?php  echo $row['bio'] ?></textarea><br>
                    <label class="small mb-1" for="inputLastName">Location:</label>
                    <select name="loc" id="" style="width:200px;" class="form-control"><?php 
                            while($row2 = $result2->fetch_assoc()) {
											
                                echo'<option value='.$row2["nicename"].' >'.$row2["nicename"].'</option>';
                            }
                        
                        ?>
                        </select> 
                        <label class="small mb-1" for="inputLastName">price:</label><br>
                        <input type="text" name="price" value="<?php echo $row["price"]?>">
                        
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <br><br>
                        
                            <div class="btn-group">
                            <input type="submit"name="Save-Changes" value="Save Changes" class="btn btn-primary">
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