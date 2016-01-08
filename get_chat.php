<?php
require 'connect.php';
require 'vars.php';
$chat_id = $_GET['id'];
$get_chat_contents = $conn->query("SELECT * FROM chats WHERE id = " . $chat_id);
if ($get_chat_contents->num_rows == 1) {
  while ($chat_details = $get_chat_contents->fetch_assoc()) {
    echo $chat_details['chat'];
  }
}
?>
