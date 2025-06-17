<?php
session_start();
include("dbconfig.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Events | SRM Alumni</title>
    <link rel="stylesheet" href="../css/eventspage.css" />
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
        <h1>Discover our Alumni Events</h1>
        <p>
            Discover our alumni events: connect, celebrate, network, grow, reunite, inspire.
        </p>
       
      </div>
    </section>
    
    
    <!-- EVENTS SECTION   -->
    
    
    <section class="events-section">
         <?php


$get_event="SELECT * FROM event ORDER BY event_id DESC ";
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
            <button style="
                background: transparent; cursor:pointer;
            "><span style="
                margin-top: 12px;
                font-size: 0.8rem;
                color: #555;
                font-style: italic;
            " class="author">~ Author</span></button>
                <h3>' . $title . '</h3>
                <p>' . $description . '</p>
            </div>
        </div>';
    }
    echo '</div>';
} else {
    echo '<div class="no-events" style="
    margin-top: 200px;
    font-size: 1.5em;
    text-align: center;
    font-weight: 600;
    color: #555555;
">No events available.</div>';

}
?>
    </section>


   

     <!-- FOOTER  -->


    <?php
   include("footer.php");
    ?>
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
