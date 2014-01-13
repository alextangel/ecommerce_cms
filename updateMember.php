<?php
    /**
     *
     */

    // enable sessions
    session_start();
    date_default_timezone_set('Asia/Jakarta');

    if(isset($_GET['id']))
      $_SESSION['id'] = $_GET['id'];

    // connect to database
    if (($connection = mysql_connect("localhost", "dtbrkcom_alex", "jamurkuping1")) === false)
        die("Could not connect to database");

    // select database
    if (mysql_select_db("dtbrkcom_erd", $connection) === false)
        die("Could not select database");

    include 'forbidden.php';

    $lastquery = sprintf("SELECT username, pass, fullname, address, telephone, email FROM msuser WHERE userid = '%s'", $_SESSION["id"]);

    $query = mysql_query($lastquery);
    $output = mysql_fetch_assoc($query);



$validation = true;
    // if username and password were submitted, check them
    if (!empty($_POST["username"]) && !empty($_POST["pass"]) && !empty($_POST["pass1"]) && !empty($_POST["fullname"]) && !empty($_POST["address"]) && !empty($_POST["telephone"]) && !empty($_POST["email"]))
    {
      $notice = array();
      //check distinct username
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
        $sql = sprintf("UPDATE msuser SET username = '%s', pass = '%s', fullname = '%s', address = '%s', telephone = '%s', email = '%s' where userid= '%s'",
                       mysql_real_escape_string($_POST["username"]),
                       mysql_real_escape_string($_POST["pass"]),
                       mysql_real_escape_string($_POST["fullname"]),
                       mysql_real_escape_string($_POST["address"]),
                       mysql_real_escape_string($_POST["telephone"]),
                       mysql_real_escape_string($_POST["email"]),
                       mysql_real_escape_string($_SESSION["id"]));

        // execute query
        $result = mysql_query($sql);
        if ($result === false)
            die("Could not query database");

        // redirect user to home page, using absolute path, per
        // http://us2.php.net/manual/en/function.header.php
        $host = $_SERVER["HTTP_HOST"];
        $path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
        header("Location: http://$host$path/member.php");
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
    <title>Update Member</title>
    <link href="css/bootstrap.css" rel="stylesheet"/>
  </head>
  <body>
        <?php include 'headerAdmin.php' ?>
        <div class="container">  
          <h1>Update Member</h1>
          <?php echo (isset($notice['dead'])) ? $notice['dead'] : "";?>
          <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
            <table>
              <tr>
                <td>New Username</td>
                <td>
                  <?php if (isset($output["username"])) : ?>
                  <input type="text" name="username" value="<?php echo htmlspecialchars($output["username"])?>">
                  <?php else: ?>
                  <input name="username" type="text">
                  <?php endif ?> <?php echo (isset($notice['notAvailable'])) ? $notice['notAvailable'] : "";?>  
                </td>
              </tr>
              <tr>
                <td>Password:</td>
                <td><input name="pass" type="password"><?php echo (isset($notice['lengthPass'])) ? $notice['lengthPass'] : "";?></td>
              </tr>
              <tr>
                <td>Confirm Password:</td>
                <td><input name="pass1" type="password"><?php echo (isset($notice['notMatch'])) ? $notice['notMatch'] : "";?></td>
              </tr>
               <tr>
                <td>Full Name</td>
                <td>
                   <?php if (isset($output["fullname"])) : ?>
                  <input type="text" name="fullname" value="<?php echo htmlspecialchars($output["fullname"])?>">
                  <?php else: ?>             
                  <input name="fullname" type="text">
                  <?php endif ?>  
                </td>
              </tr> 
              <tr>
                <td>Address:</td>
                <td>
                   <?php if (isset($output["address"])) : ?>
                  <textarea name="address" rows="3"><?php echo htmlspecialchars($output["address"])?></textarea>
                  <?php else: ?>                
                  <textarea name="address" rows="3"></textarea>
                  <?php endif ?>  
                </td>
              </tr> 
              <tr>
                <td>Telephone</td>
                <td>
                   <?php if (isset($output["telephone"])) : ?>
                  <input type="text" name="telephone" value="<?php echo htmlspecialchars($output["telephone"])?>">
                  <?php else: ?>             
                  <input name="telephone" type="text">
                  <?php endif ?>  
                </td>
              </tr>
              <tr>
                <td>Email</td>
                <td>
                   <?php if (isset($output["email"])) : ?>
                  <input type="text" name="email" value="<?php echo htmlspecialchars($output["email"])?>">
                  <?php else: ?>             
                  <input name="email" type="text">
                  <?php endif ?>  
                </td>
              </tr>         
               <tr>
                <td></td>
                <td><input type="submit" value="Update" class='btn btn-warning'></td>
              </tr>   
                            <tr><td style=color:red>* You must change the username. <br> &nbsp;&nbsp;&nbsp;The username cannot be the same as before.</td></tr>        
            </table>
          </form>  
      </div>    
  </body>
</html>
