<?php 
session_start();
include("dbconfig.php");
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
    <title>Alumni Profile | SRM</title>
    <link rel="stylesheet" href="../css/profile7.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
</head>
<body>
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

</script>
    <!-- Navbar -->
    <nav class="navbar">
      <div class="logo" style="margin-top:5px;">
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
      <div class="nav-btn-container" style="display: flex; gap: 8px;">
        <div class="register-btn">
          <a href="editprofile.php" id="register-btn-text">Edit Profile</a>
          
        </div>
      <div class="register-btn">
        <?php
                  if(isset($_SESSION['user'])){
                    echo'<a href="logout.php" id="register-btn-text">Logout</a>';}
                    else{
                      echo'<a href="login.php" id="register-btn-text">Register</a>';}
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
      <div class="btn-container-mobile">

        <div class="mobile-register-btn" style=" margin-bottom: 5px;">
            <a href="./editprofile.php" id="mobile-register-btn-text">Edit Profile</a>
          </div>
      
      <div class="mobile-register-btn" >
        <a href="logout.php" id="register-btn-text">Logout</a>
        </div>
                    
      
      </div>
    </div>

    <!-- Profile  HEADER Section -->
    <section class="profile-section">
        <div class="profile-section-wrapper">
        <div class="profile-container">
            <div class="profile-card-2">
                <div class="profile-image">
                    <img src="../assets/avatar.png" alt="Profile Picture">
                </div>
                <?php
                $email=$_SESSION['user'];
                $user_data_fetch="SELECT * FROM user WHERE email='$email'";
                $sqlexe=mysqli_query($conn,$user_data_fetch);
                $user_data=mysqli_fetch_assoc($sqlexe);
                
                $user_id = $user_data['user_id'];
                $follwerssql="SELECT* FROM follow WHERE otheruser_id='$user_id' AND follow=1";
              
                $follwerssum=mysqli_num_rows( mysqli_query($conn,$follwerssql));
                
                echo'<h2>@'.$user_data['name'].'</h2>
                <p>',$follwerssum,' connections</p>';
              
               if($user_data["is_student"]=="yes"){
                echo'<div class="tag">
                  STUDENT
                </div>';
               }
               else{}



                ?>
                <!-- <h2>@aadyajha</h2>
                <p>243 connections</p> -->
                <!-- <div class="tag">
                  STUDENT
                </div> -->
                <!-- <div class="social-links">
                    <p>Socials</p>
                    <a href="#">loremipsum.com</a>
                    <a href="#">loremipsum.com</a>
                </div> -->
                <!-- <button class="follow-btn">FOLLOW</button>
                <button class="message-btn">MESSAGE</button> -->
            </div>
        </div>

       
            
        </div>
    </div>
    </section>

    
    <!-- SKILL DETAIL SECTION  -->
    <section class="skill-details">
        <div class="wrapper-skills-and-details">
            <div class="profile-details">
              <?php
                echo '<h1>'.$user_data['name'].'</h1>';
                if($user_data['is_student']=="yes"){
                    if(empty($user_data['designation']) || empty($user_data['organization'] )|| empty($user_data['occupation'] )){
                      echo'<p><strong>Student</strong>';
                    }
                    else{
                 echo'<p><strong>'.$user_data['designation'].'</strong>, '.$user_data['organization'].', '.$user_data['occupation'].'.</p>';}}
                 else{
                    if(empty($user_data['designation']) || empty($user_data['organization'] )|| empty($user_data['occupation'] )){
                      echo'<p>Currently exploring options';
                    }
                    else{
                       echo'<p><strong>'.$user_data['designation'].'</strong>, '.$user_data['organization'].', '.$user_data['occupation'].'.</p>';}
                    }
                 

                ?>
                <!-- <h1>Aadya Jha</h1> -->
                <!-- <p><strong>Founder</strong>, XYZ Inc., Licensed Professional Counsellor.</p> -->
                
                <div class="location">
                  <img src="../assets/location.png" alt="">
                  <div class="location-details">
                    <?php
                      $location_parts = [];

if (!empty($user_data['city'])) {
    $location_parts[] = htmlspecialchars($user_data['city']);
}
if (!empty($user_data['country'])) {
    $location_parts[] = htmlspecialchars($user_data['country']);
}

