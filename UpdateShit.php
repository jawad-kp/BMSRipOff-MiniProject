<?php
//Include database configuration file
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
        echo "Connection Successful";


    $tisDaName = "";

if(isset($_POST["Name"]) && !empty($_POST["Name"]))
{
    //Get all Name data
    if (isset($_POST["deactone"])) 
    {
        if (strcmp($_POST["deactone"], "no") == 0 ) 
        {
           
        
   
            $sql = "SELECT DISTINCT Screen FROM `moviet` WHERE Name = '".$_POST["Name"]."'";
            $RunIt = $conn->query($sql);
             //$RunIt->num_rows;
            
            //Display states list
            if($RunIt->num_rows> 0)
            {
                echo "<option value=\"\">Select Screen</option>";
                while($row = $RunIt->fetch_assoc())
                { 
                    echo "<option value=\"".$row["Screen"]."\">".$row["Screen"]."</option>";
                }
            }
            else
            {
                echo "<option value=\"\">Screen Unavailable</option>";
            }
        }
    }
}
// else
//     echo "Hi There Did not enter the first if. There's a fuckywucky";

if(isset($_POST["Screen"]) && !empty($_POST["Screen"]))
{
    //Get all Time data
    $lolk = "SELECT Time FROM `moviet` WHERE Name = '".$_POST["Name"]."' AND Screen = '".$_POST["Screen"]."'";
    

    //$sql = "SELECT Time FROM `moviet` WHERE Name = 'Abc' AND Screen = '".$_POST["Screen"]."'";
    $RunIt = $conn->query($lolk);
    
    //Count total number of rows
     $RunIt->num_rows;
    //echo $sql;
    
    //Display cities list
    if($RunIt->num_rows > 0)
    {
        echo "<option value=\"\">Select Time</option>";
       // echo "<option value=\"\">".$lolk. " something before this </option>";
        while($row = $RunIt->fetch_assoc())
        { 
            echo "<option value=\"".$row['Time']."\">".$row["Time"]."</option>";
        }
    }
    else
    {
        echo "<option value=\"\">Time Slot Unavailable</option>";
    }
}
?>