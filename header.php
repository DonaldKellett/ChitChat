<header id="header">
  <div id="logo">
    <h1><a href="index.php">ChitChat</a></h1>
  </div>
  <div id="nav">
    <?php if ($_COOKIE['logged_in'] == "true") { ?>
      <a href="my_chats.php">My Chats</a> | <a href="logout.php">Logout</a>
    <?php } else { ?>
      <a href="login.php">Login</a> | <a href="register.php">Register</a>
    <?php } ?>
  </div>
</header>
