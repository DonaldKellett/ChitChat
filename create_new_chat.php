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
    <title>Create New Chat - ChitChat by DonaldKellett</title>
    <link rel="stylesheet" href="assets/css/main.css" />
  </head>
  <body>
    <div id="wrapper">
      <?php require 'header.php'; ?>
      <div id="main">
        <?php if ($_COOKIE['logged_in'] == 'true') {
          $verify_acc = $conn->query("SELECT * FROM accounts WHERE username = " . htmlspecialchars_decode("&quot;") . $_COOKIE['username'] . htmlspecialchars_decode("&quot;") . " AND login_id = " . $_COOKIE['login_id']);
          if ($verify_acc->num_rows == 1) {
            while ($user = $verify_acc->fetch_assoc()) {
              if ($user['rank'] > 1) {
                $second_user = $_GET['username'];
                $get_user2_query = $conn->query("SELECT * FROM accounts WHERE username = " . htmlspecialchars_decode("&quot;") . $second_user . htmlspecialchars_decode("&quot;") . ";");
                if ($get_user2_query->num_rows == 1) {
                  if ($conn->query("INSERT INTO chats (user1, user2) VALUES (" . htmlspecialchars_decode("&quot;") . $_COOKIE['username'] . htmlspecialchars_decode("&quot;") . ", " . htmlspecialchars_decode("&quot;") . $second_user . htmlspecialchars_decode("&quot;") . ");") == true) { ?>
                    <h2>Chat Successfully Created</h2>
                    <p>
                      Please return to <a href="my_chats.php">"My Chats"</a> to view and enter your new chat.
                    </p>
                  <?php } else { ?>
                    <h2>Internal Server Error</h2>
                    <p>
                      Sorry, an error occurred.  Please send an email, <b>including the error report below</b>, to <a href="mailto:dleung@connect.kellettschool.com">dleung@connect.kellettschool.com</a>.
                    </p>
                    <p>
<pre><code><?php echo $conn->error; ?></code></pre>
                    </p>
                  <?php }
                } else { ?>
                  <h2>User Not Found</h2>
                  <p>
                    Sorry, we couldn't find the user you were attempting to start a new chat with.  Are you sure you entered his/her name right?
                  </p>
                  <p>
                    <a href="index.php" class="button">Start Over</a>
                  </p>
                <?php }
              } else { ?>
                <h2>Access Denied</h2>
                <p>
                  Sorry, a banned user (i.e. YOU) may not create new chats.
                </p>
                <p>
                  <a href="index.php" class="button">Return</a>
                </p>
              <?php }
            }
          } else { ?>
            <h2>Invalid Cookies Detected</h2>
            <p>
              Please <a href="logout.php">log out</a> and log in again properly using the login form.
            </p>
          <?php }
        } else { ?>
          <h2>Login Required</h2>
          <p>
            You must be logged in to create a new chat.
          </p>
          <p>
            <a href="login.php" class="button">Log In</a>
          </p>
        <?php } ?>
        <hr />
        <?php require 'footer.php'; ?>
      </div>
    </div>
  </body>
</html>
