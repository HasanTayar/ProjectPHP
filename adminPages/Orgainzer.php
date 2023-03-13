<?php include "navbar.php";
include "../dbConnection.php";
$conn=opencon();
$cnt = 0;
$sql="SELECT * FROM organizerssign";
$result = mysqli_query($conn, $sql);
      while($row = mysqli_fetch_assoc($result)) {
        if($cnt == 0){
            echo'<div class=row>';
        }
        $email = $row['Email'];
        $query="SELECT * FROM organizefiles WHERE user_Email = '$email'";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/profilecard.css" rel="stylesheet">
    <title>Organizer's</title>
</head>
<body>
<div class="col-md-4">
    <div class="profile-card-4 text-center"><img src="../ORGPAGES/<?= $row['photoOR']?>" class="img img-responsive" style="height:250px; width:300px;">
        <div class="profile-content">
            <div class="profile-name"><?= $row['Fname'].' '.$row['Lname']?>
                <p><?= $row['Email']?></p>
            </div>
            <?php
            $res = mysqli_query($conn, $query);
            while($row2 = mysqli_fetch_assoc($res)) {
                if(isset($row2['path'])){
                    
                    echo"<div class='profile-overview'>
                  <a href='../orgpages/profileUpdate/".$row2['path']."'><b>Download The cvv</b></div>";
                }else{
                    echo "No Cvv Yet";
                }
            
            ?>
            
            <div class="row">
                <div class="col-xs-4">
                    <div class="profile-overview">
                        <p>Rating</p>
                        <h4><?= $row['rating']?></h4></div>
                </div>
                <div class="col-xs-4">
                    <div class="profile-overview">
                        <p>phone</p>
                        <h4><?= $row['phone']?></h4></div>
                </div>
                <div class="col-xs-4">
                    <div class="profile-overview">
                    <p>Activity</p>
                    
                        <?php
                        if(isset($row2['path']) && $row['activity'] == 1){
                           echo' 
                           <h4>Activated!</h4>
                            ';
                        }else if(!isset($row2['path']) && $row['activity'] == 0){
                            echo' 
                           <h4>Not Activited!</h4>
                            ';
                        }if(isset($row2['path']) && $row['activity'] == 0){
                            echo '<form action ="../sendingMail/activate_send.php" method="POST">
                            <input type="hidden" type="text" name="email"value='.$row['Email'].'>
                            <button type="sumbit" class="btn btn-primary name="activ">Acitvate</button>
                           </form> ';

                        }
                        
                        ?>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
  </div>
</div>
</body>
<?php
      }
      $cnt++;
      if($cnt == 3){
        echo '</div>';
      }
    }
    
?>
</html>