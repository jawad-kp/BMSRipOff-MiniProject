<?php
	session_start();
	//echo "so yeah<br>";
	if(isset($_POST["Time"]) && !empty($_POST["Time"]))
	{
		$_SESSION["MovieTime"] = $_POST["Time"];
		echo $_SESSION["MovieTime"];

	}
	//echo "This aint it chief";

  ?>