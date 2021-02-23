<html>
<body bgcolor="#DCDCDC">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Process Post Status Page</title>

    <style>
        .uni {
            background: #44a07a;
            color: white;
            padding: 20px;
            margin: 10px 300px;
            border-radius: 15px;
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

//Infos that we are going to use for connecting db.List down host,user,password,database name,table here will be easy to find and edit.
//$host = 'localhost';
//$user = 'root';
//$pswd = '';
//$dbnm = 'hzy';
$dbtb = 'status';

//Connect to target database server with infos provided above/below

require_once ("../../conf/settings.php"); //Please make sure the path is correct, if not working please try another way above, type in login details in this php file.

//Display error message which are error description and error code, when failed to connect database
$con = @mysqli_connect($host, $user, $pswd) or die("Failed to connect to the Server. Error number" . mysqli_errno() . "Error Description:" . mysqli_error());


//Select target database and connect with provided infos above
//Display error message which are error description and error code, when failed to reach the target database
@mysqli_select_db($con, $dbnm) or die("Failed to connect to target database, Error Number:" . mysqli_error($con) . "Error Descripution:" . mysqli_error($con));


$statuscode = $_POST["statuscode"];    //Declare variables and etrieve input data from form
$status = $_POST["status"];
$share = $_POST["share"];
$date = $_POST["date"];
$restriction4sc = "/^S\d\d\d\d$/";
$excheck = "SELECT * FROM $dbtb WHERE statuscode = '" . $statuscode . "'";
$exist = mysqli_query($con, $excheck);
$type = $_POST["type"];//Retreive multiple-choice input from form
$type1 = implode(",", $_POST['type']);

//Users will have to fill in all of these in order to upload successfuly
if ($statuscode == "" || $status == "" || $share == "" || $date == "" || $type == "") {
    echo "<script>alert('None of these sections is allowed to be empty, please make sure you have done every section, Thank You'); history.back();</script>";
} else if (!preg_match("/^[\w ,.!?]+$/", $status)) {
    echo "<script>alert('The status can only contain alphanumeric characters including spaces, comma, period (full stop), exclamation point and question mark. Other characters or symbols are not allowed'); history.back();</script>";
}

//Double check for statuscode, make sure length of statuscode is 5 and no illegal symbols
//Define 'double check' here. I have done the restrictions of input from 'statuscode'and others e.g.date. in last page which is poststatusform.php

elseif (strlen(!$statuscode) == 5 || (!preg_match($restriction4sc, $statuscode)))//Double check to make sure user input valid data
{
    echo "<script>alert('Status Code only starts with uppercase S and fellowed by 5 numbers, no illegal symbols please.'); history.back();</script>";
} elseif (mysqli_num_rows($exist) >= 1) {
    echo "<script>alert('Status Code will have to be unique, this one is already existed, please try again, Thank You.'); history.back();</script>";
}

////elseif(mysqli_fetch_array(mysqli_query($con,"SELECT * FROM hzy WHERE statuscode = '$statuscode'")))
////{
////echo"<script>alert('StatusCode MUST BE UNIQUE, please try agian.'); history.back();</script>";
////}


//Check if this status code is already existed
//$inquiry_statuscode = mysqli_query("SELECT * FROM $dbtb WHERE statuscode='$statuscode'");
//if(mysqli_num_rows($inquiry_statuscode)>=1)
//{
//echo"sadsdasfdfgafeaf";
//}


else {
    $sqlStr = "INSERT INTO $dbtb (statuscode, status, share, date, type) VALUES ('$statuscode', '$status', '$share', '$date', '$type1')";
    //Insert input checked data to target database
}


//Checks whether inputs were inserted to database successfully
if (mysqli_query($con, $sqlStr)) {
    echo "<script>alert('Thank You, Your informationStatus Code:$statuscode\\nStatus: $status\\nShare Permission-:$share\\nDate: $date\\nPermission Type: $type1,\\nhas been uploaded, Best Wishes!!!')</script>";

} else {
    echo "Failed to upload";
}

mysqli_close($con);//close connection of database
?>

<div class="uni">
    <h1>
        <center>Your Information have been uploaded successfully</center>
    </h1>
    <h2>
        <center>Thank You for your cooperation</center>
    </h2>
</div>

<div class="uni" style="text-align: center;">
    <a class="button" style="" href="index.html">Return To Home Page</a>
    <a class="button" style="margin-left: 30px;" href="poststatusform.php">Post a new status</a>
</div>


</body>
</html>
