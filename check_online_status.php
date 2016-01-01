<?php
require 'connect.php';
require 'vars.php';
$username = $_GET['username'];
// echo $username;
$check_online_status = $conn->query("SELECT status FROM accounts WHERE username = " . htmlspecialchars_decode("&quot;") . $username . htmlspecialchars_decode("&quot;") . ";");
if ($check_online_status->num_rows == 1) {
  while ($status = $check_online_status->fetch_assoc()) {
    if ($status['status'] == 'online') {
      echo "green";
    } elseif ($status['status'] == 'offline') {
      echo "#666"; // Grey
    } else {
      echo "red";
    }
  }
} else {
  echo "red";
}
?>
