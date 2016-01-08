<?php
require 'connect.php';
require 'vars.php';
$m = $_GET["m"];
if (!empty($m)) {
  $verify_account = $conn->query("SELECT * FROM accounts WHERE username = " . htmlspecialchars_decode("&quot;") . $_COOKIE['username'] . htmlspecialchars_decode("&quot;") . " AND login_id = " . $_COOKIE['login_id']);
  if ($verify_account->num_rows == 1) {
    $conn->query("INSERT INTO global_chat (username, content) VALUES (" . htmlspecialchars_decode("&quot;") . $_COOKIE['username'] . htmlspecialchars_decode("&quot;") . ", " . htmlspecialchars_decode("&quot;") . $m . htmlspecialchars_decode("&quot;") . ")");
  }
}
?>
