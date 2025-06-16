<?php
if (session_status() == PHP_SESSION_NONE) {
                        session_start();
                    }
include("dbconfig.php");

if(isset($_POST['loggedin_user']) && isset($_POST['otherperson'])) 
 {
    $sender_id = $_POST['loggedin_user'];
    $receiver_id = $_POST['otherperson'];

    $sql_msg = "SELECT * FROM messages WHERE (sender_id='$sender_id' AND receiver_id='$receiver_id') OR (sender_id='$receiver_id' AND receiver_id='$sender_id')";
    $result_msg = mysqli_query($conn, $sql_msg);

    while ($rows = mysqli_fetch_assoc($result_msg)) {
        if ($rows['sender_id'] == $sender_id) {
             echo '<li class="chat outgoing">
                    <p>', htmlspecialchars($rows['message']), '</p>
                  </li>';
        } elseif ($rows['sender_id'] == $receiver_id) {
            echo '<li class="chat incoming">
                    <p>', htmlspecialchars($rows['message']), '</p>
                  </li>';
        }
    }
}
else{
    header("location:index.php");
}
?>
