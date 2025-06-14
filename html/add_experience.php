<?php
session_start();
include("dbconfig.php"); 
error_reporting(E_ALL);
ini_set('display_errors', 1);

$email = $_SESSION['user'] ?? null;
if (!$email) {
    echo "User not logged in";
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
    $experience = trim($_POST['experience']);

    if (!empty($experience)) {
        $experience= mysqli_real_escape_string($conn, $experience);
        $add_experience= "INSERT INTO experience (user_id, experience) VALUES ('$user_id', '$experience')";
        
        if (mysqli_query($conn, $add_experience)) {
            echo "success";
        } else {
            echo "DB error: " . mysqli_error($conn);
        }
    } else {
        echo "Empty experience";
    }
}
?>
