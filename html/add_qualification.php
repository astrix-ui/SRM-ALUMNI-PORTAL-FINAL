<?php
session_start();
include("dbconfig.php"); 
error_reporting(E_ALL);
ini_set('display_errors', 1);

$email = $_SESSION['user'] ?? null;
if (!$email) {
    header("location:index.php");
    exit;
}

$sql = "SELECT * FROM user WHERE email='$email'";
$result = mysqli_query($conn, $sql);
if (!$result || mysqli_num_rows($result) === 0) {
    echo "User not found";
    exit;
}

$row = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $row['user_id'];
    $qualification = trim($_POST['qualification']);

    if (!empty($qualification)) {
        $qualification = mysqli_real_escape_string($conn, $qualification);
        $add_qualification = "INSERT INTO qualification (user_id, qualification) VALUES ('$user_id', '$qualification')";
        
        if (mysqli_query($conn, $add_qualification)) {
            echo "success";
        } else {
            echo "DB error: " . mysqli_error($conn);
        }
    } else {
        echo "Empty qualification";
    }
}
else{
    header("location:profile.php");
}
?>
