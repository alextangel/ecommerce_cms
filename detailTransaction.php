<?php

    session_start();

    date_default_timezone_set('Asia/Jakarta');

    // connect to database
    if (($connection = mysql_connect("localhost", "dtbrkcom_alex", "jamurkuping1")) === false)
        die("Could not connect to database");

    // select database
    if (mysql_select_db("dtbrkcom_erd", $connection) === false)
        die("Could not select database");

    if(isset($_GET['detail']))
    $_SESSION['detail'] = $_GET['detail'];

      $select = sprintf("SELECT trdetailpurchase.transactionid, trdetailpurchase.productid, productname,  qty, ispaid, price FROM trdetailpurchase join trheaderpurchase on trdetailpurchase.transactionid = trheaderpurchase.transactionid join msproduct on msproduct.productid = trdetailpurchase.productid where trdetailpurchase.transactionid = '%s'", $_SESSION['detail']);

      $query = mysql_query($select);

    if ($query === false)
        die(mysql_error());  

    if(isset($_GET["status"]))
    {   
        $update = sprintf("UPDATE trheaderpurchase SET ispaid = '%s' WHERE trheaderpurchase.transactionid = '%s'",
                       mysql_real_escape_string($_GET['status']),
                       mysql_real_escape_string($_SESSION["detail"]));

        $result = mysql_query($update);
        if ($result === false)
            die("Could not query database");

        $host = $_SERVER["HTTP_HOST"];
        $path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
        header("Location: http://$host$path/transaction.php");
        exit;
    }

?>
<!DOCTYPE html>
<html>
  <head>
      <title>Detail Transaction</title>
      <link href="css/bootstrap.css" rel="stylesheet"/>
  </head>
  <body>
    <?php include 'headerAdmin.php' ?>
    <div class="container">
    <table class="table">
      <thead>
        <td>Product ID</td>
        <td>Product Name</td>
        <td>Quantity</td>
        <td>Price</td>
        <td>Qty * Price</td>
      </thead>

<?php
$sum = 0;
    while ($row = mysql_fetch_assoc($query)) {
      $sum += ($row["qty"]*$row["price"]);
    echo "<tr>";
    echo "<td>" . $row["productid"] . "</td>";
    echo "<td>" . $row["productname"] . "</td>";
    echo "<td>" . $row["qty"] . "</td>";
    echo "<td>" . $row["price"] . "</td>";
    echo "<td>" . $row["qty"]*$row["price"] . "</td>";
    echo "</tr>";
    }

    ?>
  </table>
    <?php echo "<h1>Total = " . $sum . " IDR</tr></h1>"; ?>
  </br>
    <h3>Status :</h3>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="GET">
      <select name="status">
        <option value="unpaid">Unpaid</option>
        <option value="paid">Paid</option>
      </select>
      <input type="submit" value="Proceed" class="btn btn-success">
    </form>
  </div>
  </body>
</html>