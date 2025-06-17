<?php
session_start();
include("dbconfig.php");

header('Content-Type: text/plain'); // Prevent HTML in response

$email = $_SESSION['user'] ?? null;
if (!$email) {
    header("location:index.php");
    exit;
}

$sql = "SELECT * FROM user WHERE email='" . mysqli_real_escape_string($conn, $email) . "'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    echo "Error: User not found";
    exit;
}

$user_id = $row['user_id'];

// Only handle POST with 'eventsubmit' set
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eventsubmit'])) {
    $eventtitle = mysqli_real_escape_string($conn, $_POST['eventTitle']);
    $eventdescription = mysqli_real_escape_string($conn, trim($_POST['eventDescription']));
    // Character limit check for titleMore actions
    if (strlen($eventtitle) > 50) {
        echo "<script>alert('Error: Title cannot exceed 50 characters.'); window.history.back();</script>";
        exit;
    }
    // Word limit check for description
    $wordCount = str_word_count(strip_tags($eventdescription));
    if ($wordCount > 75) {
        echo "Error: Description exceeds 75 words.";
        exit;
    }

    // Check for uploaded image
    if (!isset($_FILES['eventImage']) || $_FILES['eventImage']['error'] !== UPLOAD_ERR_OK) {
        echo "Error: Image is required.";
        exit;
    }

    // Read and escape image data
    $imageTmpPath = $_FILES['eventImage']['tmp_name'];
    $imageData = addslashes(file_get_contents($imageTmpPath));

    // Insert into database
    $addevent = "INSERT INTO event (user_id, title, description, image)
                 VALUES ('$user_id', '$eventtitle', '$eventdescription', '$imageData')";

    if (mysqli_query($conn, $addevent)) {
          $event_id = mysqli_insert_id($conn);
    echo "success|$event_id";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // If it's not a proper POST, reject silently (no HTML)
    echo "Invalid request.";
}
?>
