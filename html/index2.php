<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home | SRM Alumni</title>
    <link rel="stylesheet" href="../css/index2.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
      rel="stylesheet"
    />
  </head>

  <body>

    <!-- NAVBAR  -->

    <nav class="navbar">
      <div class="logo">
        <img src="../assets/srmlogo.png" alt="Logo" />
      </div>
      <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="#">About Us</a></li>
        <li><a href="searchPage.html">Directory</a></li>
        <li><a href="#">Events</a></li>
        <li><a href="chat.html">Interact</a></li>
      </ul>
      <div class="register-btn">
        <?php
                  if(isset($_SESSION['user'])){
                    echo'<a href="logout.php" id="register-btn-text">Logout</a>';}
                    else{
                      echo'<a href="login.php" id="register-btn-text">Register</a>';}
                  ?>
        <!-- <a href="login.php" id="register-btn-text">Register</a> -->
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
        <li><a href="#">Home</a></li>
        <li><a href="#">About Us</a></li>
        <li><a href="#">Directory</a></li>
        <li><a href="#">Events</a></li>
        <li><a href="#">Interact</a></li>
        <li><a href="#">Profile</a></li>

      </ul>
      <div class="mobile-register-btn">
        <a href="./login.php" id="mobile-register-btn-text">Register</a>
      </div>
    </div>

    <!-- Hero Section -->
    <section class="hero-section">
      <div class="hero-section">
        <h1>From Campus to Community,<br>
            Always Together.</h1>
        <p>
            Stay connected with fellow alumni, discover exciting events, and contribute to our growing legacy
        </p>
       <div class="action-btn"> <?php
                  if(!isset($_SESSION['user'])){
                  echo'<a href="signup.php" class="sec-btn" >Register Now</a>';}
                  else{}
                  ?>
        <!-- <a href="" class="sec-btn" >Register Now</a> -->
        <a href="searchPage.html" class="sec-btn">Discover Alumni</a>
       </div>
      </div>
    </section>


    <!-- OVERLAPPING SEARCH SECTION  -->

    
    

      <!-- PROBLEM SECTION  -->
       <section class="problem-section" >
        <h1 id="problem-section-h1">Alumni Networks are Fragmented</h1>

        <!-- BOX CONTAINER  -->
         <div class="grid-container">

         
        <div class="fragmented-grid" id="fragmentedGrid">

            <!-- CARDS  -->

            <div class="fragmented-card">
              <div class="fragmented-circle"></div>
              <p>I find it difficult to keep track of things.</p>
            </div>

            <div class="fragmented-card">
                <div class="fragmented-circle"></div>
                <p>I find it difficult to keep track of things.</p>
              </div>

              <div class="fragmented-card">
                <div class="fragmented-circle"></div>
                <p>I find it difficult to keep track of things.</p>
              </div>

              <div class="fragmented-card">
                <div class="fragmented-circle"></div>
                <p>I find it difficult to keep track of things.</p>
              </div>

              <div class="fragmented-card">
                <div class="fragmented-circle"></div>
                <p>I find it difficult to keep track of things.</p>
              </div>

              <div class="fragmented-card">
                <div class="fragmented-circle"></div>
                <p>I find it difficult to keep track of things.</p>
              </div>

              <div class="fragmented-card">
                <div class="fragmented-circle"></div>
                <p>I find it difficult to keep track of things.</p>
              </div>

              
              <div class="fragmented-card">
                <div class="fragmented-circle"></div>
                <p>I find it difficult to keep track of things.</p>
              </div>

              <div class="fragmented-card">
                <div class="fragmented-circle"></div>
                <p>I find it difficult to keep track of things.</p>
              </div>

              <div class="fragmented-card">
                <div class="fragmented-circle"></div>
                <p>I find it difficult to keep track of things.</p>
              </div>

              <div class="fragmented-card">
                <div class="fragmented-circle"></div>
                <p>I find it difficult to keep track of things.</p>
              </div>

              <div class="fragmented-card">
                <div class="fragmented-circle"></div>
                <p>I find it difficult to keep track of things.</p>
              </div>


              <div class="fragmented-card">
                <div class="fragmented-circle"></div>
                <p>I find it difficult to keep track of things.</p>
              </div>

              <div class="fragmented-card">
                <div class="fragmented-circle"></div>
                <p>I find it difficult to keep track of things.</p>
              </div>

              <div class="fragmented-card">
                <div class="fragmented-circle"></div>
                <p>I find it difficult to keep track of things.</p>
              </div>
              <div class="fragmented-card">
                <div class="fragmented-circle"></div>
                <p>I find it difficult to keep track of things.</p>
              </div>
              <div class="fragmented-card">
                <div class="fragmented-circle"></div>
                <p>I find it difficult to keep track of things.</p>
              </div>
            </div>
        </div>

       </section>



       <!-- SEARCH SECTION  -->

        <!-- Search Section -->
    <section class="search-section">
        <div class="search-container">
          <!-- <a href="#" class="p-btn">Search for Alumni</a> -->
          <h1>Search for Alumni</h1>
          <p>
            Quickly find and connect with alumni across the globe. Filter by
            batches, industries, or locations to grow your network effortlessly.
          </p>
          <!-- <div class="search-bar">
            <label for="search-input">Look For</label>
            <div class="vertical-line"></div>
            <input
              type="text"
              id="search-input"
              placeholder="Search for the Alumni's Name"
            />
            <button type="submit">
              <img src="../assets/search.png" alt="Search Icon" />
            </button> -->
        </div>
        <!-- <p class="p-leading">Search alumni by name, batch, branch, location, or company...</p> -->
        <a href="./searchPage.html" class="sec-btn">Search Alumni</a>


        </div>
      </section>
