<?php 
session_start();
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Booking Confirmed!!!</title>
 </head>
 <body>
 	<?php
 	echo "No of seats Booked is: ".$_SESSION["Seats"]."<br>";
 	echo "Your BookingID is: ".$_SESSION["BkID"];
 	?>

 	<a href="http://localhost:8080/DBMS/ViewBookings.php" style="text-decoration: none; color: red; border-color: black;" > Click Here To View Your Bookings</a>

 	<a href="http://localhost:8080/DBMS/ViewMovie.php" style="text-decoration: none; color: red; border-color: black;" > Click Here To Book Another Movie</a>
 
 </body>
 </html>