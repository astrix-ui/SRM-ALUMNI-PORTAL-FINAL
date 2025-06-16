<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
  function checkNewMessages() {
  $.ajax({
    url: "check_new_messages.php", // Replace with your script to check new messages
    dataType: "json",
    success: function(data) {
      if (data.hasNewMessages) {
        $("#msg-link img").show(); // Show red dot if new messages
      } else {
        $("#msg-link img").hide(); // Hide red dot if no new messages
      }
    },
    error: function(jqXHR, textStatus) {
      console.error("Error fetching new messages:", textStatus);
      // Handle potential errors during AJAX request
    }
  });
}

// Call checkNewMessages on page load
checkNewMessages();

// Call checkNewMessages every 5 seconds using setInterval
setInterval(checkNewMessages, 1000); // Adjust the interval as needed (milliseconds)

});

// navbar.js


</script>


<nav class="navbar">
      <div class="logo" style="
    margin-top: 5px;
">
        <img src="../assets/srmlogo.png" alt="Logo" />
      </div>
     <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="about.php">About Us</a></li>
        <li><a href="searchpage.php">Directory</a></li>
        <li><a href="eventpage.php">Events</a></li>
       <li id="msg-link">
  <a href="chat.php">
    <img src="/alumni/assets/dot.png" id="dot-img" style="display: none;">
    Interact
  </a>
</li>
        <li><a href="profile.php">Profile</a></li>
      </ul>
      <div class="register-btn">
        <?php
                  if(isset($_SESSION['user'])){
                    echo'<a href="logout.php" id="register-btn-text">Logout</a>';}
                    else{
                      echo'<a href="signup.php" id="register-btn-text">Register</a>';}
                  ?>
        <!-- <a href="login.php" id="register-btn-text">Register</a> -->
      </div>

      <!-- <div class="register-btn">
        <a href="profile.html" id="register-btn-text">Profile</a> -->
        
      </div>
      <div class="hamburger" id="hamburger">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </nav>

    <!-- Mobile menu -->
    <div class="mobile-menu" id="mobile-menu">
      <ul class="mobile-nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="about.php">About Us</a></li>
        <li><a href="searchpage.php">Directory</a></li>
        <li><a href="eventpage.php">Events</a></li>
            <li id="msg-link">
  <a href="chat.php">
    Interact
    <img src="/alumni/assets/dot.png" id="dot-img" style="display: none;">
  </a>
        <li><a href="profile.php">Profile</a></li>
      </ul>
      <div class="mobile-register-btn">
         <?php
                  if(isset($_SESSION['user'])){
                    echo'<a href="logout.php" id="register-btn-text">Logout</a>';}
                    else{
                      echo'<a href="login.php" id="register-btn-text">Register</a>';}
                  ?>
      </div>
      <!-- <div class="mobile-register-btn">
        <a href="./profile.html" id="mobile-register-btn-text">Profile</a>
      </div> -->
    </div>
<script>
const hamburger = document.getElementById("hamburger");
const mobileMenu = document.getElementById("mobile-menu");

hamburger.addEventListener("click", (event) => {
    const isMenuOpen = mobileMenu.style.right === "0px";
    mobileMenu.style.right = isMenuOpen ? "-100%" : "0px";
});

// Close menu when clicking outside
document.addEventListener("click", (event) => {
    const isClickInsideMenu = mobileMenu.contains(event.target);
    const isClickOnHamburger = hamburger.contains(event.target);

    if (!isClickInsideMenu && !isClickOnHamburger) {
        mobileMenu.style.right = "-100%";
    }
});
  </script>