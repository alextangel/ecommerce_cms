<?php 

session_start();
date_default_timezone_set('Asia/Jakarta');

?>

<!DOCTYPE html>
  <head>
    <title>Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 20px;
        padding-bottom: 40px;
      }

      /* Custom container */
      .container-narrow {
        margin: 0 auto;
        max-width: 700px;
      }
      .container-narrow > hr {
        margin: 30px 0;
      }

      .jumbotron {
        margin: 60px 0;
        text-align: center;
      }
      .jumbotron h1 {
        font-size: 72px;
        line-height: 1;
      }
      .jumbotron .btn {
        font-size: 21px;
        padding: 14px 24px;
      }

      .marketing {
        margin: 60px 0;
      }
      .marketing p + h4 {
        margin-top: 28px;
      }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">

  </head>

  <body>

    <div class="container-narrow">

      <?php include 'header.php'; ?>  

      <hr>

      <div class="jumbotron">
        <h1>Who Are We ? </h1>
        <p class="lead">We are a group of best of the best chefs that have been selected from around the world. We have a vision to give the world the greatest food that we can make. We make foods based on the secret recipes and combine them together.  So, what are you waiting for? Just order and taste the greatest food that ever made....!!!</p>
        <a class="btn btn-primary" href="#"><i class="icon-facebook"></i></a>
        <a class="btn btn-large btn-success" href="#"><i class="icon-twitter"></i></a>
        <a class="btn btn-danger" href="#"><i class="icon-youtube"></i></a>
      </div>

      <hr>
      <h2>Our Recipes</h2>
      <div class="row-fluid marketing">
        <div class="span6">
          <h4>Made with Heart</h4>
          <p>The true chefs are always using heart everytime they make foods.</p>

          <h4>Made with Love</h4>
          <p>The great food can be made with love.</p>

          <h4>Made with Laugh</h4>
          <p>Why so serious??? <i>-- Joker</i></p>
        </div>

        <div class="span6">
          <h4>Made with Skills</h4>
          <p>We have the greatest skills to make a better food for better place.</p>

          <h4>Made with Mind</h4>
          <p>We also go into a school. FYI, we never dropout from the school.</p>

          <h4>Made with Soul</h4>
          <p>We are born, live, and death because of soul</p>
        </div>
      </div>

      <hr>

      <div class="footer">
        <p>&copy; Alexander T.K | Just For Fun | 2013</p>
      </div>

    </div> 

  </body>
</html>
