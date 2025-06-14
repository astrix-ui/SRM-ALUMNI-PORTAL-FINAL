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


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
    $id = (int)$_POST['id'];

    $delete_sql = "DELETE FROM experience WHERE experience_id = $id";
    if (mysqli_query($conn, $delete_sql)) {
        echo "success";
    } else {
        echo "DB error: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request";
}
