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
    <title>Ban User - ChitChat by DonaldKellett</title>
    <link rel="stylesheet" href="assets/css/main.css" />
  </head>
  <body>
    <div id="wrapper">
      <?php require 'header.php'; ?>
      <div id="main">
        <?php if ($_COOKIE['logged_in'] == 'true') {
          $verify_acc = $conn->query("SELECT * FROM accounts WHERE username = " . htmlspecialchars_decode("&quot;") . $_COOKIE['username'] . htmlspecialchars_decode("&quot;") . " AND login_id = " . $_COOKIE['login_id']);
          if ($verify_acc->num_rows == 1) {
            while ($my_acc = $verify_acc->fetch_assoc()) {
              if ($my_acc['rank'] > 2) {
                $username = $_GET['username'];
                $get_other_user_by_username = $conn->query("SELECT * FROM accounts WHERE username = " . htmlspecialchars_decode("&quot;") . $username . htmlspecialchars_decode("&quot;") . ";");
                if ($get_other_user_by_username->num_rows == 1) {
                  while ($other_acc = $get_other_user_by_username->fetch_assoc()) {
                    if ($my_acc['rank'] > $other_acc['rank']) {
                      if ($other_acc['rank'] > 1) {
                        $new_rank = 1;
                        if ($conn->query("UPDATE accounts SET rank = " . $new_rank . " WHERE username = " . htmlspecialchars_decode("&quot;") . $other_acc['username'] . htmlspecialchars_decode("&quot;") . ";")) { ?>
                          <h2>Ban Successful</h2>
                          <p>
                            The action was successful and the user selected is now banned.
                          </p>
                          <p>
                            <a href="index.php" class="button special">Return</a>
                          </p>
                        <?php } else { ?>
                          <h2>Action Failed - Server Error</h2>
                          <p>
                            Sorry, an error occurred and the action was not successful.  Please send an email to <a href="mailto:dleung@connect.kellettschool.com">dleung@connect.kellettschool.com</a> notifying him of this error.  <strong>Please also include the error report below.  Thank you.</strong>
                          </p>
                          <h3>Error Report</h3>
                          <p>
<pre><code><?php echo $conn->error; ?></code></pre>
                          </p>
                        <?php }
                      } else { ?>
                        <h2>User Already Banned</h2>
                        <p>
                          The user is already banned; no need to demote him/her ;)
                        </p>
                        <p>
                          <a href="index.php" class="button rounded">Return</a>
                        </p>
                      <?php }
                    } else { ?>
                      <h2>Forbidden</h2>
                      <p>
                        Sorry, you are not allowed to execute any action on someone with a higher rank or the same rank as you.
                      </p>
                      <p>
                        <a href="index.php" class="button rounded">Return</a>
                      </p>
                    <?php }
                  }
                } else { ?>
                  <h2>User Not Found</h2>
                  <p>
                    Sorry, the user you were trying to promote was not found.
                  </p>
                  <p>
                    <a href="index.php" class="button rounded">Return</a>
                  </p>
                <?php }
              } else { ?>
                <h2>Unauthorised</h2>
                <p>
                  Sorry, you are not allowed to execute this action.
                </p>
                <p>
                  <a href="index.php" class="button rounded">Return</a>
                </p>
              <?php }
            }
          } else { ?>
            <h2>Invalid Cookies Detected</h2>
            <p>
              Sorry, invalid cookies were detected in your browser.  Please try logging out and try again.
            </p>
            <p>
              <a href="logout.php" class="button rounded">Log Out</a>
            </p>
          <?php }
        } else { ?>
          <h2>Login Required</h2>
          <p>
            You must be logged in in order to execute this action.
          </p>
          <p>
            <a href="login.php" class="button rounded">Log In</a>
          </p>
        <?php } ?>
        <hr />
        <?php require 'footer.php'; ?>
      </div>
    </div>
  </body>
</html>
