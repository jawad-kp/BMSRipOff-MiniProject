<?php
session_start();
  ?>

<!DOCTYPE html>
<html>
<head>
	<title>Select Your Seats</title>
</head>
<body>
<?php 
	echo $_SESSION["MovieTime"]."<br>";
	echo $_SESSION["ScrNm"]."<br>";
	echo $_SESSION["user"];
?>
</body>
</html>