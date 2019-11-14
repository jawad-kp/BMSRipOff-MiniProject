<?php 
session_start();
if (!(isset($_SESSION["adm"]))) {
	die("You are Illegally Accessing this page:");
}
 ?>


<!DOCTYPE html>
<html>
<head>
	<title> Add a Movie to the roster</title>
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
	// we can probably put most of this in a config file i'll figure that out later
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
	$mverr=$synerr=$raterr=$langerr=$btmstat="";
    $mvnm=$synopsis=$rating=$lang="aa";
    $boo= true; //this is our flag to make sure registration is legit
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
	    }//UID
	     if(empty($_POST["synopsis"]))
	    {
	        $synerr="No Synopsis input";
	        $boo = false;
	    }
	    else
	    {
	    	$synopsis=chngIP($_POST["synopsis"]);
	    }//name
	    if(empty($_POST["rating"]))
	    {
	        $raterr="No Certification Selected";
	        $boo = false;
	    }
	    else
	    {
	    	$rating=chngIP($_POST["rating"]);
	    }//Password
	    if(empty($_POST["lang"]))
	    {
	        $langerr="No Language Selected";
	        $boo = false;
	    }
	    else
	    {
	    	$lang=chngIP($_POST["lang"]);
	    }
	    send_data($boo,$mvnm,$synopsis,$rating, $lang);//passing the globals because otherwise it's a pain in the ass
	    
	}//if for emptyData ends here
	/* By the end of this we've verified data and have sent it to our sending function. I'll see how we can make this smaller once we get further along. For now it works and I'll find ways to imporve efficiency if time permits*/
	function chngIP($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }//this removes trailing spaces and makes it an html element so you can't rip it off don't know why stripslashes but meh but it sorta removes the special characters if the user adds any.
        function send_data($bleh,$MovieName,$Synop,$PGRating, $Language)
        { 
	    	if($bleh)
	    	{
		    	$qry = "INSERT INTO `deets` (`Name`, `Synop`, `PGRating`, `Language`) VALUES (?,?,?,?)";
		    	
		    	$prepStmt = $GLOBALS['conn']->prepare($qry);//This works simliar to the Java thingy where we create a prepared statement
		    	$chkQu = "SELECT `Name` FROM `deets` WHERE `Name` LIKE \"".$MovieName."\"";
		    	$res = $GLOBALS['conn']->query($chkQu);
		    	if (!($res->num_rows != 0))
		    	{
		    		$prepStmt->bind_param("ssss",$MovieName,$Synop,$PGRating,$Language);
		    		$prepStmt->execute();
		    		$GLOBALS["btmstat"] = "Movie Added Successfully";
		    	}//No other Movie of the same name
		    	else
		    		$GLOBALS['mverr'] = "Movie has already been added. Please Use a different name";
		    	$GLOBALS['conn']->close();
			}
    	}//send_data
	//echo "hello";
    ?> 
    <ul>
  <li><a class="active" href="">ADD MOVIE</a></li>
  <li><a href="addshow.php">ADD SHOW</a></li>
  <li><a href="deletemovie.php">DELETE MOVIE</a></li>
  <li><a href="deleteshow.php">DELETE SHOW</a></li>
  <li><a href="admin_reg.php">REGISTER  an ADMIN</a></li>
  <li><a href="ViewStats.php">VIEW SALES</a></li>
  <li><a href="logout.php">LOGOUT</a></li>



</ul>













    <div class="container-fluid">
    <center><h1 style="color: white; font-size: 40px;" class="fadeInDownBig animated" >Add Movie</h1></center><br><br><br>
    <div class="d-flex justify-content-center">

    	<div class="pos">
	 <form name="HenloFrens" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "post" > 
		<div class="row form-group">
	 		<div class="col-sm-4">
				<label > Movie's Name </label></div>
				<div class="col-sm-6">
		<input type="text" name="mvnm" placeholder="Movie's Name" style="width: 300px; height: 30px; border-radius: 5px;">
		<span class="error">* <?php echo $mverr;?></span>	
		</div></div>
		<div class="row form-group">
	 		<div class="col-sm-4">
				<label class="pos">Synopsis</label></div>
				<div class="col-sm-6">
		<textarea rows="4" cols="50" name="synopsis"></textarea>
		<span class="error">*  <?php echo $synerr;?> </span>	
		</div></div>

		<div class="row form-group">
	 		<div class="col-sm-4">
				<label>Rating</label></div>
		<div class="col-sm-6">
           <select name="rating">
           		<option value="U">U</option>
           		<option value="UA">UA</option>
           		<option value="A">A</option>
           		<option value="S">S</option>
           </select>
           <span class="error">* <?php echo $raterr;?> </span>	
         </div>	</div>
         
         <div class="row form-group">
	 		<div class="col-sm-4">
         <label>Language</label></div>
         <div class="col-sm-6">
           <input type="text" placeholder="Language" name="lang">
           <span class="error">* <?php echo $langerr;?> </span>	
         </div></div>
         

         <center><button class="btn btn-primary hvr-grow" type="submit">Add</button></center>

         <h3> <?php echo $btmstat;?> </h3>
			       <br>
			       

	</form>
</div></div></div>
</body>
</html>