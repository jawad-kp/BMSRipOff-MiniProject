<?php
	session_start();
	//echo "so yeah<br>";
	if(isset($_POST["Time"]) && !empty($_POST["Time"]))
	{
		$_SESSION["MovieTime"] = $_POST["Time"];
		echo $_SESSION["MovieTime"];

	}
	if(isset($_POST["Scr"]) && !empty($_POST["Scr"]))
	{
		$_SESSION["ScrNm"] = $_POST["Scr"];
		echo $_SESSION["ScrNm"];

	}
	
  ?>