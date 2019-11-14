<?php

$servername = "127.0.0.1";
    $username = "root";
    $db = "bmsripoff";
    $password = "";

    // Create connection
    $conn = new mysqli($servername, $username, $password,$db);//creating a connection object

    // Check connection
    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    }
    else
        // echo "Connection Successful";


    $tisDaName = "";

if(isset($_POST["Name"]) && !empty($_POST["Name"]))
{
	$qry = "SELECT `TktsSold`, 200*`TktsSold` as amount FROM `salesstat` WHERE `Name` LIKE \"".$_POST["Name"]."\"";
	$res = $conn->query($qry);
	if ($res->num_rows>0)
	{
		while ($row = $res->fetch_assoc()) 
		 	{
		 		echo "<div class=\"row\">";
			 		echo "<div class=\"col-sm-2\"></div>";
			 		echo "<div class = \"col-sm pos\">";
				 		echo "Tickets Sold: ".$row["TktsSold"];
		 			echo "</div>";
			 		echo "<div class=\"col-sm-2\"></div>";

		 		echo "</div>";


		 		echo "<div class=\"row\">";
			 		echo "<div class=\"col-sm-2\"></div>";
			 		echo "<div class = \"col-sm pos\">";
				 		echo "Amount Made: ".$row["amount"];
		 			echo "</div>";
			 		echo "<div class=\"col-sm-2\"></div>";

		 		echo "</div>";
		 	}
	}

	// echo $_POST["Name"];
}
  ?>