$address = trim($user_data['address'] ?? '');

if (empty($location_parts) && empty($address)) {
    echo '<p style="padding-top:7px"><strong>No location added</strong></p>';
} else {
    
    if (!empty($location_parts)) {
         $style = empty($address) ? ' style="padding-top:7px"' : '';
        echo '<p' . $style . '><strong>' . implode(', ', $location_parts) . '</strong></p>';
    }

    
    if (!empty($address)) {
        $address_parts = explode(",", $address, 2);

        if (count($address_parts) < 2) {
            $half = ceil(strlen($address) / 2);
            $address_parts[0] = substr($address, 0, $half);
            $address_parts[1] = substr($address, $half);
        }

        echo $address_parts[0] . "<br>" . $address_parts[1];
    }
}
    
                        ?>
                      
                        <!-- <p><strong>Paris, France</strong></p>
                        <p>H-123, Goldsworth Street, Rush Lane, North Paris, France.</p> -->
                    </div>
            </div>
        </div>
        <div class="qualification-experience-wrapper">

        
        <div class="qualifications">
  <h2>Qualifications</h2>
  <ul id="qualification-list">
    
  <?php
  
  $user_id = $user_data['user_id'];
  $result = mysqli_query($conn, "SELECT * FROM qualification WHERE user_id = $user_id");
  if(mysqli_num_rows($result)<1){
    echo'<li id="add-qual-msg" style="color: gray;">Add Qualification</li>';
}
  while ($qualification_data = mysqli_fetch_assoc($result)) {
      echo '<li data-id="' . $qualification_data['qualification_id'] . '">' . htmlspecialchars($qualification_data['qualification']) . ' <button class="remove-btn">-</button></li>';

  }
  ?>
  <li id="add-qualification-item">
    <button id="add-qualification-btn">+</button>
  </li>
</ul>

</div>


        <div class="experiences">
  <h2>Experiences</h2>
  <ul id="experience-list">
     <?php
  
  $experience_result = mysqli_query($conn, "SELECT * FROM experience WHERE user_id = $user_id");
   if(mysqli_num_rows($experience_result)<1){
    echo'<li id="add-exp-msg" style="color: gray;">Add Experience</li>';
}
  while ($experience_data = mysqli_fetch_assoc($experience_result)) {
      echo '<li data-id="' . $experience_data['experience_id'] . '">' . htmlspecialchars($experience_data['experience']) . ' <button class="remove-btn">-</button></li>';

  }
  ?>
    <li id="add-experience-item">
      <button id="add-experience-btn">+</button>
    </li>
  </ul>
</div>

    </div>
    </section>
    <section class="about-section">
        <button class="edit-btn">Edit</button>
        <h2>About</h2>

        <?php
        if($user_data['about']==NULL){
          echo' <p class="empty-msg"> <b> Looks like you haven\'t entered anything about yourself. Tap the Edit button to do so. </b></p>';
        }
       else{
       echo'<p class="about-text">'.$user_data['about'].'</p>';}
        ?>
    </section>

    <!-- Overlay Modal -->
<div class="overlay" id="overlay">
    <div class="overlay-content">
      <!-- <button class="close-btn" id="closeOverlay">&times;</button> -->
       <form  id="aboutForm" method="POST" style="height: 90%;">
        <textarea id="aboutInput" placeholder="Write something about yourself..." name="about"></textarea>
        <div class="button-container">

          <button type="button" id="closeOverlay">Cancel</button>  
          <button type="submit" id="submitAbout" name="submitAbout">Submit</button>
        </div>
        </form>
    </div>
</div>

    <section class="events-wrapper">
        <div class="events-header">

            <h2>Events</h2> 
            <button class="add-more-btn">Add Events</button>
        </div>

        <div class="event-form-container" id="eventFormContainer" style="display: none;">
           <form id="eventForm" class="event-form" action="add_event.php" method="POST" enctype="multipart/form-data">
                <h3>Add New Event</h3>
                <label for="eventTitle">Event Title</label>
                 <input type="text" id="eventTitle" name="eventTitle" maxlength="50" placeholder="Maximum 50 characters" required>

        
                <label for="eventDescription">Description</label>
              <textarea id="eventDescription" name="eventDescription" draggable="false" maxlength="200" placeholder="Maximum 50 characters" required></textarea>
               <small id="wordCount">0/75 words</small>

        
