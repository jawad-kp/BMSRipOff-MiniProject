<?php 
session_start();
if (!(isset($_SESSION["user"]))) {
	die("You are Illegally Accessing this page:");
}
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>View Currently Showing Movies</title>
	<script src="jquery/dist/jquery.js"></script>
	<meta charset="utf-8">
  	<meta name="viewport" content="width= device-width, initial-scale=1">
  	<style type="text/css">
  		.error{ color: white; font-size: 16px; align-content: left; }
  		.wrapper{ width:350px; padding: 20px }
  	</style>
  	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="view.css">
  <link rel="stylesheet" type="text/css" href="Hover-master/css/hover.css">
  <link rel="stylesheet" type="text/css" href="CSS Animations/animate.css">
  	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

	<script>
		$(document).ready(function(){
			$('button').click(function()
			{
				var MvNm = $(this).attr('value');
				$.ajax(
				{
					type: "POST",
					url:"SaveNameData.php",
					data:{Name: MvNm}
				}).done(function()
				{
					window.location.replace("SelectTime.php");
				})
			})
		})
	</script>
	
</head>
<body>

	<h1>Now Showing: </h1>

	<!-- <form method="POST" action="SaveNameData.php"> -->
		<form name = "whatevs">
<?php
	$servername = "127.0.0.1";
	$username = "root";
	$db = "bmsripoff";
	$password = "";
	// Create connection
	$conn = new mysqli($servername, $username, $password,$db);//creating a connection object
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}


	$qu = "Select DISTINCT `Name` from `MovieT`";
	$res = $conn->query($qu);
	if ($res->num_rows > 0) 
	{	
		while($row = $res->fetch_assoc()) 
		{
			echo "<button value = \"".$row["Name"]."\">".$row["Name"]."</button><br>";
		}
	 } 
  ?>

  </form>

  <br>
  <br>
  <?php 
  $que = "SELECT `Name` FROM `deets` WHERE `Name` NOT IN (Select DISTINCT `Name` from `MovieT`)";
  $CminUpRes = $conn->query($que);
  if ($CminUpRes->num_rows > 0) 
  {
  	echo "<h2>Coming Up...</h2>";
  	while ($row = $CminUpRes->fetch_assoc())
  	 {
  		
  		echo $row["Name"]."<br>";
  	}
  }
 ?>
 <br>
 <br>
 <a href="http://localhost:8080/DBMS/ViewBookings.php" style="text-decoration: none; color: red; border-color: black;" > Click Here To View Your Existing Bookings</a>
 <br>
 <br>
 <a href="Logout.php">Logout</a>

</body>
</html>