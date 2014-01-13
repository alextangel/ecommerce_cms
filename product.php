<?php

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
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Product</title>
        <link href="css/bootstrap.css" rel="stylesheet"/>
    </head>

    <body>
         <?php include 'headerAdmin.php' ?>
        <div class="container">       
            <table class="table">
                <tr>
                    <td>Type</td>
                    <td>Name</td>
                    <td>Price</td>
                    <td>Description</td>
                    <td>New</td>
                    <td>Image</td>
                    <td colspan = '2'>Action</td>
                </tr>
        <?php

    $query = mysql_query("SELECT productid, producttypename, productname, price, description, isnew, imagesrc FROM msproduct join msproducttype on msproduct.producttypeid = msproducttype.producttypeid");

    while ($output = mysql_fetch_assoc($query))
    {
        echo "<tr>" . 
        "<td>" . $output['producttypename'] . "</td>" .
        "<td>" . $output['productname'] . "</td>" .
        "<td>" . $output['price'] . "</td>" .
        "<td>" . $output['description'] . "</td>" .
        "<td>" . $output['isnew'] . "</td>" .
        "<td class='thumbnail'>" . "<img src=" . "'" . $output['imagesrc'] .'.jpg'."'".">" . "</td>" .
        "<td>
        <form action=updateProduct.php?id=" . $output['productid'] . " method='post'>
            <input type='submit' value='update' class='btn btn-inverse'>
        </form>
        </td>" .
        "<td>
        <form action=deleteProduct.php?id=" . $output['productid'] . " method='post'>
            <input type='submit' value='delete' class='btn btn-danger'>
        </form>
        </td>" ;
     }

        echo '<br>';

        ?>
         </table>

            <form action="insertProduct.php" method="post">
                <input type="submit" value="Insert New Product" class='btn btn-info'>
            </form>

        </div>
    </body>

</html>