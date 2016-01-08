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
    <title>Global Chat - ChitChat by DonaldKellett</title>
    <link rel="stylesheet" href="assets/css/main.css" />
  </head>
  <body>
    <div id="wrapper">
      <?php require 'header.php'; ?>
      <div id="main">
        <?php if ($_COOKIE['logged_in'] == "true") {
          $verify_acc = $conn->query("SELECT * FROM accounts WHERE username = " . htmlspecialchars_decode("&quot;") . $_COOKIE['username'] . htmlspecialchars_decode("&quot;") . " AND login_id = " . $_COOKIE['login_id']);
          if ($verify_acc->num_rows == 1) {
            while ($acc_details = $verify_acc->fetch_assoc()) {
              if ($acc_details['rank'] > 1) { ?>
                <h2>Global (Community) Chat</h2>
                <p>
                  Welcome to the community chat!  This chat is open to all registered users (except those who are banned).  Feel free to use this chat to communicate with the whole community!  Please note that all content in this chat is fully accessible to all members of the community, so make sure you do not include your private information in this chat.
                </p>
                <p>
                  Please also note that this chat is actively Moderated by the Moderators and Administrator(s) in this community.  Any user found typing inappropriate content of any sort will be demoted or banned according to the severity of the breach.
                </p>
                <hr />
                <div id="global-chat-content"></div>
                <form>
                  <!-- Fake form (for chat) -->
                  <p>
                    <textarea style="margin-top: 20px;" id="global-chat-textarea" placeholder="Feel free to type here ... "></textarea>
                  </p>
                  <p>
                    <a class="button cyan rounded" href="javascript:void(0)" onclick="sendMessage(document.getElementById('global-chat-textarea').value);document.getElementById('global-chat-textarea').value=''">Send</a> <input type="reset" id="reset" value="Erase" />
                  </p>
                </form>
                <script type="text/javascript">
                  // Initial "GET content"
                  var initReq = new XMLHttpRequest();
                  initReq.onreadystatechange = function () {
                    if (initReq.readyState === 4 && initReq.status === 200) {
                      document.getElementById("global-chat-content").innerHTML = initReq.responseText;
                    }
                  }
                  initReq.open("GET", "global_init.php", true);
                  initReq.send();
                  // Update Chat Window every 1000 milliseconds
                  var updateInterval = setInterval(function () {
                    var updateReq = new XMLHttpRequest();
                    updateReq.onreadystatechange = function () {
                      if (updateReq.readyState === 4 && updateReq.status === 200) {
                        document.getElementById("global-chat-content").innerHTML = updateReq.responseText;
                      }
                    }
                    updateReq.open("GET", "global_init.php", true);
                    updateReq.send();
                  }, 1000);
                  // Update global_chat table every time there is input - no need to output since chat is updated every 1000ms
                  function sendMessage(m) {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.open("GET", "update_global_chat.php?m=" + m, true);
                    xmlhttp.send();
                  }
                </script>
              <?php } else { ?>
                <h2>Access Denied</h2>
                <p>
                  Sorry, you are not allowed to use the Global Community Chat because you are banned.
                </p>
                <p>
                  <a class="button rounded" href="index.php">Return</a>
                </p>
              <?php }
            }
          } else { ?>
            <h2>Invalid Cookies Detected</h2>
            <p>
              Sorry, you seem not to be properly <a href="login.php">logged in</a>.  Please try <a href="logout.php">logging out</a>, log in again and try again.
            </p>
          <?php }
        } else { ?>
          <h2>Login Required</h2>
          <p>
            In order to join the global (community) chat, you must be <a href="login.php">logged in</a>.
          </p>
        <?php } ?>
        <hr />
        <?php require 'footer.php'; ?>
      </div>
    </div>
  </body>
</html>
