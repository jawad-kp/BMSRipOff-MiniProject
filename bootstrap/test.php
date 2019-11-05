<?php

		$servername = "127.0.0.1";
        $username = "root";
        $db = "ieeedb";
        $password = "";


// Create connection
$conn = new mysqli($servername, $username, $password, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT  FROM posts";
$result = $conn->query($sql);

?>

<html>
<head>
    <title>This is the blog part of IEEE</title>
 <meta charset="utf-8">
  <meta name="viewport" content="width= device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="IEEE Forum.css">
</head>
<body background="background.jpg" class="background">
    <div class="container-fluid">
         <nav class=" navbar navbar-inverse">
        <div class="navbar-header ">
          <button type="button" class="navbar-toggle icon_marg" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar" style="margin-bottom: 10px;"></span>
            <span class="icon-bar" style="margin-bottom: 10px;"></span>
            <span class="icon-bar"></span>                     
          </button>
          
        <a class="navbar-brand custom-brand col-xs-12" href="#" style="padding: 0;"><img src="logo1-1.png" height="75px" width="75px" ></a>
    </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav"style="margin-left: 10px; margin-top: 12px;">
            <li class="active"><a href="#"class = "col-xs-12">&nbspForum</a></li>
            <li><a href="showPosts.php"class = "col-xs-12">JOIN IEEE</a></li>
                    <li><a href="#home"class = "col-xs-12">Contact</a></li>
                    <li><a href="#news"class = "col-xs-12">Committee</a></li>
                    <li><a href="#contact"class = "col-xs-12">Events</a></li>
                    <li><a href="#about"class = "col-xs-12">About</a></li>
          </ul>
        </div>
    </nav>
         <div class="row post">
            <div class="col-xs-10"> 



                <?php if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {


                        $post_15char = substr($row["post"],0,15);
                        ?><button onclick="">
                             <p class=" col-xs-12 title "><?php echo $row["name"];?></p>
                             <p class="col-xs-12 desc"> <?php echo $post_15char ?></p></button>

                        <?php
                    }
                } else {
                    echo "0 results";
                }
                $conn->close();

                ?>
                
            </div>

         </div>

         

</body>
</html>




<?php



















?>
