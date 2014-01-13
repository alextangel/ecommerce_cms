<?php
    /**
     * logout.php
     *
     */

    // enable sessions
    session_start();
    
    date_default_timezone_set('Asia/Jakarta');

    $_SESSION["authenticated"] = false;
    // delete cookies, if any
    setcookie("username", "", time() - 3600);
    setcookie("pass", "", time() - 3600);

    // log user out
    setcookie(session_name(), "", time() - 3600);
    session_destroy();
?>

<!DOCTYPE html>

<html>
  <head>
    <link href="css/bootstrap.css" rel="stylesheet"/>
    <title>Log Out</title>
  </head>
  <body>
    <div class="container">
      <h1>You have been logged out!</h1>
      <a class="m-btn purple big" href="index.php">Home<i class="m-icon-big-swapright m-icon-white"></i></a>
    </div>
  </body>
</html>