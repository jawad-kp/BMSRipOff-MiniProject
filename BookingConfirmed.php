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
 
 </body>
 </html>