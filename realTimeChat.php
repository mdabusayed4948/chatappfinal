<?php session_start();
include "db.php"; 

$fromUser = mysqli_real_escape_string($db, $_POST["fromUser"]);
$toUser   = mysqli_real_escape_string($db, $_POST["toUser"]);

$output = "";

$query = "SELECT * FROM messages where (FromUser = '".$fromUser."' AND ToUser = '".$toUser."') OR (FromUser = '".$toUser."' AND ToUser = '".$fromUser."')";

$chats = mysqli_query($db, $query) or die('Failed to query database' . mysqli_connect_error($db));

               
while($chat = mysqli_fetch_assoc($chats))
{
    if($chat["FromUser"] == $fromUser)
    {
        $output .= "<div style='text-align:right;' ><p style='background-color:lightblue; word-wrap:break-word; display:inline-block; padding:5px; border-radious:10px; max-wide:70% ' >".$chat["message"]."</p></div>";

    }else{
        $output .= "<div style='text-align:left;' ><p style='background-color:lightgreen; word-wrap:break-word; display:inline-block; padding:5px; border-radious:10px; max-wide:70% ' >".$chat["message"]."</p></div>";

    }

}
echo $output;
 
?>