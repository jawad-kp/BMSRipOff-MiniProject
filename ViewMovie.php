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
  	</style>
  	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="viewMov.css">
  <link rel="stylesheet" type="text/css" href="Hover-master/css/hover.css">
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
	<div class="container-fluid">


		<nav style="width: 100%;">
			<center>
			<ul >
				<li>
					<a  href="#"  class = "plzwrk">View Movies</a>
				</li>
				<li class="hvr-bob">
					<a  href="ViewBookings.php">View Bookings</a>
				</li>
				<li class="hvr-bob">
					<a href="Logout.php">Logout</a>
				</li>
			</ul>
			</center>
			
		</nav>

		<br><br>
		<br>

	<h1 class="colorMan">Now Showing: </h1>

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


	$qu = "SELECT DISTINCT `moviet`.`Name`, `Synop` FROM `moviet`,`deets` WHERE `moviet`.`Name` = `deets`.`Name`";;
	$res = $conn->query($qu);
	if ($res->num_rows > 0) 
	{	
			// echo "<div class = \"row\">";
			// 	echo "<div class = \"col-sm-3\">";
			// 		echo "<h4>";
			// 			echo "Movie";
			// 		echo "</h4>";

			// 	echo "</div>";
			// 	echo "<div class = \"col-sm\">";
			// 		echo "<h4>";
			// 			echo "Synopsis";
			// 		echo "</h4>";
			// 	echo "</div>";
			// echo "</div>";
		while($row = $res->fetch_assoc()) 
		{
			$syn = substr($row["Synop"],0,150)."...";
			echo "<div class = \"row\">";
				echo "<div class = \"col-sm-2\">";
				echo "</div>";
				echo "<div class = \"col-sm\">";
					echo "<button value = \"".$row["Name"]."\" class = \"bttneTyme hvr-grow\">".$row["Name"];
					echo ":<br>".$syn."<br>";
				echo "</div>";
				echo "</button>";
				echo "<div class = \"col-sm-2\">";
				echo "</div>";
			echo "</div>";
			echo "<br>";
			echo "<br>";
			// echo "</div>";
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
  	echo "<h1 class = \"colorMan\">Coming Up...</h1>";
  	while ($row = $CminUpRes->fetch_assoc())
  	 {
  		echo "<div class = \"row\">";
	  		echo "<div class = \"col-sm-1\">";
			echo "</div>";
			echo "<div class = \"colorMan lab col-sm\">".$row["Name"]."<br></div>";
			echo "<div class = \"col-sm-1\">";
			echo "</div>";
		echo "</div>";
  	}
  }
 ?>
 <!-- <br>
 <br>
 <a href="http://localhost:8080/DBMS/ViewBookings.php" style="text-decoration: none; color: red; border-color: black;" > Click Here To View Your Existing Bookings</a>
 <br>
 <br>
 <a href="Logout.php">Logout</a> -->

 </div>

</body>
</html>