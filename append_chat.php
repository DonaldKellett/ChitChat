<?php
require 'connect.php';
require 'vars.php';
$id = $_GET['id'];
$m = $_GET['m'];
$current_chat_content = $conn->query("SELECT chat FROM chats WHERE id = " . $id);
while ($chat_content_current = $current_chat_content->fetch_assoc()) {
  $insert_new = "<h3>" . $_COOKIE['username'] . " said at " . date("d-m-Y h:i:sa") . ":</h3><p>" . $m . "</p>";
  $new_content = $chat_content_current['chat'] . $insert_new;
}
$conn->query("UPDATE chats SET chat = " . htmlspecialchars_decode("&quot;") . $new_content . htmlspecialchars_decode("&quot;") . " WHERE id = " . $id);
?>
