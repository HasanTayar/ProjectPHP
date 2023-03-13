<?php
function OpenCon()
{
    try {
        $dbhost = "localhost";
        $dbuser = "root";
        $dbpass = "Hasan20Diab";
        $db = "project";
        $conn = new mysqli($dbhost, $dbuser, $dbpass,$db);
        if ($conn->connect_error) {
            throw new Exception("Failed to connect to MySQL: " . $conn->connect_error);
        }
        return $conn;
    } catch (Exception $e) {
        echo $e->getMessage();
        exit();
    }
}

 function CloseCon($conn)
 {
    if(!mysqli_ping($conn)){
        $conn->close();
 }
}
?>
