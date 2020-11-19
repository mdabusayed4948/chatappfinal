<?php session_start();
include 'db.php';

if(isset($_POST['uName'])){
    
    

    $uName   = mysqli_real_escape_string($db, $_POST['uName']);

    $query = "INSERT INTO users(User) VALUES('$uName')";

    $result = mysqli_query($db, $query);

    if(!$result){
        die("THIS WENT BAD" . mysqli_error($db));
    }
}