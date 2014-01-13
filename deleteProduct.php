 <?php
    //session_start();

    date_default_timezone_set('Asia/Jakarta');
            // connect to database
    if (($connection = mysql_connect("localhost", "dtbrkcom_alex", "jamurkuping1")) === false)
        die("Could not connect to database");

    // select database
    if (mysql_select_db("dtbrkcom_erd", $connection) === false)
        die("Could not select database");

    $q = "DELETE FROM msproduct where productid=" . $_GET['id'];

    $result = mysql_query($q);
    if ($result === false)
        die("Could not query database");
    else
        echo "Data has been deleted!";
        echo '<br><br><a href="product.php">Go Back</a>';

        ?>