<div class="custom-file-upload">
    <label for="eventImage">Upload Image</label>
    <input type="file" id="eventImage" name="eventImage" accept="image/*">
  </div>
<!-- Image preview -->
<img
  id="imagePreview"
  src=""
  alt="Image Preview"
  style="display:none; margin-top:10px; width:100px; height:100px; object-fit:cover; border-radius:8px;"
/>

        <div class="btn-container">

            <button type="submit" name="eventsubmit" value="1">Submit</button>
            <button type="button" id="cancelFormBtn">Cancel</button>
        </div>
            </form>
        </div>
         <?php

$user_id = $user_data['user_id'];
$get_event="SELECT * FROM event WHERE user_id=$user_id ORDER BY event_id DESC ";
$event_result = mysqli_query($conn,$get_event );

if (mysqli_num_rows($event_result) > 0) {
    echo '<div class="cards-container">';
    while ($event_data = mysqli_fetch_assoc($event_result)) {
        $title = htmlspecialchars($event_data['title']);
        $description = htmlspecialchars($event_data['description']);
         $eventId=($event_data['event_id']);
        // Convert image BLOB to base64 string for inline display
        if (!empty($event_data['image'])) {
            $base64Image = 'data:image/jpeg;base64,' . base64_encode($event_data['image']);
        } else {
            $base64Image = '../assets/sample.png'; // fallback to sample image
        }

        echo '
<div class="card" data-id="' . $eventId . '">
            <img src="' . $base64Image . '" alt="' . $title . '">
            <div class="card-content">
                <h3>' . $title . '</h3>
                <p>' . $description . '</p>
            </div>
         
            <button type="submit" class="remove-btn-events">-</button>
        
            
        </div>';
    }
    echo '</div>';
} else {
    echo '<p>No events available.</p>';
}
?>

    
            </div>

            
           
        </div>
    </section>

    <!-- SUGGESTIONS SECTION  -->
    <!-- <section class="suggestion-section">

   
    
        <div class="suggestion-card">
            <h3>Feedback <span class="count">13 feedbacks</span></h3>
            <div class="card-title">Title 1</div>
            <p>Sodales gravida sodales fermentum aptent venenatis sed ut mattis.</p>
            <div class="card-title">Title 2</div>
            <p>Sodales gravida sodales fermentum aptent venenatis sed ut mattis.</p>
            <a href="#" class="read-more">Read More.</a>
        </div>
        <div class="suggestion-card">
            <h3>Feedback <span class="count">13 feedbacks</span></h3>
            <div class="card-title">Title 1</div>
            <p>Sodales gravida sodales fermentum aptent venenatis sed ut mattis.</p>
            <div class="card-title">Title 2</div>
            <p>Sodales gravida sodales fermentum aptent venenatis sed ut mattis.</p>
            <a href="#" class="read-more">Read More.</a>
        </div>

    </section> -->

     <!-- FOOTER  -->


     <?php
    include("footer.php");
    ?> 

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
        const addMoreBtn = document.querySelector('.add-more-btn');
const eventFormContainer = document.getElementById('eventFormContainer');
const cancelFormBtn = document.getElementById('cancelFormBtn');

addMoreBtn.addEventListener('click', () => {
    eventFormContainer.style.display = 'block';
});

cancelFormBtn.addEventListener('click', () => {
    eventFormContainer.style.display = 'none';
});

const fileInput = document.getElementById('eventImage');
const imagePreview = document.getElementById('imagePreview');

fileInput.addEventListener('change', () => {
  const file = fileInput.files[0];

  if (file) {
    const reader = new FileReader();
    reader.onload = function(e) {
      imagePreview.src = e.target.result;
      imagePreview.style.display = "block";
    }
    reader.readAsDataURL(file);
  } else {
    imagePreview.style.display = "none";
    imagePreview.src = "";
  }
});


// QUALIFICATION 
const qualificationList = document.getElementById('qualification-list');
const addItem = document.getElementById('add-qualification-item');
const addBtn = document.getElementById('add-qualification-btn');

