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

    $select = mysql_query("SELECT transactionid, ispaid, transactiondate FROM trheaderpurchase");

    if ($select === false)
        die(mysql_error());    

function formatting($x, $len)
{
  $input = strlen($x);
  $len = $len - $input;
  $string = "TR";
  for($i=0 ; $i < $len ; $i++)$string .= "0";
    return $string;
    if($x == $input)echo "Transaction rows are too many!";
}

?>
<!DOCTYPE html>
<html>
  <head>
      <title>Transaction</title>
      <link href="css/bootstrap.css" rel="stylesheet"/>
  </head>
<body>
  <?php include 'headerAdmin.php';?>
  <div class="container">
  <table class="table">
    <thead>
      <td>Transaction ID</td>
      <td>Status</td>
      <td>Transaction Date</td>
    </thead>

<?php
    while ($row = mysql_fetch_assoc($select)) {
    echo "<tr>";
    echo "<td>" . formatting($row["transactionid"], 5) . $row["transactionid"] . "</td>";
    echo "<td>" . $row["ispaid"] . "</td>";
    echo "<td>" . $row["transactiondate"] . "</td>";
    echo "<td>" ;
    echo '<form action="detailTransaction.php" method="GET"/>';
    echo '<input type="hidden" name="detail" value=' . $row["transactionid"] . '>' ;
    echo '<input type="submit" value="Detail Transaction" class="btn btn-success"/>' ;
    echo '</form>' . 
    "</td>";
    echo "</tr>";
    }

    ?>
  </table>
</div>
</body>
</html>