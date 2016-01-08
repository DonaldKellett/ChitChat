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
    <title>ChitChat by DonaldKellett</title>
    <link rel="stylesheet" href="assets/css/main.css" />
  </head>
  <body>
    <div id="wrapper">
      <?php require 'header.php'; ?>
      <div id="main">
        <div id="banner">
          <h2>ChitChat</h2>
          <p id="motto">
            <!-- Enter your motto/slogan here -->
            A simple and easy-to-setup chat platform that runs on AJAX (PHP)
          </p>
        </div>
        <?php
        if ($_COOKIE['logged_in'] == "true") {
          $username = $_COOKIE['username'];
          $login_id = $_COOKIE['login_id'];
          $verify_account = $conn->query("SELECT * FROM accounts WHERE username = " . htmlspecialchars_decode("&quot;") . $username . htmlspecialchars_decode("&quot;") . " AND login_id = " . $login_id);
          if ($verify_account->num_rows == 1) {
            ?>
            <h3>Other Users</h3>
            <p>
              To start a chat with another user, click on "Start New Chat" to the right of the user's username.  To view his/her profile, simply click on their username.
            </p>
            <p>
              If the user you are looking for is online, there will be a green dot next to their username.  If they are offline, there will be a grey dot next to their username.
            </p>
            <?php
            $other_users_data = $conn->query("SELECT * FROM accounts WHERE username != " . htmlspecialchars_decode("&quot;") . $username . htmlspecialchars_decode("&quot;") . ";");
            if ($other_users_data->num_rows > 0) {
              while ($other_user = $other_users_data->fetch_assoc()) {
                ?>
                <p>
                  <a href="user.php?username=<?php echo $other_user['username']; ?>"><?php echo $other_user['username']; ?></a>
                  <svg width="16" height="16">
                    <g>
                      <circle cx="10" cy="10" r="5" fill="#666" id="<?php echo $other_user['username']; ?>"></circle>
                    </g>
                  </svg>
                  <a href="create_new_chat.php?username=<?php echo $other_user['username']; ?>" class="button yellow rounded">Start New Chat With "<?php echo $other_user['username']; ?>"</a>
                  <script>
                    <?php echo $other_user['username']; ?>_interval = setInterval(function () {
                      var <?php echo $other_user['username']; ?>_xmlhttp = new XMLHttpRequest();
                      <?php echo $other_user['username']; ?>_xmlhttp.onreadystatechange = function () {
                        if (<?php echo $other_user['username']; ?>_xmlhttp.readyState === 4 && <?php echo $other_user['username']; ?>_xmlhttp.status === 200) {
                          document.getElementById("<?php echo $other_user['username']; ?>").setAttribute("fill", <?php echo $other_user['username']; ?>_xmlhttp.responseText);
                        }
                      }
                      <?php echo $other_user['username']; ?>_xmlhttp.open("GET", "check_online_status.php?username=<?php echo $other_user['username']; ?>", true);
                      <?php echo $other_user['username']; ?>_xmlhttp.send();
                    }, 1000);
                  </script>
                </p>
                <?php
              }
            } else { ?>
              <p style="font-size: smaller; font-style: italic;">
                There are currently no other users using this Service.
              </p>
            <?php }
            ?>
            <h3>Global Chat</h3>
            <p>
              In the global chat, all members (excluding those banned) are allowed to join the chat and the chat content will be visible to all members.
            </p>
            <p>
              <a href="global_chat.php" class="button magenta rounded">Enter Global Chat</a>
            </p>
            <?php
          } else { ?>
            <h2>Invalid Cookies Detected</h2>
            <p>
              Sorry, our system has detected invalid cookies in your browser.  Did you log in properly via the <a href="login.php">login</a> form?  If not please <a href="logout.php">logout</a> and log in properly again using the form.
            </p>
          <?php }
        } else { ?>
          <div class="row">
            <div class="full">
              <h2>Login Required</h2>
              <p>
                Sorry, you have to be <a href="login.php">logged in</a> to use this Service.  If you do not have an account already please <a href="register.php">register for an account</a>.
              </p>
            </div>
          </div>
        <?php }
        ?>
        <hr />
        <?php require 'footer.php'; ?>
      </div>
    </div>
  </body>
</html>
