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

    $lastquery = sprintf("SELECT productid, producttypeid, productname, price, description, imagesrc FROM msproduct WHERE productid = '%s'", $_SESSION["id"]);

    $query = mysql_query($lastquery);
    $output = mysql_fetch_assoc($query);

    // if username and password were submitted, check them
    if (isset($_POST["producttypeid"]) && isset($_POST["productname"]) && isset($_POST["price"]) && isset($_POST["imagesrc"]))
    {
      //check distinc username
     
        // prepare SQL
        $sql = sprintf("UPDATE msproduct SET producttypeid = '%s', productname = '%s', price = '%s', imagesrc = '%s', isNew = '%s', description = '%s' where productid= '%s'",
                       mysql_real_escape_string($_POST["producttypeid"]),
                       mysql_real_escape_string($_POST["productname"]),
                       mysql_real_escape_string($_POST["price"]),
                       mysql_real_escape_string($_POST["imagesrc"]),
                       1,
                       mysql_real_escape_string($_POST["description"]),
                       mysql_real_escape_string($_SESSION["id"]));

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
    <title>Update Product</title>
    <link href="css/bootstrap.css" rel="stylesheet"/>
  </head>
  <body>
      <?php include 'headerAdmin.php' ?>
      <div class="container"> 
        <h1>Update Product</h1>
        <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
          <table>
            <tr>
              <td>Type:</td>
              <td>
                <select name="producttypeid">  
                  <?php if (isset($output["producttypeid"]) && $output["producttypeid"] == 1) : ?>
                  <option value='0'>Cake</option>
                  <option selected='selected' value='1'>Macaroon</option>
                 <?php else: ?>            
                  <option selected='selected' value='0'>Cake</option>
                  <option value='1'>Macaroon</option>
                  <?php endif ?> 
                </select>
            </tr>
            <tr>
              <td>Name:</td>
              <td>
                <?php if (isset($output["productname"])) : ?>
                <input type="text" name="productname" value="<?php echo htmlspecialchars($output["productname"])?>">
                <?php else: ?>
                <input name="productname" type="text">
                <?php endif ?>   
              </td>
            </tr>
            <tr>
              <td>Price:</td>
              <td>
                <?php if (isset($output["price"])) : ?>
                <input type="text" name="price" value="<?php echo htmlspecialchars($output["price"])?>">
                <?php else: ?>
                <input name="price" type="text">
                <?php endif ?>  
              </td>
            </tr>
             <tr>
              <td>Image Source:</td>
              <td>
                 <?php if (isset($output["imagesrc"])) : ?>
                <input type="text" name="imagesrc" value="<?php echo htmlspecialchars($output["imagesrc"])?>">
                <?php else: ?>             
                <input name="imagesrc" type="text">
                <?php endif ?>  
              </td>
            </tr> 
            <tr>
              <td>Description:</td>
              <td>
                 <?php if (isset($output["description"])) : ?>
                <textarea name="description" rows="3"><?php echo htmlspecialchars($output["description"])?></textarea>
                <?php else: ?>                
                <textarea name="description" rows="3"></textarea>
                <?php endif ?>  
              </td>
            </tr> 
             <tr>
              <td></td>
              <td><input type="submit" value="Submit" class='btn btn-danger'></td>
            </tr>           
          </table>
        </form>   
      </div>   
  </body>
</html>
