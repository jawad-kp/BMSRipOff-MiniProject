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
	<title>Delete a Movie from the Roster</title>
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

	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


	// Create connection
	$conn = new mysqli($servername, $username, $password,$db);//creating a connection object

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	//echo "Connected successfully <br>";

	$mverr="";
    $mvnm="";
    $boo= true; //flag for the form
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
	    if(empty($_POST["mvnm"]))
	    {
	        $mverr="Please enter a Movie Name";
	        $boo = false;
	    }
	    else
	    {
	    	$mvnm=chngIP($_POST["mvnm"]);
	    }//Movie's Name

	    send_data($boo, $mvnm);
	}

	function chngIP($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;

        }//Modifies input for use
	function send_data($bleh,$MovieName)
        { 
        	echo "Entered send_data with value: ".$bleh."<br>"."Movie's Name: ".$MovieName."<br>";

   			if($bleh)
   			{
   				$qry = "DELETE FROM `deets` WHERE `deets`.`Name` LIKE '".$MovieName."'";//The Delete Query
				$valT = $GLOBALS['conn']->query($qry);
   				if ($valT === TRUE) 
   				{
   					$_SESSION["deleteMovieStat"] = "Deleted Record Successfully!!!";
   					header("Location: http://localhost:8080/DBMS/DeleteMovie.php");
   				}
   				else
   				{
   					echo "Did not delete record: ".$GLOBALS['conn']->error;//Prints error in case query doesn't work
   				}

   				$GLOBALS['conn']->close();
   			}
   		}
	?>
<ul>
	<li><a class="active" href="">DELETE MOVIE</a></li>
  	<li><a href="addmovie.php">ADD MOVIE</a></li>
  	<li><a href="addshow.php">ADD SHOW</a></li>
	<li><a href="deleteshow.php">DELETE SHOW</a></li>
  	<li><a href="admin_reg.php">REGISTER ADMIN</a></li>
  	<li><a href="ViewStats.php">VIEW SALES</a></li>
  	<li><a href="logout.php">LOGOUT</a></li>
</ul>
	<div class="container-fluid">
    <center><h1 style="color: white; font-size: 40px;" class="fadeInDownBig animated" >Delete Movie</h1></center><br><br><br>
    <div class="d-flex justify-content-center">

   <div class="pos">
	

	<form name="HenloFrens" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "post" > 
        <div class="row form-group">
	 	<div class="col-sm-4">
		<label > Movie's Name :</label></div>
 				<!-- <input type="text" name="mvnm" placeholder="Movie's Name" style="width: 300px; height: 30px; border-radius: 5px;"> -->
 		<div class="col-sm-6">
		<select name="mvnm">
					<option value="" selected>Select a Movie </option>
				<?php
					$sql = "SELECT Name FROM `deets`";
					$NmList = $conn->query($sql);
					while($row = $NmList->fetch_assoc()) 
					{
						echo "<option value=\"".$row["Name"]."\">".$row["Name"]."</option>";
						//This should generate a list of available movies and makes sure you select only a movie that's been added
					}
				  ?>

				</select></div></div>
		<span class="error"><?php echo $mverr;?></span>	
		<br>

		<center><button class="btn btn-primary hvr-float" type="submit">Delete</button></center>
			       <br>	

		<?php
		if (isset($_SESSION["deleteMovieStat"])) 
		{
		  echo $_SESSION["deleteMovieStat"];
		  unset($_SESSION["deleteMovieStat"]);
		  }  ?>	

	</form>
	</div></div></div>

</body>
</html>