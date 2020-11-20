<?php session_start();
include "inc/header.php";
include 'db.php';

$query = "SELECT * FROM users where id = '".$_SESSION["userId"]."' ";

$users = mysqli_query($db, $query)or die('Failed to query database' . mysqli_connect_error($db));

$user = mysqli_fetch_assoc($users);
?>

<br><br>
<div class="row">

<div class="col-md-6">

<div class="card">
    <div class="card-header">
        <div class="float-left">
            <h4>Welcome - <span class="badge badge-secondary"><?php echo $user["User"];?></span></h4>
            <input type="text" id="fromUser" value="<?php echo $user["id"];?>" hidden/>
        </div>
    <div class="float-right">
    <a href="index.php" class="btn btn-info">Back</a>
    </div>
      
    </div>
    <div class="card-body" >
        <div class="card-header"><h5>Send Message To-</h5></div>
    <table class="table table-bordered text-center">
        <thead>
            <tr>                
                <th>#</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            $query = "SELECT * FROM users where id != '".$user["id"]."' ";

            $users = mysqli_query($db, $query)or die('Failed to query database' . mysqli_connect_error($db));
            
            $i = 0;
            while($user = mysqli_fetch_assoc($users)){

                if($user){
                    echo '<tr><td>'.++$i.'</td><td>'.$user["User"].'</td><td><a class="btn btn-info" href="?toUser='.$user["id"].'" >send Message</a></td></tr>';
                    
                }

            }
        ?>

        </tbody>
    </table>
    </div>
</div>
</div>


<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <h4>
            <?php 
                if(isset($_GET["toUser"]))
                {
                    $query = "SELECT * FROM users WHERE id ='".$_GET["toUser"]."' ";

                    $userName = mysqli_query($db, $query)or die('Failed to query database' . mysqli_connect_error($db));
                    
                    $uName = mysqli_fetch_assoc($userName);
                    echo '<input type="text" value='.$_GET["toUser"].' id="toUser"  hidden/>';
                    echo $uName["User"];
                }else{
                    //echo "Chat Box";
                    $query = "SELECT * FROM users ORDER BY id DESC";

                    $userName = mysqli_query($db, $query)or die('Failed to query database' . mysqli_connect_error($db));
                    
                    $uName = mysqli_fetch_assoc($userName);
                    $_SESSION["toUser"] = $uName["id"];
                    echo '<input type="text" value='.$_SESSION["toUser"].' id="toUser" hidden />';
                    echo $uName["User"];
                }
            ?>
            </h4>
        </div>
        <div class="card-body" id="msgBody" style="height: 400px; overflow-y:scroll; overflow-x: hidden; background-color:#ecdca729">
        <?php 
            if(isset($_GET["toUser"])){
               
                $query = "SELECT * FROM messages where (FromUser = '".$_SESSION["userId"]."' AND ToUser = '".$_GET["toUser"]."') OR (fromUser = '".$_GET["toUser"]."' AND ToUser = '".$_SESSION["userId"]."') ";
                $chats = mysqli_query($db, $query) or die('Failed to query database' . mysqli_connect_error($db));

                
            }else{

                $query = "SELECT * FROM messages where (FromUser = '".$_SESSION["userId"]."' AND ToUser = '".$_SESSION["toUser"]."') OR (fromUser = '".$_SESSION["toUser"]."' AND ToUser = '".$_SESSION["userId"]."') ";
                $chats = mysqli_query($db, $query) or die('Failed to query database' . mysqli_connect_error($db));

                while($chat = mysqli_fetch_assoc($chats))
                {
                    if($chat["FromUser"] == $_SESSION["userId"])
                    {
                        echo "<div style='text-align:right;' ><p style='background-color:lightblue; word-wrap:break-word; display:inline-block; padding:5px; border-radious:10px; max-wide:70% ' >".$chat["message"]."</p></div>";

                    }else{
                        echo "<div style='text-align:left;' ><p style='background-color:yellow; word-wrap:break-word; display:inline-block; padding:5px; border-radious:10px; max-wide:70% ' >".$chat["message"]."</p></div>";

                    }

                }
            }
        ?>
        </div>
        <div class="card-footer">
            <?php 
            if(!isset($_GET["toUser"])){ ?>
                <div class="form-inline" style="display: none;">
            
                    <div class="form-group mx-sm-3 mb-2">
                    <textarea id="message" class="form-control" style="width: 404px;"></textarea> 
                    </div>
                    <button id="send" class="btn btn-primary mb-2">Send</button>
                </div>
            <?php }else{?>
                <div class="form-inline">
            
                    <div class="form-group mx-sm-3 mb-2">
                    <textarea id="message" class="form-control" style="width: 404px;"></textarea> 
                    </div>
                    <button id="send" class="btn btn-primary mb-2">Send</button>
                </div>

            <?php } ?>
            
           
        </div>
    </div>

</div>

</div>





<?php 
include "inc/footer.php";
?>