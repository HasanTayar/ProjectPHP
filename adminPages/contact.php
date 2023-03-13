<?php
include "navbar.php";
include "../dbConnection.php";
$conn=openCon();
$query = "SELECT organizerssign.Fname, organizerssign.Lname, organizerssign.photoOR, contact.message_id, contact.message, organizerssign.Email as email FROM organizerssign JOIN contact ON organizerssign.Email = contact.Email
UNION
SELECT tourestsign.Fname, tourestsign.Lname, tourestsign.photoTU, contact.message_id, contact.message, tourestsign.Email as email FROM tourestsign JOIN contact ON tourestsign.Email = contact.Email";

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contact</title>
</head>
<body>
<table class="table align-middle mb-0 bg-white">
  <thead class="bg-light">
    <tr>
      <th>Name</th>
      <th>Message ID</th>
      <th>Message</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php
      $result = mysqli_query($conn, $query);
      while($row = mysqli_fetch_assoc($result)) {
        $message_id = $row['message_id'];
        $message = $row['message'];
        $name = $row['Fname']." ".$row['Lname'];
        

       echo'
    <tr>
      <td>
        <div class="d-flex align-items-center">';
        if(!is_null($row['photoOR'])){
            echo'<img
            src="../ORGPages/'.$row['photoOR'].'"
            alt=""
            style="width: 45px; height: 45px"
            class="rounded-circle"
            /> ';
        } elseif (!is_null($row['photoTU'])){
            echo'<img
            src="../ORGPages/'.$row['photoTU'].'"
            alt=""
            style="width: 45px; height: 45px"
            class="rounded-circle"
            /> ';
        }
        
        echo'
          <div class="ms-3">
            <p class="fw-bold mb-1">'.$name.'</p>';
            
                echo' <p class="text-muted mb-0">'.$row['email'].'</p>';
            
           
            
          echo'</div>
        </div>
      </td>
      <td>
        <p class="fw-normal mb-1">'.$message_id.'</p>
        
      </td>
      <td>
      <p class="fw-normal mb-1">'.$message.'</p>
        </td>';
        if(isset($row['message_id'])){
            echo '<td><a href="reply.php?msg_id=' . $row['message_id'] . '">Reply</a> | <a href="deletecontact.php?msg_id=' . $row['message_id'] .'">Delete</a></td>';
        }
echo'        
      </td>
    </tr>';

    

      }
      ?>

</tbody>
</table>

</body>
</html>