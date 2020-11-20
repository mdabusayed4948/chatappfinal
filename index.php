<?php session_start();
include "inc/header.php";

if(isset($_GET["userId"])){

    $_SESSION["userId"] = $_GET["userId"];

    echo '<script>
					
			window.location = "chatbox.php";

						
		</script>';
    // header('Location: chatbox.php');
}

?>

<br><br>
<div class="row">

<div class="col-md-6">

<div class="card">
    <div class="card-header">User List</div>
    <div class="card-body" >
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
            
        </thead>
        <tbody  id="userData">

        </tbody>
    </table>
    </div>
</div>
</div>


<div class="col-md-6">
    <div class="card">
        <div class="card-header">Regestration here...</div>
        <div class="card-body">
            <form method="post" id="message_form">
                <div class="form-group">
                    <label for="exampleInputEmail1">Enter Name</label>
                    <input type="text" class="form-control" name="uName" id="uName" placeholder="Enter User Name">
                </div>
                <button type="submit" name="submit" id="post" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>

</div>

</div>


<?php 
include "inc/footer.php";
?>