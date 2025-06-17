<?php
session_start();
include("dbconfig.php");
if (!isset($_SESSION['user'])) {
    // Redirect to the login page or handle the error appropriately
    header("location:login.php");
    exit;
}

// echo $user_id;die;
if(isset($_POST["delete_btn"])){
$user_id=$_POST["user_id"];

$delete_user="DELETE FROM user WHERE user_id=$user_id";
mysqli_query($conn,$delete_user);
$delete_user_event="DELETE FROM event WHERE user_id=$user_id";
mysqli_query($conn,$delete_user_event);
$delete_user_exp="DELETE FROM experience WHERE user_id=$user_id";
mysqli_query($conn,$delete_user_exp);
$delete_user_qual="DELETE FROM qualification WHERE user_id=$user_id";
mysqli_query($conn,$delete_user_qual);
$delete_user_messages="DELETE FROM messages WHERE sender_id=$user_id OR receiver_id=$user_id";
mysqli_query($conn,$delete_user_messages);  
$delete_user_follow="DELETE FROM follow WHERE user_id=$user_id OR otheruser_id=$user_id";  
mysqli_query($conn,$delete_user_follow);

unset($_SESSION['user']);
session_destroy();

header("location:signup.php");

}
else{
    header("location:profile.php");
}

?>