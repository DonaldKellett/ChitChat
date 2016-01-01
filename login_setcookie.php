<?php
require 'connect.php';
require 'vars.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (empty($_POST['username']) || empty($_POST['password'])) {
    $page_content = "
    <h2>Login Form Not Filled In Properly</h2>
    <p>Sorry, it seems that you left the username and/or password field(s) blank.  Please <a href='login.php'>go back</a> and try again.</p>
    ";
  } else {
    $username = htmlspecialchars(stripslashes(trim($_POST['username'])));
    $password = htmlspecialchars(stripslashes(trim($_POST['password'])));
    $get_account_details = $conn->query("SELECT * FROM accounts WHERE username = " . htmlspecialchars_decode("&quot;") . $username . htmlspecialchars_decode("&quot;") . " AND password = " . htmlspecialchars_decode("&quot;") . $password . htmlspecialchars_decode("&quot;") . ";");
    if ($get_account_details->num_rows == 1) {
      while ($account = $get_account_details->fetch_assoc()) {
        setcookie("logged_in", "true", time() + 86400, "/");
        setcookie("username", $account['username'], time() + 86400, "/");
        setcookie("login_id", $account["login_id"], time() + 86400, "/");
        $conn->query("UPDATE accounts SET status = 'online' WHERE username = " . htmlspecialchars_decode("&quot;") . $username . htmlspecialchars_decode("&quot;") . ";");
        $page_content = "
        <h2>Logging In</h2>
        <p>You will be redirected in a moment ... </p>
        <script>
        setTimeout(function () {
          window.location = 'index.php';
        }, 1000);
        </script>
        ";
      }
    } else {
      $page_content = "
      <h2>Invalid Login</h2>
      <p>Sorry, the username and/or password you provided was invalid.  Please <a href='login.php'>go back</a> and try again.</p>
      ";
    }
  }
} else {
  $page_content = "
  <h2>Page Accessed Via Incorrect Method</h2>
  <p>Sorry, you should only see this page by submitting the login form.  Please <a href='login.php'>go back</a> and try again.</p>
  ";
}
?>
<!DOCTYPE html>
<!--
  ChitChat
  An easy-to-setup Chat Platform proudly presented to you by DonaldKellett (https://github.com/DonaldKellett)
  (c) Donald Leung.  All rights reserved.
  MIT Licensed
-->
<html>
  <head>
    <meta charset="utf-8">
    <title>Logging In ... - ChitChat by DonaldKellett</title>
    <link rel="stylesheet" href="assets/css/main.css" />
  </head>
  <body>
    <div id="wrapper">
      <?php require 'header.php'; ?>
      <div id="main">
        <div class="row">
          <div class="full">
            <?php echo $page_content; ?>
          </div>
        </div>
        <hr />
        <?php require 'footer.php'; ?>
      </div>
    </div>
  </body>
</html>
