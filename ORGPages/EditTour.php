<?php
include "navbar.php";

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "Hasan20Diab";
$db = "project";
$conn = new mysqli($dbhost, $dbuser, $dbpass,$db);
$sql = "SELECT * FROM tours , organizerssign ";
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


    <style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }
    </style>
  </head>
  <body>
  <?php
$counter = 0;
while($row = $result->fetch_assoc()) {
    if($counter == 0) {
        echo "<div class='row' style='width: 70rem;'>";
    }
echo '
        <div class="col-sm-4 col-md-4 col-lg-4">
            <div class="card shadow-sm">
                <img src="'.$row['photo'].'" class="card-img-top" width="100%" height="225"/>
                <div class="card-body">
                    <p class="card-text">'.$row['bio'].'</p>
                    <div class="card" style="width: 18rem;">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Tour Location: '.$row['loc'].'</li>
                            <li class="list-group-item">price: '.$row['price'].'$</li>
                        </ul>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <br><br>
                        <center>
                            <div class="btn-group">
                            <a href="edit_tour.php?id='.$row['Tour_id'].'" class="btn btn-secondary" id="editBtn'.$counter.'">edit</a>
                            </div>
                        </center>
                        <small class="text-muted"></small>
                    </div>
                </div>
            </div>
        </div>
    ';
    if($counter == 2) {
        echo "</div>";
        $counter = 0;
    } else {
        $counter++;
    }
}

?>

    
    <script src="../javascript/bootstrap.bundle.min.js"></script>
    <script type="text/javascript"  src="https://apiv2.popupsmart.com/api/Bundle/399149" async></script>
  </body>
</html>
<?php
     
}

else{
    echo "0 results";
}


        
$conn->close();
?>