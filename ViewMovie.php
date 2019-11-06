<?php 
session_start();
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>View Currently Showing Movies</title>
	<script src="jquery/dist/jquery.js"></script>
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


</body>
</html>