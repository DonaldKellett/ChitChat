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
    <title>Login - ChitChat by DonaldKellett</title>
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
                You are already logged in to your account, no need to login again :)
              </p>
            </div>
          </div>
        <?php } else { ?>
          <div class="row">
            <div class="full">
              <h2>Log In</h2>
              <p>
                Fill in the form below to login.
              </p>
              <form action="login_setcookie.php" method="post">
                <div class="row">
                  <div class="six">
                    <p>
                      <input type="text" name="username" placeholder="Username" />
                    </p>
                  </div>
                  <div class="six">
                    <p>
                      <input type="password" name="password" placeholder="Password" />
                    </p>
                  </div>
                  <div class="twelve">
                    <p>
                      <input type="submit" class="button" value="Log In" />
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
