<?php
session_start();
include "../../dbConnection.php";
$conn = OpenCon();
if(isset($_POST['save'])){

if($conn->connect_error){
    die("connection failed: ". $conn->connect_error);
}
$sql = "SELECT * FROM organizerssign";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $file = $_FILES['cvv'];
        if(isset($_FILES["cvv"])){
            $file = $_FILES["cvv"];

            $file_name = $file["name"];

            $file_tmp = $file["tmp_name"];

            $file_error = $file["error"];

            $file_size = $file["size"];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $file_path = "uploads/".$file_name;
            if($file_error === 0){
                if (!file_exists('uploads')) {
                    mkdir('uploads', 0777, true);
                }
                move_uploaded_file($file_tmp, $file_path);
                $user_email = $row['Email'];
                $sql = "SELECT * FROM organizefiles WHERE user_Email='$user_email' AND name='$file_name'";
                $result2 = $conn->query($sql);
                if ($result2->num_rows > 0) {
                    // Delete the old file before updating
                    $stmt = $conn->prepare("DELETE FROM organizefiles WHERE user_Email=? AND name=?");
                    $stmt->bind_param("ss", $user_email, $file_name);
                    $stmt->execute();
                    $stmt = $conn->prepare("UPDATE organizefiles SET path=? WHERE user_Email=? AND name=?");
                    $stmt->bind_param("sss", $file_path, $user_email, $file_name);
                    if (!$stmt->execute()) {
                        trigger_error($stmt->error, E_USER_ERROR);
                    }
                }else{
                    // Insert new file
                    $stmt = $conn->prepare("INSERT INTO organizefiles (user_Email, name, path) VALUES (?, ?, ?)");
                    $stmt->bind_param("sss", $user_email, $file_name, $file_path);
                    if (!$stmt->execute()) {
                        trigger_error($stmt->error, E_USER_ERROR);
                    }
                }
            }
        }
    }
header("location: ../Profile.php" );
}
}
closecon($conn);
?>
