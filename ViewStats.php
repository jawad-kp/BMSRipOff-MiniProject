<?php
session_start();
if (!(isset($_SESSION["adm"]))) {
	die("You are Illegally Accessing this page:");
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>View Sales Stats</title>

	<meta charset="utf-8">
  	<meta name="viewport" content="width= device-width, initial-scale=1">
  	<style type="text/css">
  		.error{ color: red; font-size: 16px }
  	</style>
  	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="l2.css">
  <link rel="stylesheet" type="text/css" href="Hover-master/css/hover.css">
  <link rel="stylesheet" type="text/css" href="CSS Animations/animate.css">
  <script src="jquery/dist/jquery.js"></script>
  	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
  	<script>
  		$(document).ready(function(){
		var rk = "";
		var disone5you ="no";
	    $('#name').on('change',function()
	    {
	        var movieName = $(this).val();
	        rk = movieName;
	        if(movieName)
	        {
	            $.ajax({
	                type:'POST',
	                url:'SendSalesData.php',
	                data:{Name: rk},
	                success:function(html)
	                {

	                	 $('#tkts').html(html);
	                }
            }); 
        }
        else
        {
            $('#tkts').html('Please Select a Movie');
        }
    	});
	})

     </script>
</head>
<body>
	<?php
	// we can probably put most of this in a config file i'll figure that out later
	$servername = "127.0.0.1";
	$username = "root";
	$db = "bmsripoff";
	$password = "";
	// mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

	// Create connection
	$conn = new mysqli($servername, $username, $password,$db);//creating a connection object
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	//echo "Connected successfully <br>";

	?>

	<ul>
	<li><a class="active" href="">VIEW STATS</a></li>
  <li><a href="addmovie.php">ADD MOVIE</a></li>
  <li><a href="addshow.php">ADD SHOW</a></li>
  <li><a href="deletemovie.php">DELETE MOVIE</a></li>
  <li><a href="admin_reg.php">REGISTER ADMIN</a></li>
  <li><a href="DeleteShow.php">DELETE SHOW</a></li>
  <li><a href="logout.php">LOGOUT</a></li>


</ul>
	<div class="container-fluid">
    <center><h1 style="color: white; font-size: 40px;" class="fadeInDownBig animated" >View Sales</h1></center><br><br><br>
    <div class="d-flex justify-content-center">
    
    <div class="pos">

	<form name="HenloFrens" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "post" > 
			<div class="row form-group">
		 		<div class="col-sm-4">
				<label >Movie's Name :</label></div>
				<div class="col-sm-6">
					<select name="Name" id="name">
						<option value="">Select a Movie </option>
					<?php
						$sql = "SELECT `Name` FROM `salesstat`";
						$NmList = $conn->query($sql);
						while($row = $NmList->fetch_assoc()) 
						{
							echo "<option value=\"".$row["Name"]."\">".$row["Name"]."</option>";
							//This should generate a list of available movies and makes sure you select only a movie that's been added
						}
					  ?> 
					</select>
					<br>
				</div>
			</div>

			<!-- <center><button class="btn btn-primary hvr-float" type="submit">Submit</button></center>
			       <br>	 -->	
	</form>
	<div id="tkts">

		<div class="row">
			<div class="col-sm-2"></div>
			<div class="col-sm pos">Please Select a Movie</div>
			<div class="col-sm-2"></div>
		</div>
	</div>
</div>
</div>
</div>
</body>
</html>