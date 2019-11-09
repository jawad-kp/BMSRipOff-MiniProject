<?php
session_start();
 ?>


<!DOCTYPE html>
<html>
<head>
	<title>View Your Bookings</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width= device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
  	<link rel="stylesheet" type="text/css" href="Hover-master/css/hover.css">
  	<link rel="stylesheet" type="text/css" href="CSS Animations/animate.css">
  	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container-fluid">
	<?php
		$servername = "127.0.0.1";
		$username = "root";
		$db = "bmsripoff";
		$password = "";
		//Move config outside and integrate later
		// Create connection
		mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
		$conn = new mysqli($servername, $username, $password,$db);//creating a connection object

		// Check connection
		if ($conn->connect_error) 
		{
		    die("Connection failed: " . $conn->connect_error);
		}

		if (!(isset($_SESSION["user"])))
		 {
			die("Invalid Login");
		 }

		 echo "<h1>Welcome ".$_SESSION["username"]."!!!</h1>";
		 $qry = "SELECT * FROM `bookings` WHERE `uid` LIKE \"".$_SESSION["user"]."\"";

		 $res = $conn->query($qry);
		 if ($res->num_rows>0)
		  {
		  	echo "<div class = \"row\">";
		  	echo "<div class=\"col-sm-3\">Booking ID </div><div class=\"col-sm-3\"> Movie Name </div><div class=\"col-sm-3\">Screen </div><div class=\"col-sm-3\"> Seats</div>";
		  	echo "</div>";


		 	while ($row = $res->fetch_assoc()) 
		 	{
		 		echo "<div class = \"row\">";
		 		echo "<div class=\"col-sm-3\">".$row["Bid"]." </div><div class=\"col-sm-3\">".$row["MvName"]." </div><div class=\"col-sm-3\">".$row["Screen"]." </div><div class = \"col-sm-3\">";

		 		$seatingQuery = "SELECT `Sno` FROM `".$row["Screen"]."` WHERE `bid` LIKE \"".$row["Bid"]."\"";
		 		$seatRes = $conn->query($seatingQuery);
		 		$listOfSeats = "";
		 		while ($seatRow = $seatRes->fetch_assoc())
		 		{
		 			$listOfSeats .=$seatRow["Sno"].", ";
		 		}
		 		 $SeatList = substr($listOfSeats,0,(strlen($listOfSeats)-2));
		 		 echo $SeatList;
		 		echo " </div>";//This closes the last column.
		 		echo"</div>";//This closes the row.

		 	}
		 }
		 else
		 {
		 	echo "<h2> You have No Bookings </h2>";
		 }

	  ?>

	  </div>

</body>
</html>