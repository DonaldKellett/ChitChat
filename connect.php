<?php
$conn = new mysqli("localhost", "root", "root", "chitchat");
if ($conn->connect_error) {
  ?>Connection to Database Failed!  <?php echo $conn->connect_error; ?><?php
}
?>
