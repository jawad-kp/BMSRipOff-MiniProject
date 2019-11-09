<!DOCTYPE html>
<html>
<head>
	<title>Delete a Show</title>
	<script src="jquery/dist/jquery.js"></script>
	<!-- <script src="jquery-3.4.1.min.js"></script> -->

	<script type="text/javascript">

$(document).ready(function(){
	var rk = "";
	var disone5you ="no";
    $('#name').on('change',function(){
        var movieName = $(this).val();
        rk = movieName;
        if(movieName){
        	disone5you ="no";
            $.ajax({
                type:'POST',
                url:'UpdateShit.php',
                data:{Name: rk, deactone:disone5you },
                success:function(html){
                    $('#screen').html(html);
                    $('#time').html('<option value="">Select screen first</option>'); 
                }
            }); 
        }else{
            $('#screen').html('<option value="">Select movie first</option>');
            $('#time').html('<option value="">Select screen first</option>'); 
        }
    });
    
    $('#screen').on('change',function(){
        var Scnm = $(this).val();
        disone5you = "yes";
        if(Scnm){
        	disone5you ="yes";
            $.ajax({
                type:'POST',
                url:'UpdateShit.php',
                data:{Screen: Scnm, Name: rk, deactone: disone5you},
                success:function(html){
                    $('#time').html(html);
                }
            }); 
        }else{
            $('#time').html('<option value="">Select screen first</option>'); 
        }
    });
});
</script>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="l2.css">
  <link rel="stylesheet" type="text/css" href="Hover-master/css/hover.css">
  <link rel="stylesheet" type="text/css" href="CSS Animations/animate.css">
  	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
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

	

	$boo = true;
	$mverr=$scerr=$timerr="";//error variables
	$btm="lol fresh";
	$scr=$tim="";//data varaibles
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		 	if(empty($_POST["Name"]))
		    {
		        $mverr="Please Select a Movie";
		        $boo = false;
		    }

		    if(empty($_POST["Screen"]))
		    {
		        $scerr="Please Select a Screen";
		        $boo = false;
		    }
		    else
		    {
		    	$scr=chngIP($_POST["Screen"]);
		    }//Movie's Screen

		    if(empty($_POST["Time"]))
		    {
		        $timerr="Please Select a Time";
		        $boo = false;
		    }
		    else
		    {
		    	$tim=chngIP($_POST["Time"]);
		    }//Movie's Time

		    send_data($boo,$scr,$tim);
	}//end of validation if

	function chngIP($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;

        }//Modifies input for use

        function send_data($bleh,$sr,$tm)
        {
        	echo "Entered send_data with value: ".$bleh."<br>"."Screen: ".$sr."<br>"."Time: ".$tm."<br>";

   			if($bleh)
   			{
   				$qry = "DELETE FROM `moviet` WHERE `Screen` = '".$sr."' AND `Time` = '".$tm."'";//The Delete Query

   				echo $qry."<br>";
				$valT = $GLOBALS['conn']->query($qry);
				echo $valT;
   				if ($valT) 
   				{
   					header("Location: http://localhost:8080/DBMS/wutishappening.html");
   					
   				}
   				else
   				{
   					echo "Did not delete record: ".$GLOBALS['conn']->error;//Prints error in case query doesn't work
   				}

   				$GLOBALS['conn']->close();
   			}
   		
        }

	?>
<ul>
  <li><a href="addmovie.php">ADD MOVIE</a></li>
  <li><a href="addshow.php">ADD SHOW</a></li>
  <li><a href="deletemovie.php">DELETE MOVIE</a></li>
  <li><a class="active" href="">DELETE SHOW</a></li>
  <li><a href="admin_reg.php">REGISTER ADMIN</a></li>
  <li><a href="logout.php">LOGOUT</a></li>


</ul>
	<div class="container-fluid">
    <center><h1 style="color: white; font-size: 40px;" class="fadeInDownBig animated" >Delete Movie</h1></center><br><br><br>
    <div class="d-flex justify-content-center">

    <div class="pos">
	<form name="HenloFrens" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "post" > 
			<div class="row form-group">
	 		<div class="col-sm-4">
			<label >Movie's Name :</label></div>
			<div class="col-sm-6">
				<select name="Name" id="name">
					<option value="">Select a Movie </option>
				<?php
					$sql = "SELECT DISTINCT Name FROM `moviet`";
					$NmList = $conn->query($sql);
					while($row = $NmList->fetch_assoc()) 
					{
						echo "<option value=\"".$row["Name"]."\">".$row["Name"]."</option>";
						//This should generate a list of available movies and makes sure you select only a movie that's been added
					}
				  ?> 
				</select>
				<span class="error">* <?php echo $mverr;?></span>
			</div></div>
			<div class="row form-group">
	 	<div class="col-sm-4">
			<label >Screen :</label></div>
				<div class="col-sm-6">
				<select name="Screen" id="screen">
			        <option value="">Select Movie first</option>
			    </select>
			    <span class="error">* <?php echo $scerr;?></span>
			</div></div>
			<div class="row form-group">
	 	<div class="col-sm-4">
			<label >Time :</label> </div>
			<div class="col-sm-6"> 
			    <select name="Time" id="time">
			        <option value="">Select Time first</option>
			    </select>
			    <span class="error">* <?php echo $timerr;?></span>
			    </div></div>
			    <center><button class="btn btn-primary hvr-float" type="submit">Delete</button></center>
			       <br>		

			    </form>	</div></div></div>	
			    <?php echo $btm;?>


	</body>
</html>