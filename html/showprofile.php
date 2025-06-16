<?php 
session_start();
include("dbconfig.php");

if (isset($_POST['user_id'])) {
    $user_id = intval($_POST['user_id']);
    // echo$user_id; 
    // safer conversion to integer
    // Use $user_id in your query, for example:
    // $query = "SELECT * FROM user WHERE user_id = $user_id";




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Profile | SRM</title>
    <link rel="stylesheet" href="../css/showprofile2.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <?php
include("nav.php");

?>

    <!-- Profile  HEADER Section -->
    <section class="profile-section">
        <div class="profile-section-wrapper">
        <div class="profile-container">
            <div class="profile-card-2">
                <div class="profile-image">
                    <img src="../assets/avatar.png" alt="Profile Picture">
                </div>
                <?php
                
                $user_data_fetch="SELECT * FROM user WHERE user_id='$user_id'";
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
                <?php
                if(isset($_SESSION['user'])){
                $email = $_SESSION['user'];
                $sql2="SELECT user_id FROM user WHERE email='$email'";
                $result2=mysqli_query($conn,$sql2);
                $row2=(mysqli_fetch_assoc($result2));
                $loggedin_user_id=$row2['user_id'];

                $sql14="SELECT *FROM follow WHERE user_id='$loggedin_user_id' AND otheruser_id='$user_id'";
                $following=mysqli_query($conn,$sql14);
                if($following_result=mysqli_fetch_assoc($following)){
                echo '<form action="unfollow_backend.php" method="POST">
                <input type="hidden" name="otheruser_id" value="'. $user_id.'">
                <input type="hidden" name="loggedin_user_id" value="'. $loggedin_user_id.'">
                <input type="hidden" name="otheruser_name" value="'. $user_data['name'].'">
                <button class="follow-btn"name="unfollow" type="submit">FOLLOWING</button>
                </form>';

                  echo'<form action="chat.php?user='.$user_data['name'].'" method="POST">
                <input type="hidden" name="receiver_user_id" value="'. $user_id.'">
                <input type="hidden" name="loggedin_user_id" value="'. $loggedin_user_id.'">
                <input type="hidden" name="receiver_user_name" value="'. $user_data['name'].'">
                <button class="message-btn" name="message_button" type="submit">MESSAGE</button>
                </form>';
                
                }
                else{
                    echo'<form action="follow_backend.php" method="POST">
                <input type="hidden" name="user_id" value="'. $user_id.'">
                <button class="follow-btn" type="submit">FOLLOW</button>
                </form>';
                }}
                else{
                  echo'<form action="login.php" method="POST">
                
                <button class="follow-btn" type="submit">FOLLOW</button>
                </form>';
                
                
                }
                // echo '<a href="messages.php?otherperson='.$otheruser.'"><button class="login-btn more-btn">Message</button></a>';
               
                
                // echo'<form action="chat.php?user='.$user_data['name'].'" method="POST">
                // <input type="hidden" name="receiver_user_id" value="'. $user_id.'">
                // <input type="hidden" name="loggedin_user_id" value="'. $loggedin_user_id.'">
                // <input type="hidden" name="receiver_user_name" value="'. $user_data['name'].'">
                // <button class="message-btn" name="message_button" type="submit">MESSAGE</button>
                // </form>';
                ?>
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
  
  
  $result = mysqli_query($conn, "SELECT * FROM qualification WHERE user_id = $user_id");
  
  if ( mysqli_num_rows($result)>0) {
    while($qualification_data = mysqli_fetch_assoc($result)){
      echo '<li>' . htmlspecialchars($qualification_data['qualification']) ;
  }}
  else{
     echo '<li>No qualification added</li> ';
  }
  ?>
 
</ul>

</div>


        <div class="experiences">
  <h2>Experiences</h2>
  <ul id="experience-list">
     <?php
  
  $experience_result = mysqli_query($conn, "SELECT * FROM experience WHERE user_id = $user_id");
  if ( mysqli_num_rows($experience_result)>0) {
  while ($experience_data = mysqli_fetch_assoc($experience_result)) {
      echo '<li >' . htmlspecialchars($experience_data['experience']) ;
  }}
  else{
     echo '<li>No experience added</li> ';
  }
  ?>
    
  </ul>
</div>

    </div>
    </section>
    <section class="about-section">
        <h2>About</h2>

        <?php
        if($user_data['about']==NULL){
          echo' <p class="empty-msg"> <b> Nothing here yet – check back later! </b></p>';
        }
       else{
       echo'<p class="about-text">'.$user_data['about'].'</p>';}
        ?>
    </section>


    <section class="events-wrapper">
        <div class="events-header">

            <h2>Events</h2> 
           
        </div>

        

         <?php

$get_event="SELECT * FROM event WHERE user_id=$user_id ORDER BY event_id DESC ";
$event_result = mysqli_query($conn,$get_event );

if (mysqli_num_rows($event_result) > 0) {
    echo '<div class="cards-container">';
    while ($event_data = mysqli_fetch_assoc($event_result)) {
        $title = htmlspecialchars($event_data['title']);
        $description = htmlspecialchars($event_data['description']);

      
        if (!empty($event_data['image'])) {
            $base64Image = 'data:image/jpeg;base64,' . base64_encode($event_data['image']);
        } else {
            $base64Image = '../assets/sample.png'; 
        }

        echo '
        <div class="card">
            <img src="' . $base64Image . '" alt="' . $title . '">
            <div class="card-content">
                <h3>' . $title . '</h3>
                <p>' . $description . '</p>
            </div>
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



     <?php
    include("footer.php");
    ?> 

    
    <script>
      
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
        const li = document.createElement('li');
        li.innerHTML = `${qualification.trim()} <button class="remove-btn">-</button>`;
        qualificationList.insertBefore(li, addItem);
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
        const li = document.createElement('li');
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
    const submitBtn = document.getElementById('submitAbout');
    const closeBtn = document.getElementById('closeOverlay');
    const aboutText = document.querySelector('.about-text');
    const emptyMsg = document.querySelector('.empty-msg');
    const aboutInput = document.getElementById('aboutInput');

    editBtn.addEventListener('click', () => {
        overlay.style.display = 'flex';
        aboutInput.value = aboutText.textContent.trim();
    });

    submitBtn.addEventListener('click', () => {
        const inputText = aboutInput.value.trim();
        aboutText.textContent = inputText || "No about info provided.";
        emptyMsg.style.display = inputText ? 'none' : 'block';
        overlay.style.display = 'none';
    });

    closeBtn.addEventListener('click', () => {
        overlay.style.display = 'none';
    });


document.getElementById("eventForm").addEventListener("submit", function (e) {
  const imageInput = document.getElementById("eventImage");
  const descriptionInput = document.getElementById("eventDescription");
  const words = descriptionInput.value.trim().split(/\s+/).filter(Boolean);

  if (!imageInput.value) {
    alert("Please upload an image.");
    e.preventDefault();
    return;
  }

  if (words.length > 75) {
    alert("Description cannot exceed 75 words.");
    e.preventDefault();
  }
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


    </script>
</body>
</html>
<?php }
else{
  header("location:searchpage.php");
}?>
