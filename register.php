

<!DOCTYPE html>
<html>
<head>
	<title>Register a User</title>
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
	echo "Connected successfully <br>";

	$uiderr=$pswderr=$reperr=$nmerr="";
    $uid=$pswd=$RePass=$nm="";
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
	    	$uid=chngIP($_POST["nm"]);
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
		echo "no problem in check and changeIP<br>";
	    send_data($boo);
	    
	}//if for emptyData ends here


	function chngIP($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;

        }//this rmoves trailing spaces and makes it an html element so you can't rip it off don't know why stripslashes but meh
        function send_data($bleh)
    {
    	if($bleh)
    	{
	    	$qry = "INSERT INTO `login` (`uid`, `pass`, `Name`) VALUES ('?', '?', '?')";
	    	$prepStmt = $conn->prepare($qry);

	    	//First we check if username already exists
	    	$chkQu = "SELECT `uid` FROM `login` WHERE `uid` LIKE '?'";
	    	$chkStmt =  $conn->prepare($chkQu);
	    	$chkStmt->bind_param($uid);
	    	$res = $chkQu->query();
	    	if ($res->num_rows == 0)
	    	{
	    		$prepStmt->bind_param($uid,$pswd,$nm);
	    		if($prepStmt->query())
	    			echo "Account Created Successfully";
	    		else
	    			echo "Account not Created";
	    	}//User id is not in use
	    	else
	    		$uiderr = "User ID is in use";
	    	$conn->close();
		}

    }//send_data
	echo "hello";
    ?> 
	 <form name="HenloFrens" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "post" > 
	<!-- <form name="HenloFrens" method = "post" > -->
		<label >Name </label>
		<input type="text" name="nm" placeholder="Your name..." size="50"; style="width: 300px; height: 30px; border-radius: 5px;">
		<span class="error">* <?php echo $nmerr;?></span>	
		<br>

		<label >User ID</label>
		<input type="text" name="uid" placeholder="User ID" size="50"; style="width: 300px; height: 30px; border-radius: 5px;">
		<span class="error">*  <?php echo $usrerr;?> </span>	
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

