<?php
    /**
     * login.php
     *
     */

    // enable sessions
    session_start();
    
    date_default_timezone_set('Asia/Jakarta');

    // connect to database
    if (($connection = mysql_connect("localhost", "dtbrkcom_alex", "jamurkuping1")) === false)
        die("Could not connect to database");

    // select database
    if (mysql_select_db("dtbrkcom_erd", $connection) === false)
        die("Could not select database");

    // if username and password were submitted, check them
    if (isset($_POST["username"]) && isset($_POST["pass"]))
    {

        // prepare SQL
        $sql = sprintf("SELECT username, roleid FROM msuser WHERE username='%s' AND pass='%s'",
                       mysql_real_escape_string($_POST["username"]),
                       mysql_real_escape_string($_POST["pass"]));

        // execute query
        $result = mysql_query($sql);
        if ($result === false)
            die("Could not query database");

        // check whether we found a row
        if (mysql_num_rows($result) == 1)
        {
            // remember that user's logged in
            $_SESSION["authenticated"] = true;
            $_SESSION["username"] = $_POST["username"];

            // save password in, ack, cookie for a week if requested
            if ($_POST["keep"])
                setcookie("pass", $_POST["pass"], time() + 7 * 24 * 60 * 60);			
			     
           $check = mysql_fetch_assoc($result);
            if($check["roleid"] == 0)
            {
              $host = $_SERVER["HTTP_HOST"];
              $path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
              header("Location: http://$host$path/transaction.php");
              exit;
            }
            else
            {
              $host = $_SERVER["HTTP_HOST"];
              $path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
              header("Location: http://$host$path/index.php");
              exit;
            }
        }
    }
?>

<!DOCTYPE html>

<html>
  <head>
    <link href="css/bootstrap.css" rel="stylesheet"/>
    <link href="css/login.css" rel="stylesheet">
    <title>Log In</title>
  </head>
  <body>
    <?php include 'header.php';?>
    <div class="container">
      <center><h2 class="form-signin-heading">Log In</h2></center>
      <form action='<?php echo $_SERVER["PHP_SELF"] ?>' method="POST" class="form-signin">
          <table>
            <tr>
              <td>Username</td>
              <td>
                <input name="username" class="input-block-level" placeholder="username" type="text"></td>
            </tr>
            <tr>
              <td>Password</td>
              <td><input name="pass" type="password" class="input-block-level" placeholder="password"></td>
            </tr>
            <tr>
              <td></td>     
              <td><label class="checkbox"><input name="keep" type="checkbox"> Remember me</label></td>
            </tr>
            <tr>
              <td></td>
              <td><input type="submit" value="Log In" class="btn btn-large btn-primary"></td>
            </tr>
            <tr>
              <td></td>
              <td>Not a member? <a href="register.php"><u> Register Here! </u></td>
            </tr>
          </table>      
      </form>
     </div>
  </body>
</html>
