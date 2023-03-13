<?php

session_start();
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "Hasan20Diab";
$db = "project";
$conn = new mysqli($dbhost, $dbuser, $dbpass,$db););
if(isset($_POST['order_id'])){
    $order_id = $_POST['order_id'];
    $rating = $_POST['rating'];
    $feedback = $_POST['feedback'];
    $email = $_POST['organizer'];
    //get the current rating
    $sql = "SELECT rating FROM organizerssign WHERE Email = '$email'";
    $result = $conn->query($sql);
    $current_rating = 0;
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $current_rating = $row['rating'];
    }
    // update the rating
    $new_rating = $rating;
    $update_rating_query = "UPDATE organizerssign SET rating = '$new_rating' WHERE Email = '$email'";
    $insert_feedback_query = "INSERT INTO feedback (order_id, feedback) VALUES ('$order_id', '$feedback')";
    if (!$conn->query($update_rating_query)) {
        echo "Error updating rating: " . $conn->error;
    }
    if (!$conn->query($insert_feedback_query)) {
        echo "Error inserting feedback: " . $conn->error;
    }
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    $_SESSION['form_submitted'] = true;
    if($conn->query($insert_feedback_query) == true && $conn->query($update_rating_query) ==true ){
        if ($_SESSION['form_submitted'] == true) {
            $update_statutes_query = "UPDATE orders SET statutes_orgainzer = 4 WHERE order_id = '$order_id'";
            if (!$conn->query($update_statutes_query)) {
                echo "Error updating statutes: " . $conn->error;
            }
        }
        header("location:../homepage/home.php");
    }
}
