
<?php
= $dbhost = "localhost";
$dbuser = "root";
$dbpass = "Hasan20Diab";
$db = "project";
$conn = new mysqli($dbhost, $dbuser, $dbpass,$db);
session_start();
$id = $_POST['tour_id'];
$conn = mysqli_connect("localhost","root","Hasan20Diab","project");
$sql="SELECT * FROM Tours where Tour_id = '$id' ";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
if(isset($_POST['order'])){
    $startdate = $_POST['startDate'];
    $enddate = $_POST['endDate'];
    $price = $row['price'];
    $tourest_name = $_SESSION['fname'].' '.$_SESSION['lname'];
    $group_single = $_POST['group-single'];
    $tourest_Mail = $_SESSION['Email'];
    $location = $row['loc'];
    $tour_name = $row['name'];
    $organzierMail = $row['organizer_name'];
    $photo = $row['photo'];
    
    $query = "INSERT INTO orders (startdate, enddate, price, tourest_name, group_single, tourest_Mail, location, tour_name, organzierMail, photo)
    VALUES ('$startdate', '$enddate', '$price', '$tourest_name', '$group_single', '$tourest_Mail', '$location', '$tour_name', '$organzierMail', '$photo')";
    
    $result = mysqli_query($conn, $query);
    
    if($result){
       header("location: Myorders.php");
    }else{
        echo mysqli_error($conn);
    }
   
}
}
closecon($conn)
?>