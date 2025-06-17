<?php 
include("dbconfig.php");
session_start();
if(!isset($_SESSION['user'])){
    header("location:login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Profile | SRM Alumni</title>
    <link rel="stylesheet" href="../css/editprofile.css" />
    <!-- FONTS  -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <!-- Navbar -->
   <?php
   include("nav.php");
   ?>

    <!-- Header Section -->
    <section class="header-section">
      <div class="header-container">
        <!-- <a href="#" class="p-btn">Search for Alumni</a> -->
        <h1>Edit Profile</h1>
        <p>
          Edit your Profile or complete it for better reachability!
        </p>
         <?php
           if(isset($_SESSION['fail'])){
            echo '<p style="color: red;">' . $_SESSION['fail'] . '</p>';

            unset($_SESSION['fail']);
           }
           if(isset( $_SESSION['success'] )){
            echo '<p style="color: green;">' . $_SESSION['success'] . '</p>';

            unset($_SESSION['success']);
           }

          ?>
      </div>
    </section>
     <?php
       $email=$_SESSION['user'];
                $user_data_fetch="SELECT * FROM user WHERE email='$email'";
                $sqlexe=mysqli_query($conn,$user_data_fetch);
                $user_data=mysqli_fetch_assoc($sqlexe);
     ?>
    <!-- Overlapping Cards Section -->
    <section class="info-section">
      <div class="info-container">
        <!-- CARD  -->
        <div class="card">
          <h2>Basics</h2>
          <form action="updateprofile.php" method="POST">
            <div class="name-input-container">
              <label for="Name" class="form-label">Name</label>
              <input type="text" name="name" placeholder="Name" value="<?php echo $user_data['name']?>" required/>
              
            </div>

            <div class="city-input-container">
              <label for="City" class="form-label">City/Country</label>
              <input type="text" name="city" placeholder="Enter your City" value="<?php echo $user_data['city']?>"/>
              <input type="text" name="country" placeholder="Enter your Country" value="<?php echo $user_data['country']?>" />
            </div>

            <div class="address-input-container">
              <label for="Address" class="form-label">Permanent Address</label>
              <input type="text" name="address" placeholder="Enter your Permanent Address" value="<?php echo $user_data['address']?>" />
            </div>

            <label for="email_input" class="form-label">Email Adress</label>
            <input
              type="text"
              id="email_input"
              name="email"
              placeholder="johndoe@gmail.com"
              value="<?php echo $user_data['email']?>"
              class="input-w-100"
              required
            />

            <!-- <label for="password_input" class="form-label"
              >Enter your password</label
            >
            <input
              type="text"
              id="password_input"
              name="password"
              placeholder="Enter your password"
              class="input-w-100"
            />

            <label for="confirm_password_input" class="form-label"
              >Confirm your password</label
            >
            <input
              type="text"
              id="confirm_password_input"
              name="confirm_password"
              placeholder="Confirm your password"
              class="input-w-100"
            /> -->
  
        </div>

        <div class="card">
          <h2>Professional Information</h2>
          
            <label for="current_company" class="form-label"
              >Current Company / Organization</label
            >
            <input
              type="text"
              name="organization"
              id="current_company"
              placeholder="Enter Details"
              value="<?php echo $user_data['organization']?>"
              class="input-w-100"
            />

            <label for="designation_input" class="form-label"
              >Designation</label
            >
            <input
              type="text"
              name="designation"
              id="designation_input"
              placeholder="Enter your Designation"
              value="<?php echo $user_data['designation']?>"
              class="input-w-100"
            />

            <label for="industry_input" class="form-label">Occupation</label>
            <input
              type="text"
              name="occupation"
              id="industry_input"
              placeholder="Enter your Occupation"
              value="<?php echo $user_data['occupation']?>"
              class="input-w-100"
            />
       
        </div>

        <div class="card">
          <h2>Academic Information</h2>
         
            <label for="batch_input" class="form-label">Batch</label>
            <input
              type="text"
              name="batch"
              id="batch_input"
              placeholder="Enter Batch Details"
              value="<?php echo $user_data['batch']?>"
              class="input-w-100"
              required
            />

            <label for="branch_input" class="form-label">Branch</label>
            <input
              type="text"
              name="degree"
              id="branch_input"
              placeholder="Enter your Degree"
              value="<?php echo $user_data['degree']?>"
              class="input-w-100"
              required
            />

            <label for="specialization" class="form-label"
              >Specialization</label
            >
           <select name="specialization" id="specialization" required>
  <option disabled <?php if (!isset($user_data['specialization'])) echo 'selected'; ?>>Select specialization</option>
  <option value="cs" <?php if ($user_data['specialization'] == 'cs') echo 'selected'; ?>>Computer Science</option>
  <option value="it" <?php if ($user_data['specialization'] == 'it') echo 'selected'; ?>>Information Technology</option>
  <option value="mech" <?php if ($user_data['specialization'] == 'mech') echo 'selected'; ?>>Mechanical Engineering</option>
  <option value="electrical" <?php if ($user_data['specialization'] == 'electrical') echo 'selected'; ?>>Electrical Engineering</option>
</select>


            <div class="student-radio">
              <p>Are you a student?</p>

<label>
  <input type="radio" name="student" value="yes" 
    <?php if ($user_data['is_student'] == 'yes') echo 'checked'; ?> /> Yes
</label>
<br />

<label>
  <input type="radio" name="student" value="no"
    <?php if ($user_data['is_student'] == 'no') echo 'checked'; ?> /> No
</label>

            </div>
          </div>
          
            <!-- ADDED </FORM> (CHANGED) -->
        <button class="p-btn" name="edit_button">Save Changes</button></form> 
        <form action="delete_user.php" method="POST">
          <input type="hidden" name="user_id" value="<?php echo $user_data['user_id'] ?>" >
          <button class="p-btn" name="delete_btn" >Delete Account</button> </form>

        <!-- (CHANGED) PASSWORD LOGIC copy paste the whole div, cuz some inline css changes are done -->
<div class="card" id="change-password-card" style="display: none;">
  <form style="display: flex; flex-direction: column;" action="updateprofile.php" method="POST">
              <h3>Change your Password</h3>
              
               <label for="current_password_input" class="form-label"
              >Enter your current password</label
            >
            <input
              type="password"
              id="current_password_input"
              name="current_password"
              placeholder="Enter your current password"
              class="input-w-100"
              required
            />
               <label for="new_password_input" class="form-label"
              >Enter your new password</label
            >
            <input
              type="password"
              id="new_password_input"
              name="new_password"
              placeholder="Enter your new password"
              class="input-w-100"
              required
            />

            <label for="confirm_password_input" class="form-label"
              >Confirm your password</label
            >
            <input
              type="password"
              id="confirm_password_input"
              name="confirm_password"
              placeholder="Confirm your password"
              class="input-w-100"
              required
            />
            <button class="p-btn" name="change_pwd_button" style="margin: auto; margin-top:20px; text-align: center;">Update Password</button>
          </form>
      </div>
      <div class="btn-container">
        <button class="p-btn" onclick="toggleChangePasswordCard()">Change Password</button>
      

      </div>
    </div>
    </section>

    <!-- FOOTER  -->

    <?php
    include("footer.php");
    ?>

    <script>
      // changed pwd logic
  function toggleChangePasswordCard() {
    const card = document.getElementById("change-password-card");
      console.log("Button clicked"); // add this
    card.style.display = card.style.display === "none" ? "block" : "none";
  }


    </script>
  </body>
</html>