<?php
$q = sprintf("SELECT username, roleid FROM msuser where username = '%s'"
          , mysql_real_escape_string($_SESSION["username"]));

$result = mysql_query($q);

$check = mysql_fetch_assoc($result);

if($check['roleid'] != 0)
{
  echo '<a href="index.php">Go Home</a><br><br>';
  die("You have no privilege access!");
}

?>