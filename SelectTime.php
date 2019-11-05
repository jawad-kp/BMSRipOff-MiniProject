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
				$.ajax(
				{
					type: "POST",
					url:"SaveTimeData.php",
					data:{Time: MvTime}
				}).done(function()
				{
					window.location.replace("SeatMapGen.php");
				})
			})
		})
	</script>
</head>
<body>
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

	$qu = "Select `Time` from `moviet` where `Name` Like \"". $_SESSION["Movie"]."\"";
	//echo $qu;
	$res = $conn->query($qu);
	if ($res->num_rows > 0) 
	{	
		while($row = $res->fetch_assoc()) 
		{
			echo "<button value = \"".$row["Time"]."\">".$row["Time"]."</button><br>";
		}
	 }
	 else
	 {
	 	echo "No Shows Available";
	 } 
	  ?>

</body>
</html>


