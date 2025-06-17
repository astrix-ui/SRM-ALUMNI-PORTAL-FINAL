<?php session_start(); include("dbconfig.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Search Users | SRM Alumni</title>
  <link rel="stylesheet" href="../css/searchPage.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet" />
</head>
<body>

<?php include("nav.php"); ?>

<section class="search-section">
  <div class="search-container">
    <h1>Search for Alumni</h1>
    <p>Quickly find and connect with alumni across the globe. Filter by batches, industries, or locations to grow your network effortlessly.</p>
    <div class="search-bar">
      <label for="search-input">Look For</label>
      <div class="vertical-line"></div>
      <input type="text" id="search-input" placeholder="Search for the Alumni's Name" onkeyup="searchUsername()" />
      <button type="submit"><img src="../assets/search.png" alt="Search Icon" /></button>
    </div>
  </div>
</section>

<section class="search-results">
  <div class="results-header">
    <h1>Search Results</h1>
    <div class="filters">
      <span>Filters:</span>

     <select id="filter-batch" onchange="searchUsername()">
  <option value="">Batch</option>
  <?php
    $batch_query = mysqli_query($conn, "SELECT DISTINCT batch FROM user WHERE batch IS NOT NULL AND batch != '' ORDER BY batch DESC");
    while ($row = mysqli_fetch_assoc($batch_query)) {
      echo '<option value="' . htmlspecialchars($row['batch']) . '">' . htmlspecialchars($row['batch']) . '</option>';
    }
  ?>
</select>

<!-- Degree Dropdown -->
<select id="filter-degree" onchange="searchUsername()">
  <option value="">Degree</option>
  <?php
    $degree_query = mysqli_query($conn, "SELECT DISTINCT degree FROM user WHERE degree IS NOT NULL AND degree != '' ORDER BY degree");
    while ($row = mysqli_fetch_assoc($degree_query)) {
      echo '<option value="' . htmlspecialchars($row['degree']) . '">' . htmlspecialchars($row['degree']) . '</option>';
    }
  ?>
</select>

<!-- Location Dropdown -->
<select id="filter-location" onchange="searchUsername()">
  <option value="">Location</option>
  <?php
    $location_query = mysqli_query($conn, "SELECT DISTINCT CONCAT(city, ', ', country) AS location FROM user WHERE city IS NOT NULL AND city != '' AND country IS NOT NULL AND country != '' ORDER BY location");
    while ($row = mysqli_fetch_assoc($location_query)) {
      echo '<option value="' . htmlspecialchars($row['location']) . '">' . htmlspecialchars($row['location']) . '</option>';
    }
  ?>
</select>

<!-- Occupation Dropdown -->
<select id="filter-occupation" onchange="searchUsername()">
  <option value="">Occupation</option>
  <?php
    $occ_query = mysqli_query($conn, "SELECT DISTINCT occupation FROM user WHERE occupation IS NOT NULL AND occupation != '' ORDER BY occupation");
    while ($row = mysqli_fetch_assoc($occ_query)) {
      echo '<option value="' . htmlspecialchars($row['occupation']) . '">' . htmlspecialchars($row['occupation']) . '</option>';
    }
  ?>
</select>

    </div>
  </div>
</section>

<div class="profile-container"></div>

<section class="pagination-section">
  <div class="pagination" style="display: none;"></div>
</section>

<?php include("footer.php"); ?>

<script>
function searchUsername(page = 1) {
  const query = document.getElementById('search-input').value.trim();
  const batch = document.getElementById('filter-batch').value;
  const degree = document.getElementById('filter-degree').value;
  const location = document.getElementById('filter-location').value;
  const occupation = document.getElementById('filter-occupation').value;

  // ✅ Prevent empty search from triggering backend
  if (!query && !batch && !degree && !location && !occupation) {
    document.querySelector('.profile-container').innerHTML = "";
    document.querySelector(".pagination").style.display = "none";
    return;
  }

  const params = new URLSearchParams({
    query, batch, degree, location, occupation, page
  });

  fetch(`search_backend.php?${params.toString()}`)
    .then(response => response.json())
    .then(data => {
      document.querySelector('.profile-container').innerHTML = data.html;

      const pagination = document.querySelector(".pagination");
      pagination.innerHTML = "";
      pagination.style.display = data.pages > 1 ? "flex" : "none";

      for (let i = 1; i <= data.pages; i++) {
        const btn = document.createElement("button");
        btn.className = "page" + (i === page ? " active" : "");
        btn.textContent = i;
        btn.onclick = () => searchUsername(i);
        pagination.appendChild(btn);
      }
    })
    .catch(err => {
      console.error("Search error:", err);
    });
}
</script>

</body>
</html>
