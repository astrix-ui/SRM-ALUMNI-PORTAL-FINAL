<?php
// delete_event.php

include 'dbconfig.php'; // Ensure this has your DB connection $conn

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
    echo 'invalid_request';
}
?>
