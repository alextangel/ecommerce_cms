<?php
    /**
     * register.php
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

    $validation = true;
    // if username and password were submitted, check them
    if (!empty($_POST["username"]) && !empty($_POST["pass"]) && !empty($_POST["pass1"]) && !empty($_POST["fullname"]) && !empty($_POST["address"]) && !empty($_POST["address"]) && !empty($_POST["telephone"]) && !empty($_POST["email"]))
    {
      $notice = array();
      //check distinc username
      $q = sprintf("SELECT username FROM msuser WHERE username='%s'",
           mysql_real_escape_string($_POST["username"]));
      $check = mysql_query($q);

      if(mysql_num_rows($check) >= 1)
      {
        $notice["notAvailable"] = "username is not available!";
        $validation = false;
        
      }

      if(strlen($_POST["pass"]) < 6)
      { 
        $notice['lengthPass'] = "password must be more than 5 characters!";
        $validation = false;
      }

      if($_POST["pass"] !== $_POST["pass1"])
      {
        $notice['notMatch'] = "password is not match!";
        $validation = false;

      }

      if(strtolower(substr($_POST["address"], 0, 6)) !== 'street')
      {
        $notice['freak'] = "address must be started with street!";
        $validation = false;

      }

      if(strlen($_POST["telephone"]) < 6 && is_numeric($_POST["telephone"]) == false)
      {
        $notice['telephone'] = "telephone must be a number and more than 5 digits!";
        $validation = false;

      }

      if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
      {
        $notice['email'] ="email is not valid!"; 
        $validation = false;
      } 

      if($validation == true){
        // prepare SQL
        $sql = sprintf("INSERT INTO msuser (UserName, Pass, FullName, Address, Telephone, Email, RoleID) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s')",
                       mysql_real_escape_string($_POST["username"]),
                       mysql_real_escape_string($_POST["pass"]),
                       mysql_real_escape_string($_POST["fullname"]),
                       mysql_real_escape_string($_POST["address"]),
                       mysql_real_escape_string($_POST["telephone"]),
                       mysql_real_escape_string($_POST["email"]),
                       '1');

        // execute query
        $result = mysql_query($sql);
        if ($result === false)
            die("Could not query database");

        $host = $_SERVER["HTTP_HOST"];
        $path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
        header("Location: http://$host$path/registered.php");
        exit;
      }
        
    }    
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
      $notice['dead'] = "Please fill all the fields!";
      $validation = false;
    }
    else
      $validation = false;
        
?>

<!DOCTYPE html>

<html>
  <head>
    <link href="css/bootstrap.css" rel="stylesheet"/>
    <link href="css/login.css" rel="stylesheet">   
    <title>Register</title>
  </head>
  <body>
      <?php include 'header.php';?>
      <div class="container">
        <h1>Registration</h1>
          <span class="label label-important">
        <?php echo (isset($notice['dead'])) ? $notice['dead'] : "";?>
          </span>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
          <table>
            <tr>
              <td>Username</td>
              <td>
                <input name="username" type="text"><span class="label label-important"><?php echo (isset($notice['notAvailable'])) ? $notice['notAvailable'] : "";?></span></td>
            </tr>
            <tr>
              <td>Password</td>
              <td><input name="pass" type="password"><span class="label label-important"><?php echo (isset($notice['lengthPass'])) ? $notice['lengthPass'] : "";?></span></td>
            </tr>
            <tr>
              <td>Confirm Password</td>
              <td><input name="pass1" type="password"><span class="label label-important"><?php echo (isset($notice['notMatch'])) ? $notice['notMatch'] : "";?></span></td>
            </tr>
             <tr>
              <td>Full Name</td>
              <td><input name="fullname" type="text"></td>
            </tr> 
            <tr>
              <td>Address</td>
              <td><input name="address" type="text"><span class="label label-important"><?php echo (isset($notice['freak'])) ? $notice['freak'] : "";?></span></td>
            </tr>   
            <tr>
              <td>Telephone</td>
              <td><input name="telephone" type="text"><span class="label label-important"><?php echo (isset($notice['telephone'])) ? $notice['telephone'] : "";?></span></td>
            </tr>
            <tr>
              <td>Email</td>
              <td><input name="email" type="text"><span class="label label-important"><?php echo (isset($notice['email'])) ? $notice['email'] : "";?></span></td>
            </tr>
            <tr>
              <td></td>
              <td><input type="submit" value="Register" class="btn btn-large btn-primary"></td>
            </tr>
          </table>
        </form>  
      </div>  
  </body>
</html>
