
<div class="navbar navbar-inverse navbar-fixed-top">
  	<div class="navbar-inner"> 
  		<a class="brand" href="#">&nbsp;&nbsp;<i class="icon-cny">&nbsp;&nbsp;</i>Macaroons and Cakes Patisserie</a>
		<ul class="nav">
			<li><a href="index.php">Home</a></li>
			<li><a href="profile.php">Profile</a></li>
			<li><a href="macaroons.php?page=1">Macaroons</a></li>
			<li><a href="cakes.php?page=1">Cakes</a></li>
			<li><a href="cart.php">Cart</a></li>

			<?php if (isset($_SESSION["authenticated"]) && $_SESSION["authenticated"] == true) : ?>
				<li><a href="logout.php">Logout</a></li>
			<?php else: ?>   
				<li><a href="login.php">Login</a></li> 
			<?php endif ?> 	
		</ul>

		<?php if (isset($_SESSION["authenticated"]) && $_SESSION["authenticated"] == true) : ?>
			<a href="#" class="m-btn red"><i class="icon-user">&nbsp;&nbsp;</i>Hello, <?php echo $_SESSION["username"] ;?> !</a>
		<?php endif ?>
	</div>
</div>		

