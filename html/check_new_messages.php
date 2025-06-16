<?php
// Check if a session is already active, otherwise start a new one
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

$email = $_SESSION['user'] ?? null;
if (!$email) {
    header("location:index.php");
    exit;
}
include("dbconfig.php");


$currentUser = $_SESSION['user'];
$sql_id="SELECT user_id FROM user WHERE email='$currentUser'";
$row_id =(mysqli_fetch_assoc(mysqli_query($conn,$sql_id)));
$user_id=$row_id['user_id'];

$sql="SELECT * FROM messages WHERE receiver_id='$user_id' AND seen=0";
              $result=mysqli_query($conn,$sql);


$row = mysqli_num_rows($result);

$hasNewMessages = $row > 0 ? true : false;

echo json_encode(array("hasNewMessages" => $hasNewMessages));
?>
