<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Select Your Time Slot</title>
	<script src="jquery/dist/jquery.js"></script>
	<script>
		$(document).ready(function(){
			$('button').click(function()
			{
				var MvTime = $(this).attr('value');
				var Scrt = $(this).attr('abd');
				$.ajax(
				{
					type: "POST",
					url:"SaveTimeData.php",
					data:{Time: MvTime, Scr: Scrt}
				}).done(function()
				{
					window.location.replace("SeatMapGen.php");
				})
			})
		})
	</script>

  	<meta charset="utf-8">
  	<meta name="viewport" content="width= device-width, initial-scale=1">
  	<style type="text/css">
  		.error{ color: yellow; font-size: 16px }
  	</style>
  	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="l2.css">
  <link rel="stylesheet" type="text/css" href="Hover-master/css/hover.css">
  <link rel="stylesheet" type="text/css" href="CSS Animations/animate.css">
  	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container-fluid">
	<br><br><br><br><br>
	<?php
	if(!(isset($_SESSION["Movie"])))
	{
		die("No Movie Selected");
	}
	$servername = "127.0.0.1";
	$username = "root";
	$db = "bmsripoff";
	$password = "";
	// Create connection
	$conn = new mysqli($servername, $username, $password,$db);//creating a connection object
	// Check connection
	if ($conn->connect_error ) {
	    die("Connection failed: " . $conn->connect_error);
	}
	$qu = "Select `Time`, `Screen` from `moviet` where `Name` Like \"". $_SESSION["Movie"]."\"";
	//echo $qu;
	$res = $conn->query($qu);
	if ($res->num_rows > 0) 
	{	
		while($row = $res->fetch_assoc()) 
		{	echo "<div class = \"row\">";
				echo "<div class = \"col-sm-5\"></div>";
				echo "<div class = \"col-sm-1\">";
					echo "<button class=\"btn btn-info hvr-float btn-lg\"  value = \"".$row["Time"]."\" abd = \"".$row["Screen"]."\">".$row["Time"]."</button>";
				echo "</div>";
				echo "<div class = \"col-sm-5\"></div>";
			echo "</div><br><br>";


		}
		
	 }
	 else
	 {
	 	echo "No Shows Available";
	 } 
	  ?>

	  </div>

</body>
</html>