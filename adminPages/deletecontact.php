<?php
include "../dbConnection.php";
$conn = openCon();
$message_id = $_GET['msg_id'];
$sql = "DELETE FROM contact WHERE message_id ='$message_id'";
$conn->query($sql);
if($conn->query($sql) == true){
    header("location: ../adminPages/contact.php");
}else{
    echo "Error deleting record: " . $conn->error;
}

?>