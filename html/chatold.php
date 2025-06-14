<?php 
session_start();
// if(!isset($_SESSION['user'])){
//     header("location:landing.php");
//     exit();
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat | SRM Alumni</title>
    <link rel="stylesheet" href="../css/chat.css">
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
            <ul>
                <?php include("message_panel.php"); ?>
                <!-- <li class="active">Aadya Jha</li> -->
            </ul>
        </div>

        <!-- Chat Content -->
        <div class="chat-content">
     <?php
            if(isset($_GET['user'])){
                if(isset($_SESSION['show'])){
                    if (session_status() == PHP_SESSION_NONE) {
                        session_start();
                    }
                    include("dbconfig.php");
                    $user = $_SESSION['user'];
                    $otherperson = $_GET['otherperson'];
                    
                    $check="SELECT* FROM user WHERE username='$otherperson'";
                    $check_result=mysqli_query($conn,$check);

                    if(mysqli_num_rows($check_result)!=0){
                        echo '<div class="user-detail">
                                <h3>', $otherperson, '</h3>
                                <a href="otherprofile.php?user='.$otherperson.'"><img src="/social/assets/info.png"></a>
                              </div>';

                        echo '<ul class="chatbox">';
                        echo '</ul>';
                        
                        echo '<div class="chat-input">
                                <form id="chat-form" class="chat-input" method="POST" >
                                    <input type="hidden" value="', $otherperson, '" name="otherperson">
                                    <textarea id="text-input" placeholder="Message..." name="message" required></textarea>
                                    <button id="chat-send" class="login-btn">Send</button>
                                </form>
                              </div>';
                    }
                }
            } else {
                echo '<div class="start-text"><h2>Click on a message to start chatting</h2></div>';
            }
            ?>
        <!-- Chat Content -->
        <div class="chat-content">
            <div class="chat-header">
                <h3>Aadya Jha</h3>
            </div>
            <div class="chat-messages">
                <div class="incoming-msg">
                    <p>Hello! How are you?</p>
                </div>
                <div class="outgoing-msg">
                    <p>Hey! I'm doing great, thanks for asking.</p>
                </div>
                
            </div>
            <div class="chat-input">
                <input type="text" placeholder="Type something">
                <button class="send-button">Send</button>
            </div>
        </div>
  </div>




<script>
 document.querySelector('.chatbox').style.scrollBehavior = 'auto';
document.querySelector('.chatbox').scrollTop = document.querySelector('.chatbox').scrollHeight;
// document.querySelector('.chatbox').style.scrollBehavior = 'smooth';

$(document).ready(function() {
  // Function to fetch messages from the server
  function fetchMessages() {
    var otherperson = "<?php echo isset($_GET['otherperson']) ? $_GET['otherperson'] : ''; ?>";
    if (otherperson) {
      $.ajax({
        url: 'fetch_messages.php',
        method: 'POST',
        data: {otherperson: otherperson},
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
</body>

</html>
