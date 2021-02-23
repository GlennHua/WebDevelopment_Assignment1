<html>
<body bgcolor="#DCDCDC">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Search Status Result Page</title>

    <style>
        .infos {
            background: #44a07a;
            color: white;
            padding: 20px;
            margin: 10px 300px;
            border-radius: 15px;
        }

        li {
            margin-left: 30px;
        }

        .button {
            width: 120px;
            height: 30px;
            border-radius: 10px;
            background: #44a07a;
            font-size: 20px;
            color: #DCDCDC;
        }

    </style>
</head>

<body>
<?php

//Use login details below to login to server and database, otherwise comment them and use another way to login which was provided below
//$host = 'localhost';
//$user = 'root';
//$pswd = '';
//$dbnm = 'hzy';
$dbtb = 'status';
//$output = '';

require_once ("../../conf/settings.php"); //Please make sure the path is correct, if not working please try another way above, type in login details in this php file.

//connect to server using login details provided/grabed from settings, if cannot connect to server, display error number and error descripution.
$con = @mysqli_connect($host, $user, $pswd) or die("Failed to connect to the server, Error number" . mysqli_errno() . "Error Descripution:" . mysqli_error());

//Select target database and connect with provided infos above
//Display error message which are error description and error code, when failed to reach the target database
@mysqli_select_db($con, $dbnm) or die("Failed to connect to target database, Error Number" . mysqli_errno($con) . "Error Descripution:" . mysqli_error($con));


//$result = mysqli_query($con, $find);

//if($status == "")
//{
//echo"<script>alert('This field can not be blank'); history.back(); </script>";
//}



    $status = $_GET["status"];
    $find = "SELECT * FROM $dbtb WHERE status LIKE '%" . $status . "%'"; // select records by matching the keywords in contents of status
    $result = mysqli_query($con, $find);
    $count = mysqli_num_rows($result);


//match the records of status that were already uploaded to database, if matched, dispaly all records that contains keywords that user has typed in text field 
//if failed to found such a record, pop up a laert windows says could not find such a status.
	if(empty($status))
		echo "<script>alert('Search string cannot be empty.'); history.back();</script>";
	else {
		echo "<h1 class='infos'>$count similar results found:</h1><br>";
        if($count){
		while ($row = mysqli_fetch_array($result)) {
            $status = $row["status"];
            $statuscode = $row["statuscode"];
            $share = $row["share"];
            $date = $row["date"];
            $type = $row["type"];
            echo "<ul class='infos'><li>Status Code: <b>$statuscode</b></li>";
            echo "<li>Status: <b>$status</b></li>";
            echo "<li>Share: <b>$share</b></li>";
            echo "<li>Date: <b>$date</b></li>";
            echo "<li>Permission: <b>$type</b></li></ul>";
        }
		}else{
		echo "<script>alert('There is no status like that.'); history.back();</script>"; }
    }
		
	mysqli_free_result($result); //release the information that were collected from database records
	mysqli_close($con);//close the connection of database

?>
<div class="infos">
    <a class="button" style="" href="searchstatusform.html">Search for another Status
        Page</a>
    <a class="button" style="margin-left: 20px;" href="index.html">Return To Home Page</a>
</div>
</body>
</html>
