<?php
session_start();
if (!(isset($_SESSION["user"]))) {
	die("You are Illegally Accessing this page:");
}
  ?>

<!DOCTYPE html>
<html>
<head>
	<title>Select Your Seats</title>
		<link rel="stylesheet" type="text/css" href="pretty-checkbox/dist/pretty-checkbox.css">
		<!-- <link rel="stylesheet" type="text/css" href="l1.css"> -->
		<meta charset="utf-8">
  	<meta name="viewport" content="width= device-width, initial-scale=1">
  	<style type="text/css">
  		.error{ color: yellow; font-size: 16px }
  		body{
	/*background-image: url(adminbg.jpg);*/
	/*background-color: black;*/
	width: 100%;
	background-attachment: fixed;
	background-repeat: no-repeat;
	background-size: cover;
	background-position: center;
	height: 100%;
	padding: 0;
	margin: 0;
	color: white;
}
  	</style>
  	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="seat.css">
  <link rel="stylesheet" type="text/css" href="Hover-master/css/hover.css">
  <link rel="stylesheet" type="text/css" href="CSS Animations/animate.css">
  	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
		
</head>
	<body>
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
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}
		//echo "Connected successfully <br>";
			// echo $_SESSION["MovieTime"]."<br>";
			// echo $_SESSION["ScrNm"]."<br>";
			// echo $_SESSION["user"];
			// echo $_SESSION["Movie"];

		if ($_SERVER["REQUEST_METHOD"] == "POST")
		{
			// $qry = "Insert into `".$_SESSION["ScrNm"]."` (`Sno`, `bid`, `Time`) VALUES ('?', '?', '?')";
			// $stmt = $conn->prepare($qry);
			if(!empty($_POST["seat"]))
			{
				
				if(is_array($_POST["seat"])||is_object($_POST["seat"]))
				{
					$bid = $_SESSION["user"]."SeatS".strval(count($_POST["seat"])).$_SESSION["Movie"].strval(mt_rand(0,10000));
					// $bid = $_SESSION["user"]."Sno".count($_POST["seat"]);
					$bkQry = "INSERT INTO `bookings` (`uid`, `Bid`, `MvName`,`Screen`) VALUES ('".$_SESSION["user"]."', '".$bid."', '".$_SESSION["Movie"]."','".$_SESSION["ScrNm"]."')";
					if($conn->query($bkQry))
					{
						$conn->commit();
					//Adding the booking to the Booking table
						foreach($_POST["seat"] as $value)
						{
							$val = (int)$value;
							//echo gettype($_SESSION["MovieTime"]);
							$qry = "Insert into `".$_SESSION["ScrNm"]."` (`Sno`, `bid`, `Time`) VALUES (".$val.", '".$bid."', '".$_SESSION["MovieTime"]."')";
							$conn->query($qry);
							$strdProcCall = "CALL UpdateForSalesStat(\"".$_SESSION["Movie"]."\")";
							$conn->query($strdProcCall);
						}
						$_SESSION["Seats"] = strval(count($_POST["seat"]));
						$_SESSION["BkID"] = $bid;
						header("Location: http://localhost:8080/DBMS/BookingConfirmed.php");
					}
				}
				else
				{
					echo "<br>hello";
				}
			}
		}
	?>
		<form name="MapOfDaSeat" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "post" >
			<?php
				$SeatMap = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
				$qry = "Select `Sno` from `".$_SESSION["ScrNm"]."` WHERE `TIME` = \"".$_SESSION["MovieTime"]."\"";
				$res = $conn->query($qry);
				if($res->num_rows > 0)
				{
					while($row = $res->fetch_assoc())
					{
						$SeatMap[$row["Sno"]-1] = 1;
					}
				}
				//Now we generate the checkboxes
				echo "<br> <br> <center>";
				for ($i=0; $i < count($SeatMap) ; $i++) 
				{ 
					if ( (($i) % 20 == 0) && (($i)<count($SeatMap)) ) 
					{
						// echo "</center>";//closing previous center tag
						echo "<br>";
						echo "<br>";
						// echo "<center>";//opening center tag
					}
					if($SeatMap[$i] == 0)
					{
						echo "<div class=\"pretty p-default p-curve p-fill p-bigger\"> <input type = 'checkbox' name = 'seat[]' value='".($i+1)."' ><div class=\"state p-success\"><label></label></div></div>";
					}
					if ($SeatMap[$i] == 1) 
					{
						echo "<div class=\"pretty p-default p-curve p-fill \"><input type = 'checkbox' name = 'seat[]' value='".($i+1)."'disabled><div class=\"state p-success bgrfnt\"><label></label></div></div>";
					}
					
					if ((($i) % 10 == 0) && (!(($i) % 20 == 0) || ( ($i-1) == 0)))
					{
						echo "&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp";
					}

				}

			  ?>
			</center>
			<br>
			<br> 
			  <div class="trapezoid"></div>
			  <center>
			  	<h2> Screen This Way </h2>
			  </center>
			  <br>
			 
			<center>
			  	<button type="submit" class="btn btn-primary hvr-grow evenbgrfnt">Submit</button> 
			</center>
			<br>
			<br>
			&nbsp 
		</form>
	</body>
</html>