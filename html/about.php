<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>About Us | SRM Alumni</title>
    <link rel="stylesheet" href="../css/about3.css" />
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
        <h1>Get to know About Us</h1>
        <p>
           The SRM Alumni Portal is a dedicated platform created to bridge the gap between SRM Institute of Science and Technology’s alumni and current students. Designed with the vision of fostering lifelong connections, this portal serves as a dynamic space where former and current members of the SRM community can engage, collaborate, and grow together. Whether you're a graduate looking to reconnect or a student seeking mentorship, this platform brings together generations of knowledge, experience, and opportunity.
<br><br>

At its core, the portal aims to strengthen the bond between alumni and students by facilitating meaningful interactions. Alumni can create detailed profiles showcasing their current workplaces, job roles, academic journey, achievements, and social profiles such as LinkedIn. This not only allows students to explore diverse career paths but also helps them seek guidance from professionals who once stood where they are today.
<br>

For students, the portal offers a valuable chance to network with industry professionals, gain insights into various fields, and receive mentorship or career advice directly from SRM graduates. Whether it's understanding the nuances of a particular role, preparing for higher studies, or looking for internship opportunities, students can reach out to alumni who are willing to offer their time, experience, and support.
<br>

The portal also acts as a hub for alumni-driven events such as webinars, guest lectures, workshops, and reunions. Alumni can post upcoming events, share announcements, or even organize virtual meetups. This fosters a strong sense of community and encourages alumni to stay actively involved in the development of the institution and its students.
<br><br>


Our platform is designed to be intuitive, accessible, and inclusive. It ensures verified user registration, with alumni and students having separate profiles and access rights. We prioritize security, data privacy, and authenticity, ensuring that every interaction on the platform is meaningful and trustworthy.


For the alumni, this portal is a way to give back to their alma mater. By sharing experiences, offering referrals, or providing mentorship, they contribute to shaping the next generation of SRM graduates. For the students, it opens a world of guidance, real-world perspectives, and networking opportunities that go beyond the classroom.
<br>
<br>

In an ever-changing academic and professional landscape, connections matter more than ever. The SRM Alumni Portal ensures that those connections don't fade with time—they grow stronger. It’s more than just a platform; it’s a living community of support, inspiration, and lifelong relationships.
<br>
<br>

Join us in building a vibrant ecosystem where SRMites support one another across batches, borders, and backgrounds. Together, we continue to learn, lead, and leave a legacy that inspires.
        </p>
       <div class="action-btn">

       <div class="action-btn"> <?php
                  if(!isset($_SESSION['user'])){
                  echo'<a href="signup.php" class="sec-btn" >Register Now</a>';}
                  else{}
                  ?>
        <a href="/html/searchPage.html" class="sec-btn">Discover Alumni</a>
       </div>
      </div>
    </section>


    
    
      <!-- TEAM SECTION   -->

    <section class="team-section">
      <H1>Meet our Team</H1>
        <div class="cards-container">
          <div class="card">
              <img src="../assets/sample2.png">
              <div class="card-content">
                  <a href="">
                      <h3>Aditya Dev Chand</h3>
                  </a>
                  <p>Backend & Database Developer</p>
              </div>
          </div>
            <div class="card">
                <!-- DC SET LIMIT OF CHARACTERS FOR EVENT DESCRIPTION TO ONLY 75 WORDS  -->
                <img src="../assets/sample2.png" >
                <div class="card-content">
                    <a href="">
                        <h3>Ayush Sharma</h3>
                    </a>
                    <p>Frontend Developer</p>
                </div>
            </div>
    
    
            <div class="card">
                <img src="../assets/sample2.png">
                <div class="card-content">
                    <a href="">
                        <h3>Aadya Jha</h3>
                    </a>
                    <p>UI/UX Designer</p>
                </div>
            </div>

            <div class="card">
                <img src="../assets/sample2.png">
                <div class="card-content">
                    <a href="">
                        <h3>Dr. Vinay Kumar Singhal</h3>
                    </a>
                    <p>Faculty In-Charge</p>
                </div>
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