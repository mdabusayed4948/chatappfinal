<?php session_start(); 
include("db.php"); 

$fromUser = mysqli_real_escape_string($db, $_POST["fromUser"]);
$toUser   = mysqli_real_escape_string($db, $_POST["toUser"]);
$message  = mysqli_real_escape_string($db, $_POST["message"]);

$query = "INSERT INTO messages (FromUser, ToUser, message) VALUES('$fromUser','$toUser','$message')";

$result = mysqli_query($db, $query);

$output = "";

if($result)
{
    $output .="";
}
else
{
    $output .="Error. Please Try Again";
}
echo $output;

?>