addBtn.addEventListener('click', () => {
  const qualification = prompt("Enter new qualification:");

  // Check if user entered a value
  if (qualification && qualification.trim() !== '') {
    fetch('add_qualification.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: 'qualification=' + encodeURIComponent(qualification.trim())
    })
    .then(response => response.text())
    .then(result => {
     if (result === 'success') {
  // Remove "Add qualification" message if it's there
  const addMsg = document.getElementById('add-qual-msg');
  if (addMsg) addMsg.remove();

  const li = document.createElement('li');
  li.setAttribute('data-id', 'new'); // you can update ID from server later if needed
  li.innerHTML = `${qualification.trim()} <button class="remove-btn">-</button>`;
  qualificationList.insertBefore(li,addItem);

      } else {
        alert("Error saving qualification to database.");
      }
    })
    .catch(err => {
      console.error("Fetch error:", err);
      alert("An error occurred while saving.");
    });
  }
});

qualificationList.addEventListener('click', (e) => {
  if (e.target.classList.contains('remove-btn')) {
    const li = e.target.closest('li');
    const qualificationId = li.getAttribute('data-id');

    if (confirm("Are you sure you want to delete this qualification?")) {
      fetch('delete_qualification.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'id=' + encodeURIComponent(qualificationId)
      })
      .then(response => response.text())
      .then(result => {
        if (result === 'success') {
  li.remove();

  // Check if all qualifications are deleted
  const remainingItems = qualificationList.querySelectorAll('li[data-id]');
  if (remainingItems.length === 0) {
    const msg = document.createElement('li');
    msg.id = 'add-qual-msg';
    msg.style.color = 'gray';
    msg.textContent = 'Add Qualification';
    qualificationList.insertBefore(msg,addItem);
  }

        } else {
          alert("Failed to delete qualification.");
        }
      })
      .catch(err => {
        console.error("Fetch error:", err);
        alert("An error occurred while deleting.");
      });
    }
  }
});


// EXPERIENCE 
const experienceList = document.getElementById('experience-list');
const addExperienceItem = document.getElementById('add-experience-item');
const addExperienceBtn = document.getElementById('add-experience-btn');

addExperienceBtn.addEventListener('click', () => {
  const experience = prompt("Enter new experience:");
  if (experience && experience.trim() !== '') {
   fetch('add_experience.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: 'experience=' + encodeURIComponent(experience.trim())
    })
    .then(response => response.text())
    .then(result => {
      if (result === 'success') {

        // Remove "Add exp" message if it's there
  const addMsg = document.getElementById('add-exp-msg');
  if (addMsg) addMsg.remove(); 

        const li = document.createElement('li'); 
        li.setAttribute('data-id', 'new'); // you can update ID from server later if needed
        li.innerHTML = `${experience.trim()} <button class="remove-btn">-</button>`;
        experienceList.insertBefore(li, addExperienceItem);
      } else {
        alert("Error saving experience to database.");
      }
    })
    .catch(err => {
      console.error("Fetch error:", err);
      alert("An error occurred while saving.");
    });
  }
});
experienceList.addEventListener('click', (e) => {
  if (e.target.classList.contains('remove-btn')) {
    const li = e.target.closest('li');
    const experienceId = li.getAttribute('data-id');

    if (confirm("Are you sure you want to delete this experience?")) {
      fetch('delete_experience.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'id=' + encodeURIComponent(experienceId)
      })
      .then(response => response.text())
       .then(result => {
        if (result === 'success') {
  li.remove();

  // Check if all exps are deleted
  const remainingItems = experienceList.querySelectorAll('li[data-id]');
  if (remainingItems.length === 0) {
    const msg = document.createElement('li');
    msg.id = 'add-exp-msg';
    msg.style.color = 'gray';
    msg.textContent = 'Add Experience';
    experienceList.insertBefore(msg,addExperienceItem);
  }

        } else {
          alert("Failed to delete experience.");
        }
      })
      .catch(err => {
        console.error("Fetch error:", err);
        alert("An error occurred while deleting.");
      });
    }
  }
});

// OVERLAY 

  
const editBtn = document.querySelector('.edit-btn');
const overlay = document.getElementById('overlay');
const closeBtn = document.getElementById('closeOverlay');
const aboutText = document.querySelector('.about-text');
const emptyMsg = document.querySelector('.empty-msg');
const aboutInput = document.getElementById('aboutInput');
const aboutForm = document.getElementById('aboutForm');

