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
    <title>User Profile - ChitChat by DonaldKellett</title>
    <link rel="stylesheet" href="assets/css/main.css" />
  </head>
  <body>
    <div id="wrapper">
      <?php require 'header.php'; ?>
      <div id="main">
        <?php if ($_COOKIE['logged_in'] == 'true') {
          $verify_acc = $conn->query("SELECT * FROM accounts WHERE username = " . htmlspecialchars_decode("&quot;") . $_COOKIE['username'] . htmlspecialchars_decode("&quot;") . " AND login_id = " . $_COOKIE['login_id']);
          if ($verify_acc->num_rows == 1) {
            $get_user = $conn->query("SELECT * FROM accounts WHERE username = " . htmlspecialchars_decode("&quot;") . $_GET['username'] . htmlspecialchars_decode("&quot;") . ";");
            if ($get_user->num_rows == 1) {
              while ($user_acc = $get_user->fetch_assoc()) {
                ?>
                <h2><?php echo $user_acc['username']; ?> <svg width="16" height="16"><g><circle cx="8" cy="8" r="8" id="user_status" fill="#666" /></g></svg></h2>
                <script type="text/javascript">
                  var checkInterval = setInterval(function () {
                    var checkOnlineStatus = new XMLHttpRequest();
                    checkOnlineStatus.onreadystatechange = function () {
                      if (checkOnlineStatus.readyState == 4 && checkOnlineStatus.status === 200) {
                        document.getElementById("user_status").setAttribute("fill", checkOnlineStatus.responseText);
                      }
                    }
                    checkOnlineStatus.open("GET", "check_online_status.php?username=<?php echo $_GET['username']; ?>", true);
                    checkOnlineStatus.send();
                  }, 1000);
                </script>
                <!-- <div class="row" style="font-size: 24px;">
                  <div class="four">
                    <p style="font-weight: bolder;">
                      Email
                    </p>
                  </div>
                  <div class="eight">
                    <p>
                      <?php echo $user_acc['email']; ?>
                    </p>
                  </div>
                </div> -->
                <div class="row" style="font-size: 24px;">
                  <div class="four">
                    <p style="font-weight: bolder;">
                      Username
                    </p>
                  </div>
                  <div class="eight">
                    <p>
                      <?php echo $user_acc['username']; ?>
                    </p>
                  </div>
                </div>
                <div class="row" style="font-size: 24px;">
                  <div class="four">
                    <p style="font-weight: bolder;">
                      Rank
                    </p>
                  </div>
                  <div class="eight">
                    <p>
                      <?php echo $ranks[$user_acc['rank'] - 1]; ?>
                    </p>
                  </div>
                </div>
                <div class="row" style="font-size: 24px;">
                  <div class="four">
                    <p style="font-weight: bolder;">
                      Date Joined
                    </p>
                  </div>
                  <div class="eight">
                    <p>
                      <?php echo $user_acc['date']; ?>
                    </p>
                  </div>
                </div>
                <?php
              }
            } else { ?>
              <h2>User Not Found</h2>
              <p>
                Sorry, the user you requested was not found.  Are you sure you got the username correct?
              </p>
              <p>
                <a href="index.php" class="button rounded">Return</a>
              </p>
            <?php }
          } else { ?>
            <h2>Invalid Cookies Detected</h2>
            <p>
              Sorry, invalid cookies were detected in your browser.  Please log out and try again.
            </p>
            <p>
              <a href="logout.php" class="button rounded">Log Out</a>
            </p>
          <?php }
        } else { ?>
          <h2>Login Required</h2>
          <p>
            Sorry, you must be logged in in order to view the user profile of other users.
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
