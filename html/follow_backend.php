<?php

// $user_id =$_POST['user_id'];
// echo $user_id;
// die;
session_start();
include("dbconfig.php");
// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    // Redirect to the login page or handle the error appropriately
    header("location: login.php");
    exit;
}


if (!isset($_POST['user_id'])) {
    
    header("location:searchpage.php");
    exit;
}


$email = $_SESSION['user'];
$sql="SELECT user_id FROM user WHERE email='$email'";
$result=mysqli_query($conn,$sql);
$row=(mysqli_fetch_assoc($result));
$user_id=$row['user_id'];
$otheruser_id = $_POST['user_id'];




$sql11 = "INSERT INTO follow  VALUES ('$user_id', '1', '$otheruser_id')";
$result11 = mysqli_query($conn, $sql11);

if ($result11) {
    
    $name = ''; 
    $getName = mysqli_query($conn, "SELECT name FROM user WHERE user_id = '$otheruser_id'");
    if ($row = mysqli_fetch_assoc($getName)) {
        $name = urlencode($row['name']);
    }

    echo '
    <form id="redirectForm" action="showprofile.php?name=' . $name . '" method="POST">
        <input type="hidden" name="user_id" value="' . $otheruser_id . '">
    </form>
    <script>
        document.getElementById("redirectForm").submit();
    </script>';
    exit;
}
 else {
    // handle database insertion failure
    echo "Error: Failed to follow user.";
    // Optionally, redirect to an error page or handle the error differently
}
?>
