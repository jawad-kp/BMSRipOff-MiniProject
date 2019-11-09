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
	<title>Register an Admin</title>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width= device-width, initial-scale=1">
  	<style type="text/css">
  		.error{ color: yellow; font-size: 16px }
  	</style>
  	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="regPage.css">
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

	$uiderr=$pswderr=$reperr=$nmerr="";
    $uid=$pswd=$RePass=$nm="aa";
    $boo= true; //this is our flag to make sure registration is legit
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
	    if(empty($_POST["uid"]))
	    {
	        $uiderr="Please enter a valid User ID";
	        $boo = false;
	    }
	    else
	    {
	    	$uid=chngIP($_POST["uid"]);
	    }//UID


	     if(empty($_POST["nm"]))
	    {
	        $nmerr="Please enter a valid Name";
	        $boo = false;
	    }
	    else
	    {
	    	$nm=chngIP($_POST["nm"]);
	    }//name


	    if(empty($_POST["pass"]))
	    {
	        $pswderr="Please enter a valid Password";
	        $boo = false;
	    }
	    else
	    {
	    	$pswd=chngIP($_POST["pass"]);
	    }//Password

	    if(empty($_POST["RePass"]))
	    {
	        $reperr="Please enter a valid Password";
	        $boo = false;
	    }
	    else
	    {
	    	$RePass=chngIP($_POST["RePass"]);
	    }//Repeat Password

	    if ($boo && $pswd != "" && $RePass != "") 
	    {
	    	if (strcmp($pswd, $RePass) !== 0) 
	    	{
	    		$boo = false;
	    		$reperr= "Passwords Do Not match";
	    	}
	    	
	    }// Passwords don't match
		//echo "no problem in check and changeIP<br>";
	    send_data($boo,$uid,$nm,$pswd);//passing the globals because otherwise it's a pain in the ass
	    
	}//if for emptyData ends here

	/* By the end of this we've verified data and have sent it to our sending function. I'll see how we can make this smaller once we get further along. For now it works and I'll find ways to imporve efficiency if time permits*/


	function chngIP($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;

        }//this removes trailing spaces and makes it an html element so you can't rip it off don't know why stripslashes but meh but it sorta removes the special characters if the user adds any.
        function send_data($bleh,$usr,$name,$pass)
        { 
        	//echo "Entered send_data with value: ".$bleh."<br>"."User ID ".$usr."<br>"."Name: ".$name."<br>"."Pass: ".$pass."<br>";
	    	if($bleh)
	    	{
		    	$qry = "INSERT INTO `admin_log` (`Admin`, `Pass`, `Name`) VALUES (?, ?, ?)";
		    	//echo "First Stirng Created <br>".$usr."<br> This should come after uid <br>";
		    	$prepStmt = $GLOBALS['conn']->prepare($qry);//This works simliar to the Java thingy where we create a prepared statement.
		    	//echo "Query is prepared <br>";

		    	//First we check if username already exists
		    	$chkQu = "SELECT `Admin` FROM `admin_log` WHERE `Admin` LIKE \"".$usr."\"";
		    	$res = $GLOBALS['conn']->query($chkQu);
		    	//echo "Exectued first Check<br>";
		    	if (!($res->num_rows != 0))
		    	{
		    		//echo "Entered if after first fetch <br>";
		    		$pass = password_hash($pass, PASSWORD_DEFAULT); //I encrypt the passwords here so they're not plain text but are hashes instead. This basically gives us additional security
		    		$prepStmt->bind_param("sss",$usr,$pass,$name);
		    		//echo "Statement prepared lol <br>";
		    		$prepStmt->execute();
		    		echo "Account Created Successfully";
		    		// else
		    		// 	echo "Account not Created";
		    	}//User id is not in use
		    	else
		    		$GLOBALS["uiderr"] = "User ID is in use";
		    	$GLOBALS['conn']->close();
			}

    	}//send_data
	//echo "hello";
    ?>
    <div class="container-fluid">
    <center><h1 style="color: white; font-size: 40px;" class="fadeInDownBig animated" >Admin Register</h1></center><br><br><br>
    <div class="d-flex justify-content-center">

    	<div class="pos">
	 <form name="HenloFrens" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "post" > 
	<!-- <form name="HenloFrens" method = "post" > -->
		<div class="row form-group">
	 		<div class="col-sm-3">
				<label class = "lab" style="color:white;">Name </label>
			</div>
			<div class="col-sm-6">
				<input type="text" name="nm" placeholder="Your name" class="form-control">
			</div>
			<div  class="error col-sm-3">* 
				<?php echo $nmerr;?>
					
			</div>	
		</div>


		<div class="row form-group">
			<div class="col-sm-3">
				<label class = "lab" style="color:white;">Admin ID</label>
			</div>
			<div class="col-sm-6">
				<input type="text" name="uid" placeholder="User ID" class="form-control">
			</div>
			<div  class="error col-sm-3">*  
				<?php echo $uiderr;?> 
			</div>	
		</div>

		<div class="row form-group">
			<div class="col-sm-3">
				<label class = "lab" style="color:white;">Password</label>
			</div>
			<div class="col-sm-6">
           		<input type="password" placeholder="Enter Password" name="pass" class="form-control">
           	</div>
           	<div  class="error col-sm-3">* 
           		<?php echo $pswderr;?> 
           </div>

        </div>

        <div class="row form-group">

	        <div class="col-sm-3">
	         	<label class = "lab" style="color:white;">Re-Type Password</label>
	     	</div>
	     	<div class="col-sm-6">
           		<input type="password" placeholder="Enter Password" name="RePass" class="form-control" >
           	</div>
           	<div class="col-sm-3 error">*
           	 	<?php echo $reperr;?> 
           	</div>

         </div>
         <div class="row">
        	<div class="col-sm"></div>
        	<div class="col-sm">
	        	<button type="submit" class="btn btn-primary hvr-radial-out " style="font-size: 25px; background-color: black; color: white">Submit</button>	
     		</div>
        	<div class="col-sm"></div>
		</div>	

	</form>
</div></div>
</body>
<?php
echo "<br>end of the line"
?>
</html>