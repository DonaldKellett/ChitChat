<?php
require 'connect.php';
require 'vars.php';
$get_all_global = $conn->query("SELECT * FROM global_chat");
if ($get_all_global->num_rows == 0) { ?>
  <p>
    The chat is currently empty.  Why don't you start off the chat?
  </p>
<?php } else {
  while ($global_row = $get_all_global->fetch_assoc()) { ?>
    <h4><a href="user.php?username=<?php echo $global_row['username']; ?>"><?php echo $global_row['username']; ?></a> said at <?php echo $global_row['date']; ?>:</h4>
    <p>
      <?php echo $global_row['content']; ?>
    </p>
  <?php }
}
?>
