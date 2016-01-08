<?php
require 'connect.php';
require 'vars.php';
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
    <title>Create Account: Processing Request - ChitChat by DonaldKellett</title>
    <link rel="stylesheet" href="assets/css/main.css" />
  </head>
  <body>
    <div id="wrapper">
      <?php require 'header.php'; ?>
      <div id="main">
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          if (!empty($_POST['username']) && !empty($_POST['password'])) {
            $username = htmlspecialchars(stripslashes(trim($_POST['username'])));
            $password = htmlspecialchars(stripslashes(trim($_POST['password'])));
            $check_for_duplicate = $conn->query("SELECT * FROM accounts WHERE username = " . htmlspecialchars_decode("&quot;") . "" . $username . "" . htmlspecialchars_decode("&quot;") . ";");
            if ($check_for_duplicate->num_rows == 0 /* If exactly ZERO rows of data are returned with the matching username this means that the username provided is unique and thus the account can be created */) {
              $login_id = rand();
              $rank = 2; // Initial rank is always "Member"
              $status = "offline"; // User is not logged in
              $stmt = $conn->prepare("INSERT INTO accounts (username, password, login_id, rank, status) VALUES (?, ?, ?, ?, ?);");
              $stmt->bind_param("ssiis", $username, $password, $login_id, $rank, $status);
              $stmt->execute();
              ?>
              <h2>Registration Successful - Account Created</h2>
              <p>
                Your account has been created.  Hope you enjoy the service :)
              </p>
              <p>
                <a href="login.php" class="button cyan">Login to your New Account</a> <a href="index.php" class="button">Return</a>
              </p>
              <?php
            } else { ?>
              <h2>Username Already Exists</h2>
              <p>
                Sorry, the username you entered already exists.  Please <a href="register.php">go back</a> and choose a new username.
              </p>
            <?php }
          } else { ?>
            <h2>Required Fields Not Filled In</h2>
            <p>
              Sorry, you have to set up a username and password in order to register for an account.  Please <a href="register.php">go back</a> and try again.
            </p>
          <?php }
        } else { ?>
          <h2>Page Accessed Through Incorrect Method</h2>
          <p>
            Sorry, you should only see this page after submitting the form in the register page.  Please <a href="register.php">go back</a> and try again.
          </p>
        <?php }
        ?>
        <hr />
        <?php require 'footer.php'; ?>
      </div>
    </div>
  </body>
</html>
