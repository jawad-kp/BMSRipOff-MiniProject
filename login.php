<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width= device-width, initial-scale=1">
  	<style type="text/css">
  		.error{ color: red; font-size: 16px }
  	</style>
  	<!-- Move the styling to an external CSS later on ALSO ADD SESSION FOR FUTURE SCREENS -->
</head>

<body>
	<?php
	$servername = "127.0.0.1";
	$username = "root";
	$db = "bmsripoff";
	$password = "";
	//Move config outside and integrate later
	// Create connection
	$conn = new mysqli($servername, $username, $password,$db);//creating a connection object

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	echo "Connected successfully <br>";
	$uiderr=$pswderr=$btmerr=$uid=$pswd="";
	$boo = true;

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

	    if(empty($_POST["pass"]))
	    {
	        $pswderr="Please enter a Password";
	        $boo = false;
	    }
	    else
	    {
	    	$pswd=chngIP($_POST["pass"]);
	    }//password

	    if($boo)
	    {
	    	$qry = $sql = "SELECT `pass` FROM `login` WHERE uid LIKE '".$uid."'";
	    	echo $qry."<br>";
	    	$res = $conn->query($qry);
	    	if ($res->num_rows > 0)
		    {
		    	$row = $res->fetch_assoc();
		    	$dbPass = $row["pass"];
		    	echo $dbPass."<br>";
		    	//echo password_hash($pswd, PASSWORD_BCRYPT)."<br>";
		    	// $someval = password_verify($pswd, $dbPass);
		    	// echo $someval."<br>";
		    	if(password_verify($pswd, $dbPass))
		    	{
		    		$btmerr = "Correct Info. Hashed and verified";
		    		//Save session info here when we build the next screens
		    	}

		    	else
		    	{
		    		$btmerr = "Incorrect User or Pass. Access Declined";
		    		$boo =false;
		    	}
		    }
		    else
		    {
		    	$btmerr = "User or pass is incorrect. Outer else triggered";
		    	$boo = false;
		    }

	    }
	}

	function chngIP($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;

        }//Refer Register.php for documentation same modify input and delete any space stuff
        ?>

        <form name="HenloFrens" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "post" >
	        <label >User ID</label>
				<input type="text" name="uid" placeholder="User ID" size="50" style="width: 300px; height: 30px; border-radius: 5px;">
				<span class="error">*  <?php echo $uiderr;?> </span>	
			<br>

			<label>Pass</label>
	           <input type="password" placeholder="Enter Password" name="pass">
	           <span class="error">* <?php echo $pswderr;?> </span>	
	         <br>
	         <span class="error"> <?php echo $btmerr;?> </span>	
	       <button type="submit">Submit</button> 
	       <br>
	   </form>
 
 <!-- php ends there hopefully -->
</body>
</html>