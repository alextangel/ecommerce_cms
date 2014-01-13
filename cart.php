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

      if( !isset($_SESSION['authenticated']) || $_SESSION['authenticated'] != true)
      {
        echo '<a class="m-btn purple big" href="index.php">Home<i class="m-icon-big-swapright m-icon-white"></i></a><br>';
        die("Please, login first!");
      }


      if (isset($_GET["id"]) && isset($_GET["qty"]))
      {
          // prepare SQL
          $sql = sprintf("SELECT productname from msproduct where productid = %s",
                         mysql_real_escape_string($_GET["id"]));

          // execute query
          $result = mysql_query($sql);
          if ($result === false)
              die("Could not query database");

          $out = mysql_fetch_assoc($result);

          if (!is_array(@$_SESSION['list'])){
            $_SESSION['list'] = array();
          }
           $_SESSION['list'][] = $out["productname"];

           if (!is_array(@$_SESSION['qty'])){
            $_SESSION['qty'] = array();
          }
           $_SESSION['qty'][] = $_GET["qty"];

           if (!is_array(@$_SESSION['id'])){
            $_SESSION['id'] = array();
          }
           $_SESSION['id'][] = $_GET["id"];

 
      }    

      if(isset($_SESSION['id']) && !empty($_SESSION['id']))
      {

         if(isset($_GET["delete"]))
        {
          unset($_SESSION['list'][$_GET["delete"]]);
          unset($_SESSION['qty'][$_GET["delete"]]);
          unset($_SESSION['id'][$_GET["delete"]]);
        }

          if(isset($_GET["update"]))
          $_SESSION['qty'][$_GET["loc"]] = $_GET["update"];


         if(isset($_POST['clearall']))
        {
          $_SESSION['list'] = array();
          $_SESSION['qty'] = array();
          $_SESSION['id'] = array();
        }
     }
     else
     {
        echo '<a class="m-btn purple big" href="index.php">Home<i class="m-icon-big-swapright m-icon-white"></i></a><br>';
        die("Cart is empty!");
     }

    
?>

<!DOCTYPE html>

<html>
  <head>
    <link href="css/bootstrap.css" rel="stylesheet"/>
    <title>Cart</title>
  </head>
  <body>
      <?php include 'header.php';?>
      <div class="container">
      <h1>Cart</h1>
      <ul class="thumbnails">
          <li class="span4">
            <table cellpadding='8'>
              <thead>
                <td>Product Name</td>
              </thead>
<?php
    //echo count($_SESSION['list']);
      //print_r($_SESSION['list']);
    
      foreach($_SESSION['list'] as $i=>$value)
      {
          echo '<tr>';
          echo "<td>" . $value . "</td>";
          echo '</tr>';
        
      }
          echo "</table>";

          echo '</li>';
          echo '<li class="span4">';
          echo "<table cellpadding='6'";
          echo "              <thead>
                <td>Qty</td><td colspan='2'>Action</td>
              </thead>";

       foreach($_SESSION['qty'] as $i=>$value)
      {
          echo '<tr>';

          echo "<form action=" . $_SERVER["PHP_SELF"] . ' method="get">';

          echo "<td>" . '<input type="text" size="1" name="update" value=' . $value. '>' . "</td>";
          echo '<input type="hidden" name="loc" value="' . $i . '">';
          echo "<td>" . '<input type="submit" value="update" class="btn btn-warning"/>'. "</td>";
          echo '</form>';
                  
          echo "<form action=" . $_SERVER["PHP_SELF"] . ' method="get">';
          echo '<input type="hidden" name="delete" value="' . $i . '">';
          echo "<td>" . '<input type="submit" value="delete" class="btn btn-danger"/>'. "</td>";
          echo '</form>';
          echo '</tr>';    
      }     
      //print_r($_SESSION["qty"]);

     // echo "<br><br><br><br><br><br>";




     // print_r($_SESSION["id"]);

?>         
        </table> 
      </li>
    </ul>
        <form action='purchase.php' method="post">
          <input type="hidden" name="purchase" value=''> 
          <input type="submit" value="Purchase" class="btn btn-success"/>
        </form>

        <form action='<?php echo $_SERVER["PHP_SELF"]; ?>' method="post">
          <input type="hidden" name="clearall" value='1'> 
          <input type="submit" value="clear all" class="btn btn-danger"/>
        </form>
    
        <h4>Continue Shopping</h4>
        <a href="macaroons.php?page=1" class="m-btn red-stripe">Macaroons</a> 
        <a href="cakes.php?page=1" class="m-btn purple-stripe">Cakes</a> 
        </div>
  </body>
</html>
