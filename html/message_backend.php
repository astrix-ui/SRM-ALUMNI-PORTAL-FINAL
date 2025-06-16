<?php
session_start();
include("dbconfig.php");
if (!isset($_SESSION['user'])) {
    // Redirect to the login page or handle the error appropriately
    header("location:login.php");
    exit;
}
if(isset($_SESSION['user']) && isset($_POST['user_id']) && isset($_POST['receiver_id']) && isset($_POST['message'])){
$sender_id = $_POST['user_id'];
$receiver_id = $_POST['receiver_id'];
$message = mysqli_real_escape_string($conn, $_POST['message']);

$sql = "INSERT INTO messages (sender_id, receiver_id, message, seen) VALUES ('$sender_id', '$receiver_id', '$message', 0)";
mysqli_query($conn, $sql);
 $sql4="UPDATE messages SET seen = 1 WHERE sender_id='$receiver_id' AND receiver_id='$sender_id'";
mysqli_query($conn,$sql4);
}
else{
    header("location:profile.php");
}
?>