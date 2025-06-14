<?php
session_start();
include("dbconfig.php");

$sender_id = $_POST['user_id'];
$receiver_id = $_POST['receiver_id'];
$message = mysqli_real_escape_string($conn, $_POST['message']);

$sql = "INSERT INTO messages (sender_id, receiver_id, message, seen) VALUES ('$sender_id', '$receiver_id', '$message', 0)";
mysqli_query($conn, $sql);
 $sql4="UPDATE messages SET seen = 1 WHERE sender_id='$receiver_id' AND receiver_id='$sender_id'";
mysqli_query($conn,$sql4);
?>