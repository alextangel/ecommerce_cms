<?php
    /**
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

    include 'forbidden.php';

    // if username and password were submitted, check them
    if (isset($_POST["producttypeid"]) && isset($_POST["productname"]) && isset($_POST["price"]) && isset($_POST["imagesrc"]))
    {
      //check distinc username
     
        // prepare SQL
        $sql = sprintf("INSERT INTO msproduct (producttypeid, productname, price, imagesrc, isNew, description) VALUES ('%s', '%s', '%s', '%s', '%s', '%s')",
                       mysql_real_escape_string($_POST["producttypeid"]),
                       mysql_real_escape_string($_POST["productname"]),
                       mysql_real_escape_string($_POST["price"]),
                       mysql_real_escape_string($_POST["imagesrc"]),
                       1,
                       mysql_real_escape_string($_POST["description"]));

        // execute query
        $result = mysql_query($sql);
        if ($result === false)
            die("Could not query database");

        // redirect user to home page, using absolute path, per
        // http://us2.php.net/manual/en/function.header.php
        $host = $_SERVER["HTTP_HOST"];
        $path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
        header("Location: http://$host$path/product.php");
        exit;
        
    }    
    else
    {
      echo "Please fill the required fields!";
    }

    
?>

<!DOCTYPE html>

<html>
  <head>
    <title>Insert New Product</title>
    <link href="css/bootstrap.css" rel="stylesheet"/>
  </head>
  <body>
    <?php include 'headerAdmin.php' ?>
      <div class="container"> 
        <h1>Insert New Product</h1>
        <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
          <table>
            <tr>
              <td>Type:</td>
              <td>
                <select name="producttypeid">
                  <option value='0'>Cake</option>
                  <option value='1'>Macaroon</option>
                </select>
            </tr>
            <tr>
              <td>Name:</td>
              <td><input name="productname" type="text"></td>
            </tr>
            <tr>
              <td>Price:</td>
              <td><input name="price" type="text"></td>
            </tr>
             <tr>
              <td>Image Source:</td>
              <td><input name="imagesrc" type="text"></td>
            </tr> 
            <tr>
              <td>Description:</td>
              <td><textarea name="description" rows="3"></textarea></td>
            </tr> 
             <tr>
              <td></td>
              <td><input type="submit" value="Submit" class='btn btn-warning'></td>
            </tr>           
          </table>
        </form> 
      </div>     
  </body>
</html>
