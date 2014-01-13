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

      $show = mysql_query("SELECT transactionid FROM trdetailpurchase ORDER BY transactionid DESC LIMIT 1");

    if (mysql_num_rows($show) > 0)
        {
               $transact = mysql_fetch_assoc($show);
              
              $transact["transactionid"] += 1;
        }
        else
        {
          $transact["transactionid"] = 1;
        }

        foreach($_SESSION['id'] as $i=>$value)
      {
        $sql = sprintf("INSERT INTO trdetailpurchase (transactionid, productid, qty) VALUES ('%s', '%s', %s)",
                       mysql_real_escape_string($transact["transactionid"]),
                       mysql_real_escape_string($value),
                       mysql_real_escape_string($_SESSION['qty'][$i]));

        // execute query
        $result = mysql_query($sql);
        if ($result === false)
            die(mysql_error());
        
      }

      $q = mysql_query(sprintf("SELECT userid FROM msuser where username = '%s'", $_SESSION["username"]));
      $userid = mysql_fetch_assoc($q);

        $sql = sprintf("INSERT INTO trheaderpurchase (transactionid, userid, transactiondate, ispaid) VALUES ('%s', '%s', NOW(), '%s')",
                       mysql_real_escape_string($transact["transactionid"]),
                       mysql_real_escape_string($userid["userid"]),
                       "unpaid");

        // execute query
        $result = mysql_query($sql);
        if ($result === false)
            die(mysql_error());

      $_SESSION['list'] = array();
      $_SESSION['qty'] = array();
      $_SESSION['id'] = array();

?>

<!DOCTYPE html>

<html>
  <head>
    <link href="css/bootstrap.css" rel="stylesheet"/>
    <title>Purchase</title>
  </head>
  <body>
    <div class="container">
      <h1>"Your order has been sent!"</h1>
      <a class="m-btn purple big" href="index.php">Go Home<i class="m-icon-big-swapright m-icon-white"></i></a>
    </div>
  </body>
</html>