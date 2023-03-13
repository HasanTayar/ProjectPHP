<?php
include "navbar.php";
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "Hasan20Diab";
$db = "project";
$conn = new mysqli($dbhost, $dbuser, $dbpass,$db);
$sql = "SELECT * FROM tours , organizerssign";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="hugo 0.108.0">
    <title>Tours</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/album/">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script>
    function OpenEdit(id) {
        $('#exampleModal').modal('show');
        document.getElementById("id").value = id;
    }
    </script>
    <style>
    /* styles for your page */
    </style>
  </head>
  <body>
    <?php echo "<div class='album py-5 bg-light'>"?>
    <div class='container'>
    <div class='row'>
        <?php
        while($row = $result->fetch_assoc()) {
         
        ?>
            <div class='col-sm-4'>
              <div class='card shadow-sm'>
              <center><h5 class='card-text'><?= $row['name'] ?></h5></center>
                <img src='<?= '../orgpages/'.$row['photo'] ?>' class='card-img-top' width='100%' height='225'/>
                <div class='card-body'>
                  <p class='card-text'><?= $row['bio'] ?></p>
                  <div class='card' style='width: 18rem;'>
                    <ul class='list-group list-group-flush'>
                      <li class='list-group-item'>Location: <?= $row['loc'] ?></li>
                      <li class='list-group-item'>price: <?= $row['price'] ?>$</li>
                      <li class='list-group-item'>Orgainzer: <?= $row['Fname']." ". $row['Lname'] ?></li>
                    </ul>
                  </div>
                  <div class='d-flex justify-content-between align-items-center'>
                    <br><br>
                    <center>
                      <div class='btn-group'>
                      <button class="btn btn-primary" onclick="location.href='payPage.php?tour_id=' + <?= $row['Tour_id'] ?>">Book Now</button>

                      </div>
                    </center>
                    <small class='text-muted'></small>
                  </div>
                </div>
              </div>
            </div>
        <?php
        }
    }
        ?>
        </div>
    </div>

    
  </body>
</html>
<?php

closecon($conn);
?>

