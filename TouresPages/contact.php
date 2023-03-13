  <!-- Wrapper container -->
  <?php include 'navbar.php';
 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "Hasan20Diab";
 $db = "project";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db);
  if(session_id() == '' || !isset($_SESSION)) {
    session_start();
  }
  ?>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<div class="container py-4">

<!-- Bootstrap 5 starter form -->
<form id="contactForm" method="POST" action="../sendingMail/contactMailTOR.php">
  <!-- Name input -->
  <div class="mb-3">
      <label class="form-label" for="name">Name:</label>
      <!--<input class="form-control" name="name" id="name" type="text" placeholder="Name" data-sb-validations="required" />-->
      <p><b><?php echo $_SESSION['fname'];?></b></p>
    </div>

    <!-- Email address input -->
    <div class="mb-3">
      <label class="form-label" for="emailAddress">Email Address:</label>
      <!--<input class="form-control" id="emailAddress" type="email" placeholder="Email Address" data-sb-validations="required, email" />-->
      <p><b><?php echo $_SESSION['Email'];?></b></p>
    </div>

    <!-- Message input -->
    <div class="mb-3">
      <label class="form-label" for="message">Message</label>
      <textarea class="form-control" name="message" id="message" type="text" placeholder="Message" style="height: 10rem;" data-sb-validations="required"></textarea>
    </div>

    <!-- Form submit button -->
    <div class="d-grid">
      <button class="btn btn-primary btn-lg" type="submit" name="contact">Submit</button>
    </div>

  </form>

</div>