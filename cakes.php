<?php

session_start();

date_default_timezone_set('Asia/Jakarta');
?>

<!DOCTYPE html>

<html>
	<head>
		<link href="css/bootstrap.css" rel="stylesheet"/>
		<title>Cakes</title>
	</head>

	<body>
		<?php include 'header.php' ?>
		<div class="container">
			<h1>Cakes</h1>
			<form action = "" method="POST">
				Search by : 
				<select name="searchBy">
					<?php if (isset($_POST["searchBy"]) && $_POST["searchBy"] == 'desc') : ?>
					<option value="name">Name</option>
					<option value="desc" selected="selected">Description</option>
					<option value="price">Price</option>
					<?php elseif(isset($_POST["searchBy"]) && $_POST["searchBy"] == 'name'): ?> 
					<option value="name" selected="selected">Name</option>
					<option value="desc">Description</option>
					<option value="price">Price</option>
					<?php else: ?> 
					<option value="name">Name</option>
					<option value="desc">Description</option>
					<option value="price" selected="selected">Price</option>					
					<?php endif ?>
				</select>
				<?php if (isset($_POST["search"])) : ?>
				<input type="text" name = "search" value="<?php echo htmlspecialchars($_POST["search"])?>"/>
				<?php else: ?> 
				<input type="text" name = "search"/>
				<?php endif ?>
				<input type="submit" value ="search" class="btn btn-info"/>
			</form>

			<ul class='thumbnails'>
			<?php

			$page = $_GET['page'];
			if ($page < 1) $page = 1;

	   		if (($connection = mysql_connect("localhost", "dtbrkcom_alex", "jamurkuping1")) === false)
	       		die("Could not connect to database");


	    	if (mysql_select_db("dtbrkcom_erd", $connection) === false)
	        	die("Could not select database");

			$paging = 6;
			if(isset($_POST['paging']))
				$_SESSION['paging'] = $_POST['paging'];

			if(isset($_SESSION['paging']))
				$paging = $_SESSION['paging'];

			$resultsPerPage = $paging;
			$startResults = ($page - 1) * $resultsPerPage;
			$numberOfRows = mysql_num_rows(mysql_query('SELECT imagesrc FROM msproduct where producttypeid = 0'));
			$totalPages = ceil($numberOfRows / $resultsPerPage);


			if(isset($_POST['searchBy']) && ($_POST['searchBy'] == 'name') && isset($_POST['search']))
			{
			        $q = sprintf("SELECT imagesrc, productname, price, isnew, description, productid FROM msproduct WHERE productname like '%%%s%%' AND producttypeid = 0",
			                       mysql_real_escape_string($_POST["search"]));
			        $query = mysql_query($q);
			}
			else if(isset($_POST['searchBy']) && ($_POST['searchBy'] == 'desc') && isset($_POST['search']))
			{
			        $q = sprintf("SELECT imagesrc, productname, price, isnew, description, productid FROM msproduct WHERE description like '%%%s%%' AND producttypeid = 0",
			                       mysql_real_escape_string($_POST["search"]));
			        $query = mysql_query($q);
			}
			else if(isset($_POST['searchBy']) && ($_POST['searchBy'] == 'price') && isset($_POST['search']))
			{
			        $q = sprintf("SELECT imagesrc, productname, price, isnew, description, productid FROM msproduct WHERE price = '%s' AND producttypeid = 0",
			                       mysql_real_escape_string($_POST["search"]));
			        $query = mysql_query($q);
			}			
			else
			{
				$query = mysql_query("SELECT imagesrc, productname, price, isnew, description, productid FROM msproduct where producttypeid = 0 LIMIT $startResults, $resultsPerPage");
			}

			while ($output = mysql_fetch_assoc($query)){
				echo '<li class="span4">';
				echo '<div class="thumbnail">';
	  			echo "<img src=" . "'" . $output['imagesrc'] .'.jpg'."'".">";
				echo '<div class="img-info">';
	            if($output['isnew'] == 1)
	            	echo '<div style="float:right"><a href="#" class="m-btn purple">New</a></div>';	
				echo '<form action="cart.php" method="get">
	            		<h3>' . $output['productname'] .'</h3>';
            		
            	echo '<h4>IDR ' . $output['price'] .'</h4>';

            	echo '<p>'. $output['description']. '</p>';


	         	if (isset($_SESSION["authenticated"]) && $_SESSION["authenticated"] == true)
	         	{
		         	echo 
		            '<input type="hidden" name="id" value=' . $output['productid'] . '>
		            <div class="input-prepend"><span class="add-on"><i class="icon-shopping-cart"></i></span><input type="text" name="qty" size="1" maxlength="3" value="1"></div>
		            <input type="submit" value="Add to Cart" class="btn btn-success">';
	            }

		           echo '</form></div></div><br>';
				   echo '</li>';       
				}

			echo '</ul>';
			echo '<a href="?page=1">First</a>&nbsp';

			if($page > 1)
			   echo '<a href="?page='.($page - 1).'">Back</a>&nbsp';

			for($i = 1; $i <= $totalPages; $i++)
			{
			   if($i == $page)
			      echo '<strong>'.$i.'</strong>&nbsp';
			   else
			      echo '<a href="?page='.$i.'">'.$i.'</a>&nbsp';
			}

			if ($page < $totalPages)
			   echo '<a href="?page='.($page + 1).'">Next</a>&nbsp;';
			   echo '<a href="?page='.$totalPages.'">Last</a>';

			?>
			
			<form action ="" method='POST'>	
				View per Page :
				<select name = 'paging'>
				<?php
					for($i = 1 ; $i <= 6 ; $i++)
					{
						if(isset($_SESSION['paging']) && $_SESSION['paging'] == $i)
							echo "<option selected = 'selected' value='$i' >$i</option>";
						else
							echo "<option value='$i'>$i</option>";
					}
				?>
				</select>
				<input type="submit" value="submit" class="btn btn-info">
			</form>
			      <div class="footer">
        <p>&copy; Alexander T.K | Just For Fun | 2013</p>
      </div>
		</div>
	</body>
</html>
