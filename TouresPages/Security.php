<?php
ob_start();
if(session_id() == '' || !isset($_SESSION)) {
    session_start();
  }
include "navbar.php";
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "Hasan20Diab";
$db = "project";
$conn = new mysqli($dbhost, $dbuser, $dbpass,$db);
$email=$_SESSION['Email'];
if(isset($_POST['ChangePassword'])){
    $Cpass=$_POST['Cpass'];
    $newpass1=$_POST['newPass1'];
    $newpass2=$_POST['newPass2'];
    // Check current password
    $stmt = $conn->prepare("SELECT * FROM tourestsign WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($Cpass == $row['Pass']){
                if($newpass1 == $newpass2){
                    if(strlen($newpass1) >= 8){  
                        // Check if new password is not equal to any previous passwords
                        $stmt = $conn->prepare("SELECT * FROM old_password WHERE Email = ?");
                        $stmt->bind_param("s", $email);
                        $stmt->execute();
                        $result2 = $stmt->get_result();
                        $row2 = $result2->fetch_assoc();
                        if ($newpass1 != $row2['Currect_pass'] && $newpass1 != $row2['pass1'] && $newpass1 != $row2['pass2'] && $newpass1 != $row2['pass3']) {

                            // Update old_password table
                            $stmt = $conn->prepare("UPDATE old_password SET pass3 = pass2, pass2 = pass1, pass1 = Currect_pass, Currect_pass = ? WHERE Email = ?");
                            $stmt->bind_param("ss", $newpass1, $email);
                            $stmt->execute();
                            // Update organizerssign table
                            $stmt = $conn->prepare("UPDATE tourestsign SET Pass = ? WHERE Email = ?");
                            $stmt->bind_param("ss", $newpass1, $email);
                            $stmt->execute();
                            $vaild="The Password Has Been Update successfully";
                        }else{
                            $erorr="New password cannot be the same as 3 previous passwords.";
                        }
                    }else{
                        $erorr="The Password Length Should be 8 or up";
                    }
               }else{
                    $erorr="The Password isn't Match PLease Re-Type Your new password";
                }
                
            }else{
                $erorr="Your Correct Password isn't Correct Please Enter a Vaild Password";
            }
        }
    }

}

?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/profile.css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<div class="container-xl px-4 mt-4">
    <title>Security</title>
</head>
<body>
<div class="container-xl px-4 mt-4">
        <!-- Account page navigation-->
        <nav class="nav nav-borders">
        <a class="nav-link  ms-0" href="profile.php" >Profile</a>
        <a class="nav-link active" href="Security.php">Security</a>
        <a class="nav-link" href="payment.php" >Payment</a>
        </nav>
        <hr class="mt-0 mb-4">
        <div class="container-xl px-4 mt-4">
    <div class="row">
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header">Change Password</div>
                <div class="card-body">
                <?php if(isset($erorr)){
       echo'<p class="text-danger">'.$erorr.'</p>';
    } ?>
    <?php if(isset($vaild)){
       echo '<p class="text-success">'.$vaild.'</p>';
    } ?>
                <form method="POST" action="Security.php">
    <div class="mb-3">
        <label class="small mb-1" for="currentPassword">Current Password</label>
        <input class="form-control" id="currentPassword" type="password" name="Cpass" placeholder="Enter current password">
    </div>
    <div class="mb-3">
        <label class="small mb-1" for="newPassword">New Password</label>
        <input class="form-control" id="newPassword" type="password" name="newPass1" placeholder="Enter new password">
    </div>
    <div class="mb-3">
        <label class="small mb-1" for="confirmPassword">Confirm Password</label>
        <input class="form-control" id="confirmPassword" type="password" name="newPass2" placeholder="Confirm new password">
    </div>
   

    <button class="btn btn-primary" type="submit" name="ChangePassword">Save</button>
</form>

                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header">Delete Account</div>
                <div class="card-body">
                    <p>Deleting your account is a permanent action and cannot be undone. If you are sure you want to delete your account, select the button below.</p>
                    <button class="btn btn-danger" type="button">I understand, delete my account</button>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php
ob_end_flush();
closecon($conn);
?>
