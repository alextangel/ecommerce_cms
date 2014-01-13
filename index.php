<?php 
/*index.php - HomePage */
session_start();

date_default_timezone_set('Asia/Jakarta');
?>

<!DOCTYPE html>
<html>
	<head>
		<link href="css/bootstrap.css" rel="stylesheet"/>
		 <link href="bootstrap-responsive.css" rel="stylesheet">
		<title>Macarons and Cakes Patisserie</title>
		<style>
			html {
			    height: 100%;
			    width: 100%;
			    background:url('images/bg.jpg') no-repeat center center fixed;
			    background-size: cover;
				}

		      #wrap {
		        min-height: 100%;
		        height: auto !important;
		        height: 100%;
		        /* Negative indent footer by it's height */
		        margin: 0 auto -60px;
		      }

		      #push,
		      #footer {
		        height: 60px;
		      }
		      
		      #footer {
		        background-color: #f5f5f5;
		      }

		      @media (max-width: 767px) {
		        #footer {
		          margin-left: -20px;
		          margin-right: -20px;
		          padding-left: 20px;
		          padding-right: 20px;
		        }
		      }
		</style>
	</head>

	<body>

    	<div id="wrap">

			<?php include 'header.php'; ?>	

		</div>
	</body>

</html>