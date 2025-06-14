<?php
session_start();
include("dbconfig.php");

$email = $_SESSION['user'] ?? null;
if (!$email) {
    echo "User not logged in";
    exit;
}

$sql = "SELECT * FROM user WHERE email='$email'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$user_id = $row['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eventsubmit'])) {
    $eventtitle = mysqli_real_escape_string($conn, $_POST['eventTitle']);
    $eventdescription = mysqli_real_escape_string($conn, trim($_POST['eventDescription']));


    // Word limit check
    $wordCount = str_word_count($eventdescription);
    if ($wordCount > 75) {
        echo "<script>alert('Error: Description exceeds 75 words.'); window.history.back();</script>";
        exit;
    }

    // Image required check
    if (!isset($_FILES['eventImage']) || $_FILES['eventImage']['error'] !== UPLOAD_ERR_OK) {
        echo "<script>alert('Error: Image is required.'); window.history.back();</script>";
        exit;
    }

    // Read image as binary and escape it
    $imageTmpPath = $_FILES['eventImage']['tmp_name'];
    $imageData = addslashes(file_get_contents($imageTmpPath));

    // Insert into database
    $addevent = "INSERT INTO event (user_id, title, description, image)
                 VALUES ('$user_id', '$eventtitle', '$eventdescription', '$imageData')";

    if (mysqli_query($conn, $addevent)) {
        echo "<script>alert('Event added successfully!'); window.location.href='profile.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
