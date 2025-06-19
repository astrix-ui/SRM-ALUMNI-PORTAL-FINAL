<?php
session_start();
if(isset($_SESSION['user'])){
  header("location:index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login | SRM Alumni</title>
    <link rel="stylesheet" href="../css/signup.css" />
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
        <h1>Sign Up</h1>
        <p>
          Become a part of our growing community. Register through the form
          below.
        </p>
        <p class="leading">
          Already have an account? <a href="login.php">Login</a>
        </p>
      </div>
    </section>

    <!-- Overlapping Cards Section -->
    <section class="info-section">
      <div class="info-container">
        <!-- CARD  -->
        <div class="card">
          <h2>Basics</h2>
          <?php
           if(isset($_SESSION['fail'])){
            echo '<p style="color: red;">' . $_SESSION['fail'] . '</p>';

            unset($_SESSION['fail']);
           }

          ?>
          <form action="signup_backend.php" method="POST">
            
              <label for="Name" class="form-label">Name</label>
              <input 
              type="text" 
              name="name" 
              placeholder="Name" 
              class="input-w-100"
              required
              />
            


            <label for="email_input" class="form-label">Email Adress</label>
            <input
              type="text"
              id="email_input"
              name="email"
              placeholder="johndoe@gmail.com"
              class="input-w-100"
              required
            />

            <label for="password_input" class="form-label"
              >Enter your password</label
            >
            <input
              type="password"
              id="password_input"
              name="password"
              placeholder="Enter your password"
              class="input-w-100"
              required
            />

            <label for="confirm_password_input" class="form-label"
              >Confirm your password</label
            >
            <input
              type="password"
              id="confirm_password_input"
              name="cpassword"
              placeholder="Confirm your password"
              class="input-w-100"
              required
            />
          
        </div>

        <!-- <div class="card">
          <h2>Professional Information</h2>
          
            <label for="current_company" class="form-label"
              >Current Company / Organization</label
            >
            <input
              type="text"
              name="current_company"
              id="current_company"
              placeholder="Enter Details"
              class="input-w-100"
            />

            <label for="designation_input" class="form-label"
              >Designation</label
            >
            <input
              type="text"
              name="Designation"
              id="designation_input"
              placeholder="Enter your Designation"
              class="input-w-100"
            />

            <label for="industry_input" class="form-label">Industry</label>
            <input
              type="text"
              name="Industry"
              id="industry_input"
              placeholder="Enter your Industry"
              class="input-w-100"
            />
          
        </div> -->

        <div class="card">
          <h2>Academic Information</h2>
<<<<<<< HEAD
          <label for="batch_input" class="form-label">Batch</label>
=======
          <label for="batch_input" class="form-label">Passout Batch Year</label>
>>>>>>> 862ec94 (Initial commit)
          <input
          type="text"
          name="Batch"
          id="batch_input"
<<<<<<< HEAD
          placeholder="Enter Batch Year"
=======
          placeholder="Enter Batch Details (example: 2027)"
>>>>>>> 862ec94 (Initial commit)
          class="input-w-100"
          required
          />
          
           <label for="degree_input" class="form-label">Degree</label>
  <select name="degree" id="degree_input" class="input-w-100" required>
    <option selected disabled value="">Select Degree</option>
    <option value="BTech">B.Tech</option>
    <option value="MTech">M.Tech</option>
    <option value="Mba">MBA</option>
    <option value="Bsc">B.Sc</option>
    <option value="Msc">M.Sc</option>
    <option value="Bca">BCA</option>
    <option value="Mca">MCA</option>
    <option value="Ba">BA</option>
    <option value="Ma">MA</option>
    <option value="Bcom">B.Com</option>
    <option value="Mcom">M.Com</option>
  </select>

  <label for="specialization" class="form-label">Specialization</label>
  <select name="specialization" id="specialization" class="input-w-100" required>
    <option selected disabled value="">Select specialization</option>
  </select>
          
          <div class="student-radio">
            <p>Are you a student?</p>
            
            <label>
              <input type="radio" name="student" value="yes" required />
              Yes </label
              ><br />
              
              <label>
                <input type="radio" name="student" value="no" />
                No
              </label>
            </div>
          </div>
      
          
          <button class="p-btn" name="register">Register</button>
        </div>
      </form>
      </section>

    <!-- FOOTER  -->

    <?php
    include("footer.php");
    ?>

   <script>
const branchesByDegree = {
  btech: [
    "Computer Science Engineering",
    "Information Technology",
    "Electronics and Communication",
    "Electrical Engineering",
    "Mechanical Engineering",
    "Civil Engineering",
    "Biotechnology",
    "Chemical Engineering",
    "Aerospace Engineering",
    "Automobile Engineering"
  ],
  mtech: [
    "Artificial Intelligence",
    "Data Science",
    "Thermal Engineering",
    "VLSI Design",
    "Embedded Systems",
    "Power Systems",
    "Structural Engineering",
    "Environmental Engineering"
  ],
  mba: [
    "Finance",
    "Marketing",
    "Human Resource Management",
    "Operations Management",
    "Business Analytics",
    "International Business",
    "Entrepreneurship"
  ],
  bsc: [
    "Computer Science",
    "Physics",
    "Mathematics",
    "Chemistry",
    "Biotechnology",
    "Statistics",
    "Zoology",
    "Botany"
  ],
  msc: [
    "Mathematics",
    "Physics",
    "Chemistry",
    "Biotechnology",
    "Computer Science",
    "Microbiology",
    "Environmental Science"
  ],
  bca: [
    "Computer Applications",
    "Information Security",
    "Data Analytics",
    "Mobile Application Development"
  ],
  mca: [
    "Computer Applications",
    "AI and Machine Learning",
    "Data Science",
    "Cloud Computing",
    "Cybersecurity"
  ],
  ba: [
    "Economics",
    "Psychology",
    "Sociology",
    "History",
    "Political Science",
    "English Literature"
  ],
  ma: [
    "English",
    "Economics",
    "Psychology",
    "Sociology",
    "History",
    "Public Administration"
  ],
  bcom: [
    "Accounting",
    "Finance",
    "Taxation",
    "Economics",
    "Banking and Insurance"
  ],
  mcom: [
    "Accounting and Finance",
    "Banking",
    "International Business",
    "Marketing"
  ]
};

document.getElementById("degree_input").addEventListener("change", function () {
  const degree = this.value.toLowerCase();
  const specializationSelect = document.getElementById("specialization");

  // Clear existing options
  specializationSelect.innerHTML = '<option disabled selected value="">Select specialization</option>';

  if (branchesByDegree[degree]) {
    branchesByDegree[degree].forEach(branch => {
      const option = document.createElement("option");
      option.value = branch; // use original capitalization
      option.textContent = branch;
      specializationSelect.appendChild(option);
    });
  }
});

</script>
  </body>
</html>
