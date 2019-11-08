<?php
session_start();
  ?>

<!DOCTYPE html>
<html>
<head>
	<title>Select Your Seats</title>
		<link rel="stylesheet" type="text/css" href="pretty-checkbox/dist/pretty-checkbox.css">
		<!-- <link rel="stylesheet" type="text/css" href="MapOfDaSeat.css">> -->
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
				$SeatMap = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
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
				for ($i=0; $i < count($SeatMap) ; $i++) 
				{ 
					if($SeatMap[$i] == 0)
					{
						echo "<div class=\"pretty p-default p-curve p-fill p-bigger\"> <input type = 'checkbox' name = 'seat[]' value='".($i+1)."' ><div class=\"state p-success\"><label></label></div></div>";
					}
					if ($SeatMap[$i] == 1) 
					{
						echo "<div class=\"pretty p-default p-curve p-fill p-bigger\"><input type = 'checkbox' name = 'seat[]' value='".($i+1)."'disabled><div class=\"state p-success\"><label></label></div></div>";
					}
					if (($i+1) % 4 == 0 ) 
					{
						echo "<br><br>";
					}

				}

			  ?>
			  <br>
			  <h2>--------------------</h2>
			  <h2> Screen This Way </h2>
			  <br>
			  <button type="submit">Submit</button> 
			
		</form>
	</body>
</html>