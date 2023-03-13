<?php include "navbar.php";
        include "../dbConnection.php";
        $conn=opencon();
       
        ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/profilecard.css " rel="stylesheet">
    <title>tourest</title>
</head>
<body>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<div class="container">
    <div class="row">
        <?php
         $sql="SELECT * FROM tourestsign";
         $result = mysqli_query($conn, $sql);
         while($row = mysqli_fetch_assoc($result)) {
        ?>
            <div class="col-md-4">
                <div class="profile-card-4 text-center">
                    <img src="../touresPages/<?= $row['photoTU']?>" class="img img-responsive" style="height:250px; width:300px;">
                    <div class="profile-content">
                        <div class="profile-name"><?= $row['Fname'].' '.$row['Lname']?>
                            <p><?= $row['Email']?></p>
                        </div>
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="profile-overview">
                                    <p>Birthday</p>
                                    <h4><?= $row['Birthday']?></h4></div>
                            </div>
                            <div class="col-xs-4">
                                <div class="profile-overview">
                                    <p>phone</p>
                                    <h4><?= $row['phone']?></h4></div>
                            </div>
                            <div class="col-xs-4">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

</body>
</html>