editBtn.addEventListener('click', () => {
    overlay.style.display = 'flex';
    aboutInput.value = aboutText?.textContent.trim() || "";
});

closeBtn.addEventListener('click', () => {
    overlay.style.display = 'none';
});

aboutForm.addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent normal form submit

    const formData = new FormData(aboutForm);

    fetch('updateprofile.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.text())
    .then(response => {
    const inputText = aboutInput.value.trim();

    // Update frontend without reload
    if (inputText) {
        if (aboutText) {
            aboutText.textContent = inputText;
        } else {
            const newP = document.createElement("p");
            newP.className = "about-text";
            newP.textContent = inputText;
            document.querySelector(".about-section").appendChild(newP);
        }
        if (emptyMsg) emptyMsg.style.display = 'none';
    } else {
        // If input is empty, remove aboutText if it exists
        if (aboutText) aboutText.remove();
        
        // Show the empty message
        if (emptyMsg) {
            emptyMsg.style.display = 'block';
        } else {
            const newEmpty = document.createElement("p");
            newEmpty.className = "empty-msg";
            newEmpty.innerHTML = "<b>Looks like you haven't entered anything about yourself. Tap the Edit button to do so.</b>";
            document.querySelector(".about-section").appendChild(newEmpty);
        }
    }

    overlay.style.display = 'none';
})
    .catch(err => {
        console.error('Failed to submit:', err);
    });
});

   
    //EVENT 
document.getElementById("eventForm").addEventListener("submit", function (e) {
  e.preventDefault(); // Stop form from submitting normally

  const form = e.target;
  const imageInput = document.getElementById("eventImage");
  const descriptionInput = document.getElementById("eventDescription");
  const words = descriptionInput.value.trim().split(/\s+/).filter(Boolean);

  // Validation
  if (!imageInput.value) {
    alert("Please upload an image.");
    return;
  }

  if (words.length > 75) {
    alert("Description cannot exceed 75 words.");
    return;
  }

  // Proceed with AJAX form submission
  const formData = new FormData(form);
formData.append("eventsubmit", "1"); 
  fetch("add_event.php", {
    method: "POST",
    body: formData,
  })
    .then((res) => res.text())
    .then((result) => {
      if (result.trim() === "success") {
        form.reset();
        document.getElementById("imagePreview").style.display = "none";
        window.location.reload();
      } else {
        alert("Error: " + result);
      }
    })
    .catch((err) => {
      alert("An error occurred.");
      console.error(err);
    });
});
//word counter
const desc = document.getElementById("eventDescription");
const wordCountHelper = document.getElementById("wordCount");

desc.addEventListener("input", () => {
  const words = desc.value.trim().split(/\s+/).filter(Boolean);
  wordCountHelper.textContent = `${words.length}/75 words`;
  wordCountHelper.style.color = words.length > 75 ? "red" : "black";
});


// Image preview
document.getElementById("eventImage").addEventListener("change", function () {
  const preview = document.getElementById("imagePreview");
  const file = this.files[0];

  if (file) {
    const reader = new FileReader();
    reader.onload = function (e) {
      preview.src = e.target.result;
      preview.style.display = "block";
    };
    reader.readAsDataURL(file);
  } else {
    preview.src = "";
    preview.style.display = "none";
  }
});
 
document.addEventListener('click', (e) => {
  if (e.target.classList.contains('remove-btn-events')) {
    const button = e.target;
    const card = button.closest('.card'); // This is your wrapper div
    const eventId = card.getAttribute('data-id'); // Make sure .card has this

    if (!eventId) {
      alert("Missing event ID.");
      return;
    }

    if (confirm("Are you sure you want to delete this event?")) {
      fetch('delete_event.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'id=' + encodeURIComponent(eventId)
      })
      .then(response => response.text())
      .then(result => {
        if (result === 'success') {
          card.remove();
        } else {
          alert("Failed to delete event.");
        }
      })
      .catch(err => {
        console.error("Fetch error:", err);
        alert("An error occurred while deleting.");
      });
    }
  }
});



    </script>
</body>
</html>
