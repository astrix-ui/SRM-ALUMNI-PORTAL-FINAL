<?php
session_start();
include("dbconfig.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home | SRM Alumni</title>
    <link rel="stylesheet" href="../css/index5.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
      rel="stylesheet"
    />
  </head>

  <body>

    <!-- NAVBAR  -->
    <?php
    include("nav.php");
    ?>
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
        <a href="searchpage.php" class="sec-btn">Discover Alumni</a>
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
        </div>
        <!-- <p class="p-leading">Search alumni by name, batch, branch, location, or company...</p> -->
        <a href="./searchpage.php" class="sec-btn">Search Alumni</a>


        </div>
      </section>   
    
      <!-- EVENTS SECTION   -->

    <section class="events-section">
      <H1>Discover Events</H1>
        
             <?php


$get_event="SELECT * FROM event ORDER BY event_id DESC LIMIT 3 ";
$event_result = mysqli_query($conn,$get_event );

if (mysqli_num_rows($event_result) > 0) {
    echo '<div class="cards-container">';
    while ($event_data = mysqli_fetch_assoc($event_result)) {
        $title = htmlspecialchars($event_data['title']);
        $description = htmlspecialchars($event_data['description']);

        // Convert image BLOB to base64 string for inline display
        if (!empty($event_data['image'])) {
            $base64Image = 'data:image/jpeg;base64,' . base64_encode($event_data['image']);
        } else {
            $base64Image = '../assets/sample.png'; // fallback to sample image
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
    // echo '<p>No events available.</p>';
}
?>

           <a href="eventpage.php" class="p-btn">Explore More</a>
           
        </div>
    </section>



     <!-- FOOTER  -->


     <?php
      include("footer.php");
     ?>

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
