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
    <title>Chat - ChitChat by DonaldKellett</title>
    <link rel="stylesheet" href="assets/css/main.css" />
  </head>
  <body>
    <div id="wrapper">
      <?php require 'header.php'; ?>
      <div id="main">
        <?php if ($_COOKIE['logged_in'] == "true") {
          $verify_acc = $conn->query("SELECT * FROM accounts WHERE username = " . htmlspecialchars_decode("&quot;") . $_COOKIE['username'] . htmlspecialchars_decode("&quot;") . " AND login_id = " . $_COOKIE['login_id']);
          if ($verify_acc->num_rows == 1) {
            while ($my_acc = $verify_acc->fetch_assoc()) {
              if ($my_acc['rank'] > 1) {
                $chat_id = $_GET['id'];
                $get_chat_by_id = $conn->query("SELECT * FROM chats WHERE id = " . $chat_id);
                if ($get_chat_by_id->num_rows == 1) {
                  while ($chat_details = $get_chat_by_id->fetch_assoc()) {
                    if ($chat_details['user1'] == $_COOKIE['username'] xor $chat_details['user2'] == $_COOKIE['username']) { ?>
                      <h2>Chat</h2>
                      <p>
                        Enter your message in the text area below.  To submit your message click "Send".
                      </p>
                      <hr />
                      <div id="chat-content"></div>
                      <script type="text/javascript">
                      var getChat = new XMLHttpRequest();
                      getChat.onreadystatechange = function () {
                        if (getChat.readyState === 4 && getChat.status === 200) {
                          document.getElementById("chat-content").innerHTML = getChat.responseText;
                        }
                      }
                      getChat.open("GET", "get_chat.php?id=<?php echo $chat_id; ?>", true);
                      getChat.send();
                      setInterval(function () {
                        var getChat = new XMLHttpRequest();
                        getChat.onreadystatechange = function () {
                          if (getChat.readyState === 4 && getChat.status === 200) {
                            document.getElementById("chat-content").innerHTML = getChat.responseText;
                          }
                        }
                        getChat.open("GET", "get_chat.php?id=<?php echo $chat_id; ?>", true);
                        getChat.send();
                      }, 1000);
                      </script>
                      <form>
                        <!-- Fake Form (for chat) -->
                        <p>
                          <textarea id="chat-textarea" placeholder="Enter your message here ... "></textarea>
                        </p>
                        <p>
                          <a href="javascript:void(0)" class="button rounded yellow" onclick="sendMessage(document.getElementById('chat-textarea').value);document.getElementById('chat-textarea').value=''">Send</a> <input type="reset" value="Erase" id="reset" />
                        </p>
                      </form>
                      <script>
                        function sendMessage(m) {
                          var appendChat = new XMLHttpRequest();
                          appendChat.open("GET", "append_chat.php?id=<?php echo $chat_id; ?>&m=" + m, true);
                          appendChat.send();
                        }
                      </script>
                    <?php } else { ?>
                      <h2>Access Denied</h2>
                      <p>
                        Sorry, you do not have permission to participate in this chat.
                      </p>
                      <p>
                        <a href="index.php" class="button">Return</a>
                      </p>
                    <?php }
                  }
                } else { ?>
                  <h2>Chat Does Not Exist</h2>
                  <p>
                    Sorry, the chat you selected does not exist.
                  </p>
                  <p>
                    <a href="index.php" class="button">Return</a>
                  </p>
                <?php }
              } else { ?>
                <h2>Access Denied</h2>
                <p>
                  Sorry, banned users (e.g. YOU) may not use the chat service.
                </p>
                <p>
                  <a href="index.php" class="button">Return</a>
                </p>
              <?php }
            }
          } else { ?>
            <h2>Invalid Cookies Detected</h2>
            <p>
              Sorry, invalid cookies were detected in your browser.  Please <a href="logout.php">log out</a> and try again.
            </p>
          <?php }
        } else { ?>
          <h2>Login Required</h2>
          <p>
            Sorry, you must be <a href="login.php">logged in</a> to participate in a chat.
          </p>
        <?php } ?>
        <hr />
        <?php require 'footer.php'; ?>
      </div>
    </div>
  </body>
</html>
