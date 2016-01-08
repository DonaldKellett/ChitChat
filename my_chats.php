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
    <title>My Chats - ChitChat by DonaldKellett</title>
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
              if ($my_acc['rank'] > 1) { ?>
                <h2>My Chats</h2>
                <p>
                  Click on one of your chats to start or resume that chat!
                </p>
                <?php
                $my_chats = $conn->query("SELECT * FROM chats WHERE user1 = " . htmlspecialchars_decode("&quot;") . $_COOKIE['username'] . htmlspecialchars_decode("&quot;") . " OR user2 = " . htmlspecialchars_decode("&quot;") . $_COOKIE['username'] . htmlspecialchars_decode("&quot;") . " ORDER BY id DESC;");
                if ($my_chats->num_rows == 0) { ?>
                  <p style="font-style:italic;font-size:smaller;">
                    You currently have no chats.
                  </p>
                <?php } else {
                  ?>
                  <table>
                    <thead>
                      <tr>
                        <th>
                          ID
                        </th>
                        <th colspan="2">
                          Chat Members
                        </th>
                        <th>
                          Actions
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php while ($my_chat = $my_chats->fetch_assoc()) {
                        ?>
                        <tr>
                          <td>
                            <?php echo $my_chat['id']; ?>
                          </td>
                          <td>
                            <?php echo $my_chat['user1']; ?>
                          </td>
                          <td>
                            <?php echo $my_chat['user2']; ?>
                          </td>
                          <td>
                            <a href="chat.php?id=<?php echo $my_chat['id']; ?>">Enter Chat</a>
                          </td>
                        </tr>
                        <?php
                      } ?>
                    </tbody>
                  </table>
                  <?php
                }
                ?>
              <?php } else { ?>
                <h2>Access Denied</h2>
                <p>
                  Sorry, banned users (i.e. YOU) cannot have access to your chats.
                </p>
                <p>
                  <a href="index.php" class="button">Return</a>
                </p>
              <?php }
            }
          } else { ?>
            <h2>Invalid Cookies Detected</h2>
            <p>
              Oops, it seems that you have not logged in properly.  Please <a href="logout.php">log out</a> and try logging in again properly.
            </p>
          <?php }
        } else { ?>
          <h2>Login Required</h2>
          <p>
            Sorry, you have to be <a href="login.php">logged in</a> in order to view the contents of this page.
          </p>
        <?php } ?>
        <hr />
        <?php require 'footer.php'; ?>
      </div>
    </div>
  </body>
</html>
