<?php
require 'connect.php';
require 'vars.php';

$username = $_COOKIE['username'];
$conn->query("UPDATE accounts SET status='offline' WHERE username = " . htmlspecialchars_decode("&quot;") . $username . htmlspecialchars_decode("&quot;") . ";");

// Just delete all cookies no matter what :)
setcookie("logged_in", "false", time() - 86400, "/");
setcookie("username", "", time() - 86400, "/");
setcookie("login_id", "", time() - 86400, "/");
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
    <title>Logging Out ... - ChitChat by DonaldKellett</title>
    <link rel="stylesheet" href="assets/css/main.css" />
  </head>
  <body>
    <div id="wrapper">
      <?php require 'header.php'; ?>
      <div id="main">
        <div class="row">
          <div class="full">
            <h2>Logging Out</h2>
            <p>
              You will be redirected in a moment ...
            </p>
            <script type="text/javascript">
              setTimeout(function () {
                window.location = 'index.php';
              }, 1000);
            </script>
          </div>
        </div>
        <hr />
        <?php require 'footer.php'; ?>
      </div>
    </div>
  </body>
</html>
