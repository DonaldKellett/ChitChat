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
    <title>Mod/Admin Panel - ChitChat by DonaldKellett</title>
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
                <h2>Moderator/Admin Panel</h2>
                <p>
                  Welcome to the Moderator/Admin Panel!  In this panel you can promote, demote and ban users in full accordance to the Terms of Service and any other rules set forth by the Administrator(s) of this Service.  If any moderator (or super moderator or administrator) is found abusing this Panel, he/she will be demoted/banned by the Administrator(s) or Owner of this Service depending on the severity of the breach.
                </p>
                <?php
                $get_underlings = $conn->query("SELECT * FROM accounts WHERE rank < " . $my_acc['rank']);
                if ($get_underlings->num_rows > 0) {
                  ?>
                  <table>
                    <thead>
                      <tr>
                        <th>
                          Username
                        </th>
                        <th>
                          Rank
                        </th>
                        <th>
                          Date Joined
                        </th>
                        <th colspan="3">
                          Actions
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php while ($under_acc = $get_underlings->fetch_assoc()) {
                        ?>
                        <tr>
                          <td>
                            <?php echo $under_acc['username']; ?>
                          </td>
                          <td>
                            <?php echo $ranks[$under_acc['rank'] - 1]; ?>
                          </td>
                          <td>
                            <?php echo $under_acc['date']; ?>
                          </td>
                          <td>
                            <a href="promote.php?username=<?php echo $under_acc['username']; ?>">Promote</a>
                          </td>
                          <td>
                            <a href="demote.php?username=<?php echo $under_acc['username']; ?>">Demote</a>
                          </td>
                          <td>
                            <a href="ban.php?username=<?php echo $under_acc['username']; ?>">Ban</a>
                          </td>
                        </tr>
                        <?php
                      } ?>
                    </tbody>
                  </table>
                  <?php
                } else { ?><p style="font-style: italic; font-size: small;">There are currently no users under your rank.</p><?php }
              } else { ?>
                <h2>Unauthorised</h2>
                <p>
                  Sorry, your rank is too low; therefore you are not authorised to use the Mod/Admin Panel.
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
            You must be logged in in order to gain access to this panel.
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
