<?php session_start();
include 'db.php';

if (isset($_POST['option']))
{
    $fromUser = mysqli_real_escape_string($db, $_POST["fromUser"]);
    $toUser   = mysqli_real_escape_string($db, $_POST["toUser"]);


    if ($_POST['option'] != '')
    {
        // $status_query = "SELECT * FROM messages where (FromUser = '".$toUser."' AND ToUser = '".$fromUser."' AND message_status=0)";
   
        $update = "update messages SET message_status = 1 where (FromUser = '".$toUser."' AND ToUser = '".$fromUser."' AND message_status=0)";
        mysqli_query($db, $update);
    }

    // $query = "SELECT * FROM messages ORDER BY id DESC LIMIT 3";
    // $result = mysqli_query($db, $query);

    $query = "SELECT * FROM messages where (FromUser = '".$toUser."' AND ToUser = '".$fromUser."') ORDER BY id DESC LIMIT 3";

    $result = mysqli_query($db, $query) or die('Failed to query database' . mysqli_connect_error($db));


    $output = '';

    if(mysqli_num_rows($result) > 0 )
    {
        while ($row = mysqli_fetch_array($result))
        {
            
            $output .= "
            <a class='dropdown-item' href='#'>".$row['message']."</a>
            
            ";
        }
    }else{
        $output .= "<li class='text-center'>You have n Notifications</li>";
    }

    $status_query = "SELECT * FROM messages where (FromUser = '".$toUser."' AND ToUser = '".$fromUser."' AND message_status=0)";
    //$status_query = "SELECT * FROM messages WHERE message_status=0";
    $result_query = mysqli_query($db, $status_query);
    $count = mysqli_num_rows($result_query);
    $data = array(
        'notification' => $output,
        'unreadNotification' => $count
    );

    echo json_encode($data);

}

