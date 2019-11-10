<?php
session_start();
  ?>
  <!DOCTYPE html>
  <html>
  <head>
  	<title>Logout Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width= device-width, initial-scale=1">
    <style type="text/css">
      .error{ color: red; font-size: 16px }
    </style>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="lo.css">
  <link rel="stylesheet" type="text/css" href="Hover-master/css/hover.css">
  <link rel="stylesheet" type="text/css" href="CSS Animations/animate.css">
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
  </head>
  <body>
  <div class="row form-group">
  <div class="row form-group">
  <div class="row form-group">
  <div class="row form-group">
  <div class="row form-group">
  <div class="row form-group">
  </div></div></div></div></div></div>
  <div class="row form-group">
  <div class="row form-group">
  <div class="row form-group">
  <div class="row form-group">
  </div></div></div></div>
    <div class="row form-group">
  <div class="row form-group">
  <div class="row form-group">
  <div class="row form-group">
  </div></div></div></div>
    <div class="row form-group">
  <div class="row form-group">
  <div class="row form-group">
  <div class="row form-group">
  </div></div></div></div>
  </body>
  <?php  
  	if(isset($_SESSION["user"]))
  	{
  		echo "<center><h2>You've Been Successfully Logged out.</h2></center>
      <br>";
  		echo "<center><a class=\"nut\" href=\"http://localhost:8080/DBMS/login.php\"> Click Here To Sign In</a></center>";


  	}

  	elseif (isset($_SESSION["adm"])) 
  	{
  		echo "<center><h2>Admin Successfully Logged out.</h2></center> <br>";
  		echo "<center><a class=\"nut\" href=\"http://localhost:8080/DBMS/admin_log.php\"> Click Here To Sign In</a></center>";

  	}
  	else
  	{
  		echo "<center><h2>Nobody Logged in to sign out.</h2></center>";
  	}

  	session_destroy();



  		?>
  		<!-- <a href=\"http://localhost:8080/DBMS/login.php\"></a> -->
  
  </body>
  </html>