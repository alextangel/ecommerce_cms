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
        <title>Member</title>
        <link href="css/bootstrap.css" rel="stylesheet"/>
    </head>

    <body>
        <?php include 'headerAdmin.php' ?>
        <div class="container">
        	<h1>Member</h1>
            <table class="table">
                <tr>
                    <td>Username</td>
                    <td>Password</td>
                    <td>Role</td>
                    <td>Fullname</td>
                    <td>Address</td>
                    <td>Telephone</td>
                    <td>Email</td>
                    <td colspan = '2'>Action</td>
                </tr>
        <?php

    $query = mysql_query("SELECT userid, username, pass, rolename, fullname, address, telephone, email FROM msuser join ltrole on msuser.roleid = ltrole.roleid");

        while ($output = mysql_fetch_assoc($query))
            {
            echo "<tr>" . 
            "<td>" . $output['username'] . "</td>" .
            "<td>" . $output['pass'] . "</td>" .
            "<td>" . $output['rolename'] . "</td>" .
            "<td>" . $output['fullname'] . "</td>" .
            "<td>" . $output['address'] . "</td>" .
            "<td>" . $output['telephone'] . "</td>" .
            "<td>" . $output['email'] . "</td>" .
            "<td>
            <form action=updateMember.php?id=" . $output['userid'] . " method='post'>
                <input type='submit' value='update' class='btn btn-success'>
            </form>
            </td>" .
            "<td>
            <form action=deleteMember.php?id=" . $output['userid'] . " method='post'>
                <input type='submit' value='delete' class='btn btn-danger'>
            </form>
            </td>" ;
        }

            echo '<br>';
        ?>
            </table>
        </div>
    </body>

</html>