<?php
	session_start();
	if(isset($_POST["Name"]) && !empty($_POST["Name"]))
	{
		$_SESSION["Movie"] = $_POST["Name"];

	}
	/* Here's an explanation of what's happening
	So, It's hard to  configure a button click to a php function.
	It's even harder to pass a string directly as a value to it because php is interpreted only once.So this is my Solution. I used AJAX to get this section to work and here's how I did it.
	1) Instead of changing button id's or something I set an Attribute called value and assigned the name of the movie to it.
		So now my button after the page is interpreted by the browser becomes 
			<button value="Your Mom is Existential">Your Mom is Existential</button>
		after being generated in ViewMovie.php using:
		while($row = $res->fetch_assoc()) 
		{
			echo "<button value = \"".$row["Name"]."\">".$row["Name"]."</button><br>";
		}
	2)When you click a button the AJAX function sends a HTTP POST request to this page
		The Post data incudes the aforementioned value as "Name"
	3)This page uses that POST data and sets up a session variable named "Movie" that now allows us to send movie data between pages
	4)After this execution POST data is returned to ViewMovie.
	5)Because our job is done on this page, I used the ".done()" part after the ".ajax" part to redirect us to the new page where the user can select Time.

	You can see this in action when SelectTime.php displays the Name of the selected movie
	
	*/


  ?>