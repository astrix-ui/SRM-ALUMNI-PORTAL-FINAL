<?php

session_start();
if(!isset($_SESSION['user'])){
  header("location:login.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat | SRM Alumni</title>
    <link rel="stylesheet" href="../css/message_page.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
 <?php
include("nav.php");
?>


    <!-- Chat Container -->
    <div class="chat-container">
        <!-- Sidebar -->
        <div class="chat-sidebar">
            <h2>Inbox</h2>
            <div class="user-container-wrapper" id="message-panel">
                 <?php include("message_panel.php"); ?>
                <!-- <div class="user-container">
           
              
                <h4 class="user-id">ADITYA</h4>
                <p>YO</p>
              
            </div>
                   <div class=" user-container-active">
                <h4 class="user-id">ADYA</h4>
                <p>YO</p>
              
            </div> -->
</div>
        </div>

        <!-- Chat Content -->
         <div class="right-panel">
   <?php
            
                    
                    
                    include("dbconfig.php");
                    
                    if(isset($_POST['loggedin_user_id']) && isset($_POST['receiver_user_id']) && isset($_POST['receiver_user_name'])) {
                    $current_user=$_POST['loggedin_user_id'];
                    $otherperson_id=$_POST['receiver_user_id'];
                    $otherperson=$_POST['receiver_user_name'];
                            if(isset($_POST['message_id'])){
                        $message_id=$_POST['message_id'];
                        $update_seen="UPDATE messages SET seen=1 WHERE sender_id='$otherperson_id' AND receiver_id='$current_user'";
                        mysqli_query($conn,$update_seen);
                    }
                  
                        echo '<div class="user-detail">
                                <h3>', $otherperson, '</h3>
                                <a href="showprofile.php?user='.$otherperson.'"></a>
                              </div>';

                        echo '<ul class="chatbox">';
                        echo '</ul>';
                        
                        echo '<div class="chat-input">
                                <form id="chat-form" method="POST" >
                                    <input type="hidden" value="', $current_user, '" name="user_id">
                                    <input type="hidden" value="', $otherperson_id, '" name="receiver_id">
                                    <input type="text" id="text-input" placeholder="Type something" name="message" required>
                                    
                                    <button id="chat-send" class="send-button">Send</button>
                                </form>
                              </div>';
                        
            //                   echo'<div class="chat-input">
            //     <input type="text" placeholder="Type something">
            //     <button class="send-button">Send</button>
            // </div>';
                    }
                
             else {
                echo '<div class="start-text" style="display: flex; justify-content: center; align-items: center; height: 100%;">
  <h2>Click on a message to start chatting</h2>
</div>
';
            }
            ?>
    </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
                       // JavaScript for mobile navigation bar


$(document).ready(function() {
  // Function to fetch messages from the server
  function fetchMessages() {
    var otherperson = "<?php echo isset($_POST['receiver_user_id']) ? $_POST['receiver_user_id'] : ''; ?>";
    var loggedin_user = "<?php echo isset($_POST['loggedin_user_id']) ? $_POST['loggedin_user_id'] : ''; ?>";
    if(otherperson){
    $.ajax({
      url: 'fetch_messages.php',
      method: 'POST',
      data: {
        otherperson: otherperson,
        loggedin_user: loggedin_user 
      },
        success: function(data) {
          $('.chatbox').html(data);
          $(".chatbox").scrollTop($(".chatbox")[0].scrollHeight);
        },
        error: function(xhr, status, error) {
          console.error("Error fetching messages:", error);
        }
      });
    }
  }

  // Function to fetch chat panel from the server
  function fetchChatPanel() {
    $.ajax({
      url: 'message_panel.php',
      method: 'GET',
      success: function(data) {
        $('#message-panel').html(data);
      },
      error: function(xhr, status, error) {
        console.error("Error fetching chat panel:", error);
      }
    });
  }

  // Execute fetchMessages and fetchChatPanel on page load
  fetchMessages();
  fetchChatPanel();

  // Polling to fetch new messages and chat panel every 5 seconds
  setInterval(function() {
    fetchMessages();
    fetchChatPanel();
  }, 5000);

  // Submit the form when Enter key is pressed in the text input field
  $('#text-input').keypress(function(event) {
    if (event.which === 13 && !event.shiftKey) {
      event.preventDefault(); // Prevent Enter key from adding newline
      $('#chat-form').submit(); // Submit the form
    }
  });

  // Handle form submission via AJAX
  $('#chat-form').on('submit', function(e) {
    e.preventDefault(); // Prevent the form from submitting traditionally
    $.ajax({
      url: 'message_backend.php',
      method: 'POST',
      data: $(this).serialize(), // Serialize form data
      success: function(response) {
        // Log success message or handle response if needed
        console.log("Message sent successfully:", response);
        fetchMessages(); // Fetch new messages after sending
        fetchChatPanel(); // Fetch updated chat panel after sending
        $('#text-input').val(''); // Clear the input field
      },
      error: function(xhr, status, error) {
        // Log error message or handle error if needed
        console.error("Error sending message:", error);
      }
    });
  });
});

                  </script>
    
    </section>
    </body>
    </html>
    

      

