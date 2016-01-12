<header id="header">
  <div id="logo">
    <h1><a href="index.php">ChitChat</a></h1>
  </div>
  <div id="nav">
    <?php if ($_COOKIE['logged_in'] == "true") { ?>
      <a href="profile.php">My Profile</a> | <a href="my_chats.php">My Chats</a><?php
      $verify_acc = $conn->query("SELECT * FROM accounts WHERE username = " . htmlspecialchars_decode("&quot;") . $_COOKIE['username'] . htmlspecialchars_decode("&quot;") . " AND login_id = " . $_COOKIE['login_id']);
      if ($verify_acc->num_rows == 1) {
        while ($my_acc = $verify_acc->fetch_assoc()) {
          if ($my_acc['rank'] > 2) { ?> | <a href="mod_admin.php">Mod/Admin Panel</a> | <a href="all_chats.php">Moderate Chats</a><?php }
        }
      }
      ?> | <a href="logout.php">Logout</a>
    <?php } else { ?>
      <a href="login.php">Login</a> | <a href="register.php">Register</a>
    <?php } ?>
  </div>
</header>