<!-- OVERLAPPING SEARCH SECTION -->
      <section class="info-section">
        <div class="info-container">
          

          <div class="card">
            
              <!-- SEARCH RESULTS HEADER  -->
              <div class="search-results">
                  <div class="results-header">
            <h1>Search Results</h1>
          <div class="filters">
            <span>Filters:</span>
            <select>
              <option>Batch</option>
            </select>
            <select>
              <option>Branch</option>
            </select>
            <select>
              <option>Location</option>
            </select>
            <select>
              <option>Occupation</option>
            </select>
          </div>
        </div>
        <div class="alerts-section">
          <div class="create-alert">
            <img src="../assets/notification.png" alt="Bell Icon" />
            <span>Create alerts for this search?</span>
          </div>
        </div>
      </div>
  
  
      <div class="profile-container">
        <!-- CARD  -->
        <div class="profile-card">
            <div class="profile-left-section">
              <div class="profile-image"></div>
              <div class="profile-name">
                <h2>Aadya Jha</h2>
                <p><span id="position">Founder,</span> XYZ Inc.</p>
              </div>
            </div>
            <div class="profile-details">
              <p>B.Tech, CSE</p>
              <p>2012</p>
              <p>Paris, France</p>
              <button class="view-profile">View Profile</button>
            </div>
          </div>        

           <!-- CARD  -->
        <div class="profile-card">
            <div class="profile-left-section">
              <div class="profile-image"></div>
              <div class="profile-name">
                <h2>Aadya Jha</h2>
                <p><span id="position">Founder,</span> XYZ Inc.</p>
              </div>
            </div>
            <div class="profile-details">
              <p>B.Tech, CSE</p>
              <p>2012</p>
              <p>Paris, France</p>
              <button class="view-profile">View Profile</button>
            </div>
          </div>        

           <!-- CARD  -->
        <div class="profile-card">
            <div class="profile-left-section">
              <div class="profile-image"></div>
              <div class="profile-name">
                <h2>Aadya Jha</h2>
                <p><span id="position">Founder,</span> XYZ Inc.</p>
              </div>
            </div>
            <div class="profile-details">
              <p>B.Tech, CSE</p>
              <p>2012</p>
              <p>Paris, France</p>
              <button class="view-profile">View Profile</button>
            </div>
          </div>        

           <!-- CARD  -->
        <div class="profile-card">
            <div class="profile-left-section">
              <div class="profile-image"></div>
              <div class="profile-name">
                <h2>Aadya Jha</h2>
                <p><span id="position">Founder,</span> XYZ Inc.</p>
              </div>
            </div>
            <div class="profile-details">
              <p>B.Tech, CSE</p>
              <p>2012</p>
              <p>Paris, France</p>
              <button class="view-profile">View Profile</button>
            </div>
          </div>        

           <!-- CARD  -->
        <div class="profile-card">
            <div class="profile-left-section">
              <div class="profile-image"></div>
              <div class="profile-name">
                <h2>Aadya Jha</h2>
                <p><span id="position">Founder,</span> XYZ Inc.</p>
              </div>
            </div>
            <div class="profile-details">
              <p>B.Tech, CSE</p>
              <p>2012</p>
              <p>Paris, France</p>
              <button class="view-profile">View Profile</button>
            </div>
          </div>        

           <!-- CARD  -->
        <div class="profile-card">
            <div class="profile-left-section">
              <div class="profile-image"></div>
              <div class="profile-name">
                <h2>Aadya Jha</h2>
                <p><span id="position">Founder,</span> XYZ Inc.</p>
              </div>
            </div>
            <div class="profile-details">
              <p>B.Tech, CSE</p>
              <p>2012</p>
              <p>Paris, France</p>
              <button class="view-profile">View Profile</button>
            </div>
          </div>        

      
      </section>


    

    <!-- PAGINATION SECTION  -->

    <!-- <section class="pagination-section">
        <div class="pagination">
          <button class="arrow">&lt;</button>
          <button class="page">1</button>
          <button class="page active">2</button>
          <button class="page">3</button>
          <button class="arrow">&gt;</button>
        </div>
      </section> -->

     <!-- FOOTER  -->


     <footer class="contact-section">
      <div class="container">
        <div class="contact-info">
          <h2>Contact Us</h2>
          <p>Stay connected! Reach out to us for queries or support.</p>
          <div class="info">
            <p><span>📧</span> email@xyz.gmail.com</p>
            <p><span>📞</span> +91 1234567890</p>
          </div>
        </div>
        <div class="links">
          <div class="quick-links">

            <h3>Quick Links</h3>
            <ul>
              <li><a href="#">LINK ONE</a></li>
              <li><a href="#">LINK TWO</a></li>
              <li><a href="#">LINK THREE</a></li>
            </ul>
          </div>
        <div class="social">
          <h3>Social Media</h3>
          <ul>
            <li><a href="#">INSTAGRAM</a></li>
            <li><a href="#">FACEBOOK</a></li>
            <li><a href="#">LINKEDIN</a></li>
          </ul>
        </div>
      </div>
      </div>
    </footer>

    <script src="../js/searchPage.js"></script>
    <script>
      const grid = document.getElementById("fragmentedGrid");
      let scrollInterval;
    
      grid.addEventListener("mouseenter", () => {
        scrollInterval = setInterval(() => {
          grid.scrollLeft += 1; // Adjust scroll speed here
        }, 10); // Lower number = smoother but more CPU
      });
    
      grid.addEventListener("mouseleave", () => {
        clearInterval(scrollInterval);
      });
    </script>
    
  </body>
</html>
