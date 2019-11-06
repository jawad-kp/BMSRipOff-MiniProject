

<!DOCTYPE html>
<html>
<head>
	<title>Register an Admin</title>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width= device-width, initial-scale=1">
  	<style type="text/css">
  		.error{ color: red; font-size: 16px }
  	</style>
</head>
<body>
	 <?php
	// we can probably put most of this in a config file i'll figure that out later
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
	        $pswderr="Please enter a valid Name";
	        $boo = false;
	    }
	    else
	    {
	    	$pswd=chngIP($_POST["pass"]);
	    }//Password

	    if(empty($_POST["RePass"]))
	    {
	        $reperr="Please enter a valid Name";
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
		    		$uiderr = "User ID is in use";
		    	$GLOBALS['conn']->close();
			}

    	}//send_data
	//echo "hello";
    ?> 
	 <form name="HenloFrens" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "post" > 
	<!-- <form name="HenloFrens" method = "post" > -->
		<label >Name </label>
		<input type="text" name="nm" placeholder="Your name..." size="50"; style="width: 300px; height: 30px; border-radius: 5px;">
		<span class="error">* <?php echo $nmerr;?></span>	
		<br>

		<label >Admin ID</label>
		<input type="text" name="uid" placeholder="User ID" size="50" style="width: 300px; height: 30px; border-radius: 5px;">
		<span class="error">*  <?php echo $uiderr;?> </span>	
		<br>

		<label>Password</label>
           <input type="password" placeholder="Enter Password" name="pass">
           <span class="error">* <?php echo $pswderr;?> </span>	
         <br>	

         <label>Re-Type Password</label>
           <input type="password" placeholder="Enter Password" name="RePass">
           <span class="error">* <?php echo $reperr;?> </span>	
         <br>

         <button type="submit">Submit</button>	

	</form>

</body>
<?php
echo "<br>end of the line"
?>
</html>