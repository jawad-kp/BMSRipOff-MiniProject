<?php
	session_start();
	if (!(isset($_SESSION["adm"]))) 
		{
			die("Illegal Access");
		}  
?>



<!DOCTYPE html>
<html>
<head>
	<title>Add a show for an existing Movie</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width= device-width, initial-scale=1">
  	<style type="text/css">
  		.error{ color: red; font-size: 16px }
  	</style>

  	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="l2.css">
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

		// Create connection

		mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

		$conn = new mysqli($servername, $username, $password,$db);//creating a connection object

		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}
		$Mvnmerr=$Scnmerr=$Finerr="";//Initialisng our error variables
		$Mvnm=$Scnm=$tme="";
		$boo = true;
		if ($_SERVER["REQUEST_METHOD"] == "POST") 
		{
		    if(empty($_POST["Mvnm"]))
		    {
		        $Mvnmerr="Please Select a Movie";
		        $boo = false;
		    }
		    else
		    {
		    	$Mvnm=chngIP($_POST["Mvnm"]);
		    }//Movie's Name

		    if(empty($_POST["Scnm"]))
		    {
		        $Scnmerr="Please Select a Movie";
		        $boo = false;
		    }
		    else
		    {
		    	$Scnm=chngIP($_POST["Scnm"]);
		    }//Movie's Name

		    $Hr = chngIP($_POST["hr"]);
		    $Min = chngIP($_POST["min"]);
		    $tme = $Hr.":".$Min.":00";//formatting time Will make it dateTime when we add support for dates



		    send_data($boo,$Mvnm,$Scnm,$tme);
		}

		function chngIP($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;

        }//Modifies input for use
        function send_data($bleh,$Name,$Scr,$t)
        {
        	//echo "Entered send_data with values <br> Name: ".$Name."<br> Screen: ".$Scr."<br> Time: ".$t;
        	if ($bleh) 
        	{
        		
        		$chkQu = "SELECT `Screen`,`Time` FROM `moviet` WHERE `Screen` LIKE \"".$Scr."\" AND `Time` = \"".$t."\"";
        		$res = $GLOBALS['conn']->query($chkQu);
        		if (!($res->num_rows != 0)) 
        		{
        			
   				 	$qry = "INSERT INTO `moviet` (`Name`, `Screen`, `Time`) VALUES (\"".$Name."\", \"".$Scr."\", \"".$t."\")";
        			$res = $GLOBALS["conn"]->query($qry);
        			if ($res) 
        			{
        				$GLOBALS["Finerr"] = "Added Succesfully";
        			}

        			else
        			{
        				echo "Error: <br>"; 
        			}

	        	}
	        	else
	        	{
	        		$GLOBALS['Finerr'] = "Screen Unavailable at the time";
	        	}
        	}
        }

		?>


		<ul>
	<li><a class="active" href="">ADD SHOW</a></li>
  <li><a href="addmovie.php">ADD MOVIE</a></li>
  <li><a href="deletemovie.php">DELETE MOVIE</a></li>
  <li><a href="deleteshow.php">DELETE SHOW</a></li>
  <li><a href="admin_reg.php">REGISTER ADMIN</a></li>
  <li><a href="logout.php">LOGOUT</a></li>


	</ul>

		<div class="container-fluid">
    <center><h1 style="color: white; font-size: 40px;" class="fadeInDownBig animated" >Add Show</h1></center><br><br><br>
    <div class="d-flex justify-content-center">

    	<div class="pos">
		<form name="HenloFrens" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "post" > 	
			<div class="row form-group">
	 		<div class="col-sm-4">
			<label >Movie's Name :</label></div>
			<div class="col-sm-6">
				<select name="Mvnm">
				<?php
					$sql = "SELECT Name FROM `deets`";
					$NmList = $conn->query($sql);
					while($row = $NmList->fetch_assoc()) 
					{
						echo "<option value=\"".$row["Name"]."\">".$row["Name"]."</option>";
						//This should generate a list of available movies and makes sure you select only a movie that's been added
					}
				  ?> 
				</select>
				<span class="error"><?php echo $Mvnmerr;?> </span>	
			<br>

			</div></div>

			<div class="row form-group">
	 		<div class="col-sm-4">
			<label >Screen :</label></div>
			<div class="col-sm-6">
				<select name="Scnm">
				<?php
					$sql = "SELECT * FROM `screens`";
					$ScList = $conn->query($sql);
					while($row = $ScList->fetch_assoc()) 
					{
						echo "<option value=\"".$row["SName"]."\">".$row["SName"]."</option>";
						//This should generate a list of available Screens and makes sure you select an existent screen only
					}
				  ?> 
				</select>
				<span class="error"><?php echo $Scnmerr;?> </span>
			<br>

			</div></div>

			<div class="row form-group">
		 		<div class="col-sm-4">
					<label>Time:</label>
				</div>
			</div>
			<div class="row form-group">
		 		<div class="col-sm">
					<label>Hour</label>
				</div>
				<div class="col-sm">
					<select name="hr">
						<option value="9"selected>9</option> <!-- Default -->

					<?php
						for ($i=10; $i <24; $i++) 
						{ 
						  	echo "<option value=\"".$i."\">".$i."</option>" ;//to avoid typing out everything
						}  
					?>
					</select>
		
				</div>

	 			<div class="col-sm">		
					<label>Minute</label>
				</div>
				<div class="col-sm">
					<select name="min">
						<option value="00"selected>00</option> <!-- Default -->
						


					<?php
						for ($i=15; $i <= 45; $i +=15 ) 
						{ 
						  	echo "<option value=\"".$i."\">".$i."</option>" ;//to avoid typing out everything
						}  
					?>
					</select>

				</div>
			</div>

			<center><button class="btn btn-primary hvr-float" type="submit">Add</button></center>
			       <br>
			<span class="error"><?php echo $Finerr;?> </span>
				

		</form>
		</div></div>
 
		</div></div></div>
		<br>

		

	

</body>
</html>