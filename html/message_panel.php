<?php
include("dbconfig.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user'])) {
    
    header("location:login.php");
    exit;
}
// Get current user ID
$email = $_SESSION['user'];
$fetch_id = "SELECT user_id FROM user WHERE email='$email'";
$fetch_row = mysqli_fetch_assoc(mysqli_query($conn, $fetch_id));
$current_user_id = $fetch_row['user_id'];
// echo $current_user_id;die;
$current_chat_id = $_POST['receiver_user_id'] ?? '';

// Get current chat user from GET (optional)
// $current_chat_name = $_GET['user'] ?? '';

// Fetch all users this user has chatted with
$sql = "SELECT IF(sender_id='$current_user_id', receiver_id, sender_id) AS other_person
        FROM messages 
        WHERE sender_id='$current_user_id' OR receiver_id='$current_user_id'
        GROUP BY other_person
        ORDER BY MAX(message_id) DESC";

$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $receiver_id = $row['other_person'];

    $sql_name="SELECT name From user where user_id='$receiver_id'";
    $row_name=mysqli_fetch_assoc(mysqli_query($conn,$sql_name));
    $user_name = htmlspecialchars($row_name['name']);
    // Retrieve the last message exchanged between the current user and the other person
  $lastMessageSql = "SELECT * 
                     FROM messages 
                     WHERE (sender_id='$current_user_id' AND receiver_id='$receiver_id') 
                           OR (sender_id='$receiver_id' AND receiver_id='$current_user_id') 
                     ORDER BY message_id DESC 
                     LIMIT 1";

  $lastMessageResult = mysqli_query($conn, $lastMessageSql); // Execute the query
  $lastMessage = mysqli_fetch_assoc($lastMessageResult); // Get the last message details
$trimmedMessage = substr($lastMessage['message'], 0, 20);
  // Check if there's a last message and the user who received it
  if ($lastMessage['seen'] == 0 && $lastMessage['receiver_id'] == $current_user_id) {
    // Display unread message with a dot
    echo '<form action="message_page.php?user=' . urlencode($user_name) . '" method="POST" style="all: unset;">
        <input type="hidden" name="receiver_user_id" value="' . $receiver_id . '">
        <input type="hidden" name="receiver_user_name" value="' . htmlspecialchars($user_name) . '">
        <input type="hidden" name="loggedin_user_id" value="' . $current_user_id . '">
        <input type="hidden" name="message_id" value="' . $lastMessage['message_id'] . '">
        <button type="submit" style="all: unset; display: block; width: 100%; text-align: left; cursor: pointer;">
          <div class="user-container" ><img src="../assets/dot.png" alt="">
            <h4 class="user-id">' . htmlspecialchars($user_name) . '</h4>
            <p>' . $trimmedMessage . (strlen($lastMessage['message']) > 20 ? "..." : "") . '</p>
          </div>
        </button>
      </form>';
} else {
    // Display regular message
    echo '<form action="message_page.php?user=' . urlencode($user_name) . '" method="POST" style="all: unset;">
        <input type="hidden" name="receiver_user_id" value="' . $receiver_id . '">
        <input type="hidden" name="receiver_user_name" value="' . htmlspecialchars($user_name) . '">
        <input type="hidden" name="loggedin_user_id" value="' . $current_user_id . '">
        <input type="hidden" name="last_message_id" value="' . $lastMessage['message_id'] . '">
        <button type="submit" name="open_chat" style="all: unset; display: block; width: 100%; text-align: left; cursor: pointer;">
          <div class="' . ($receiver_id == $current_chat_id ? 'user-container-active' : 'user-container') . '">
            <h4 class="user-id">' . htmlspecialchars($user_name) . '</h4>
            <p>' . $trimmedMessage . (strlen($lastMessage['message']) > 20 ? "..." : "") . '</p>
          </div>
        </button>
      </form>';
}
}
?>

