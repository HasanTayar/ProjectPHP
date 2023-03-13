<?php
include "../dbConnection.php";
include "navbar.php";
$conn=opencon();
session_Start();
$id=$_SESSION['adminID'];
if(isset($_FILES['photo'])){
    $errors= array();
    $file_name = $_FILES['photo']['name'];
    $file_size =$_FILES['photo']['size'];
    $file_tmp =$_FILES['photo']['tmp_name'];
    $file_type=$_FILES['photo']['type'];
    $file_ext = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
    $extensions= array("jpeg","jpg","png");
    $new_file_name = uniqid('', true) . '.' . $file_ext; 
    if(in_array($file_ext,$extensions)=== false){
        $errors[]="extension not allowed, please choose a JPEG or PNG file.";
    }
    if($file_size > 2097152){
        $errors[]='File size must be less than 2 MB';
    }
    if(empty($errors)==true){
        $destination = "images/" . $new_file_name;
        if(move_uploaded_file($file_tmp, $destination)){
            $sql = "UPDATE admins SET photoADMIN='$destination' WHERE id=$id";
            if ($conn->query($sql) === TRUE) {
             header("Location: profile.php");
            } else {
              echo "Error updating record: " . $conn->error;
            }
        }else{
            echo "Error uploading file";
        }
    }else{
        print_r($errors);
    }
}

$conn->close();
?>
