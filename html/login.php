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
    <link rel="stylesheet" href="../css/login.css" />
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
        <h1>Login</h1>
        <p>
          We're glad to see you again. Please log in to your account to continue enjoying our services.
        </p>
      </div>
    </section>

    <!-- Overlapping Cards Section -->
    <section class="info-section">
      <div class="info-container">
        <!-- CARD  -->
        <div class="card">
          <h2>Enter your Details</h2>
          <?php
           if(isset($_SESSION['fail'])){
            echo '<p style="color: red;">' . $_SESSION['fail'] . '</p>';

            unset($_SESSION['fail']);
           }

          ?>
          <form action="login_backend.php" method="POST">
           

            <label for="email_input" class="form-label">Email Adress</label>
            <input
              type="text"
              id="email_input"
              name="login_email"
              placeholder="johndoe@gmail.com"
              class="input-w-100"
              required
            />

            <label for="password_input" class="form-label">Enter your password</label>
            <input
              type="password"
              id="password_input"
              name="login_password"
              placeholder="Enter your password"
              class="input-w-100"
              required
            />
            <p class="leading">Don't have an account? <a href="signup.php">Create Account</a></p>
            <button class="p-btn" name="login">Login</button>
          </div>
        </form>


       
        
          
      </div>
    </section>


     <!-- FOOTER  -->


     <?php
    include("footer.php");
    ?>


  </body>
</html>
