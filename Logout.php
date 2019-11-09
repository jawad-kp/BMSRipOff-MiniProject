<?php
session_start();
  ?>
  <!DOCTYPE html>
  <html>
  <head>
  	<title>Logout Page</title>
  </head>
  <body>
  </body>
  <?php  
  	if(isset($_SESSION["user"]))
  	{
  		echo "You've Been Successfully Logged out.<br>";
  		echo "<a href=\"http://localhost:8080/DBMS/login.php\"> Click Here To Sign In</a>";


  	}

  	elseif (isset($_SESSION["adm"])) 
  	{
  		echo "Admin Successfully Logged out. <br>";
  		echo "<a href=\"http://localhost:8080/DBMS/admin_log.php\"> Click Here To Sign In</a>";

  	}
  	else
  	{
  		echo "Nobody Logged in to sign out.";
  	}

  	session_destroy();



  		?>
  		<!-- <a href=\"http://localhost:8080/DBMS/login.php\"></a> -->
  
  </body>
  </html>