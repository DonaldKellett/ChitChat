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
    <title>Moderate Chats - ChitChat by DonaldKellett</title>
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
              if ($my_acc['rank'] > 2) { ?>
                <h2>Moderate All Chats</h2>
                <p>
                  Below are all the chats existing in the database.  If you find any form of inappropriate content in one (or more) of the chats, please demote/ban the user(s) involved depending on the severity of the breach.
                </p>
                <p>
                  Please note that the Global Community Chat is not involved here because you can easily moderate the Global Chat by entering it.
                </p>
                <?php
                $all_chats = $conn->query("SELECT * FROM chats ORDER BY id DESC");
                if ($all_chats->num_rows > 0) {
                  ?>
                  <table>
                    <thead>
                      <tr>
                        <th colspan="2">
                          Users Involved
                        </th>
                        <th>
                          Chat HTML
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php while ($individual_chat = $all_chats->fetch_assoc()) {
                        ?>
                        <tr>
                          <td>
                            <?php echo $individual_chat['user1']; ?>
                          </td>
                          <td>
                            <?php echo $individual_chat['user2']; ?>
                          </td>
                          <td>
                            <?php echo htmlspecialchars($individual_chat['chat']); ?>
                          </td>
                        </tr>
                        <?php
                      } ?>
                    </tbody>
                  </table>
                  <?php
                } else { ?><p style="font-style:italic;font-size:small;">There are currently no chats.</p><?php }
              } else { ?>
                <h2>Unauthorised</h2>
                <p>
                  Sorry, you are not authorised to access the contents of this page.
                </p>
                <p>
                  <a href="index.php" class="button rounded">Return</a>
                </p>
              <?php }
            }
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
            You must be logged in in order to moderate all chats.
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
