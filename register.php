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
    <title>Register - ChitChat by DonaldKellett</title>
    <link rel="stylesheet" href="assets/css/main.css" />
  </head>
  <body>
    <div id="wrapper">
      <?php require 'header.php'; ?>
      <div id="main">
        <?php if ($_COOKIE['logged_in'] == "true") { ?>
          <div class="row">
            <div class="full">
              <h2>Already Logged In</h2>
              <p>
                You are already logged in to your account, no need to register :)
              </p>
            </div>
          </div>
        <?php } else { ?>
          <div class="row">
            <div class="full">
              <h2>Register</h2>
              <p>
                If you do not have an account already, feel free to fill in the form below to register for a new account.
              </p>
              <form action="create_account.php" method="post">
                <div class="row">
                  <div class="six">
                    <p>
                      <input type="text" name="username" placeholder="Enter a username here ... " />
                    </p>
                  </div>
                  <div class="six">
                    <p>
                      <input type="password" name="password" placeholder="Enter a password here ... " />
                    </p>
                  </div>
                  <div class="twelve">
                    <p>
                      <input type="submit" class="button rounded" value="Register" />
                    </p>
                  </div>
                </div>
              </form>
            </div>
          </div>
        <?php } ?>
        <hr />
        <?php require 'footer.php'; ?>
      </div>
    </div>
  </body>
</html>
