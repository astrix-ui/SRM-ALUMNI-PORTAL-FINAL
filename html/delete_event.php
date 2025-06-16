<?php
// delete_event.php
session_start();
include 'dbconfig.php'; // Ensure this has your DB connection $conn
 $email = $_SESSION['user'] ?? null;
if (!$email) {
    header("location:index.php");
        exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $eventId = intval($_POST['id']); // Sanitize input

        // Prepare and execute the delete query
        $stmt = $conn->prepare("DELETE FROM event WHERE event_id = ?");
        $stmt->bind_param("i", $eventId);

        if ($stmt->execute()) {
            echo 'success';
        } else {
            echo 'error';
        }

        $stmt->close();
    } else {
        echo 'no_id';
    }
} else {
    header("location:index.php");
}
?>
