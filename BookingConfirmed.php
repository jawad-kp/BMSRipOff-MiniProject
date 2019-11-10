<?php 
session_start();
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Booking Confirmed!!!</title>
 	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="Hover-master/css/hover.css">
  <!-- <link rel="stylesheet" type="text/css" href="CSS Animations/animate.css"> -->
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script><meta name="viewport" content="width= device-width, initial-scale=1">
    <style type="text/css">
    	body{
	background-image: url(mapgenbg1.jpg);
	width: 100%;
	background-attachment: fixed;
	background-repeat: no-repeat;
	background-size: cover;
	background-position: center;
	height: 100%;
	padding: 0;
	margin: 0;
}
    </style>

 </head>
 <body>
 	<br>
 	<br>
 	<center>
 	<h4>
 	<?php
 	echo "No of seats Booked is: ".$_SESSION["Seats"]."<br>";
 	echo "Your BookingID is: ".$_SESSION["BkID"];
 	?>
 	</h4>
 	<br><br>

 	<a class="btn btn-info hvr-float-shadow" style="color: white; font-size: 30px;" href="ViewBookings.php" style="text-decoration: none; color: red; border-color: black;" > Click Here To View Your Bookings</a>
 	<br>
 	<br>

 	<a class = "btn btn-primary hvr-float-shadow" style="color: white; font-size: 30px" href="ViewMovie.php" style="text-decoration: none; color: red; border-color: black;" > Click Here To Book Another Movie</a>
 	<br><br>
<a class = "btn btn-success hvr-float-shadow" style="color: white; font-size: 30px" href="logout.php" style="text-decoration: none; color: red; border-color: black;" > Click Here To Logout</a>
 	</center>
 
 </body>
 </html>