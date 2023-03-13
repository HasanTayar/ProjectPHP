<?php
include "navbar.php";

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "Hasan20Diab";
$db = "project";
$conn = new mysqli($dbhost, $dbuser, $dbpass,$db);  

if(isset($_POST['Save-Changes'])){
    $name = $_POST['name'];
    $bio = $_POST['bio'];

    $price = $_POST['price'];
    $loc= $_POST['loc'];
    $email=$_SESSION['Email'];
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
            $sql = "INSERT INTO tours (name,price,loc,organizer_name,photo,bio)VALUES('$name','$price','$loc','$email','$destination','$bio')";


            if ($conn->query($sql) === TRUE) {
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
    closecon($conn);
?>

