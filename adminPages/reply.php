<?php
include "navbar.php";
include "../dbconnection.php";
$conn=opencon();
// Get message_id from URL

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$message_id = $_GET['msg_id'];

// Query the database for message with the specified message_id
$query = "SELECT * FROM contact WHERE message_id = $message_id";
$result = mysqli_query($conn, $query);
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Check if query returns a result
if (mysqli_num_rows($result) > 0) {
  // Store result in $row variable
  $row = mysqli_fetch_assoc($result);
  $email = $row['Email'];
  $query_name = "SELECT Fname FROM tourestsign WHERE email = '$email' UNION SELECT Fname FROM organizerssign WHERE email = '$email'"; 
  $name_result = mysqli_query($conn, $query_name);
  if (mysqli_num_rows($name_result) > 0) {
    $name_row = mysqli_fetch_assoc($name_result);
    $name = $name_row['Fname'];
  } else {
    echo "Error: Name not found";
    exit();
  }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Reply to Contact</title>
  </head>
  <body>
    <div class="container">
      <h1 class="text-center">Reply to Contact</h1>
      <form action="../sendingMail/send_reply.php" method="post">
        <div class="form-group">
          <label for="to">To</label>
          <input type="text" class="form-control" id="to" name="to" value="<?php echo $email; ?>" readonly>
        </div>
        <div class="form-group">
          <label for="subject">Subject</label>
          <input type="text" class="form-control" id="subject" name="subject" value="Replay To Your Message"readonly>
        </div>
        <div class="form-group">
          <label for="message">Message</label>
          <textarea class="form-control" id="message" name="message" rows="3"></textarea>
        </div>
        <input type="hidden" name="message_id" value="<?php echo $row['message_id']; ?>">
        <button type="submit" class="btn btn-primary" name="Send">Send</button>
      </form>
    </div>
  </body>
</html>

