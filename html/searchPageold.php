<?php session_start(); ?>
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
        <input type="text" id="search-input" name="search_input" placeholder="Search for the Alumni's Name" onkeyup="searchUsername()" />
        <button type="submit"><img src="../assets/search.png" alt="Search Icon" /></button>
      </div>
    </div>
  </section>

  <h2 class="error-msg">No results found</h2>

  <section class="search-results">
    <div class="results-header">
      <h1>Search Results</h1>
      <div class="filters">
        <span>Filters:</span>
        <select><option>Batch</option></select>
        <select><option>Degree</option></select>
        <select><option>Location</option></select>
        <select><option>Occupation</option></select>
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

  if (!query) {
    document.querySelector('.profile-container').innerHTML = '';
    document.querySelector('.pagination').style.display = 'none';
    return;
  }

  fetch(`search_backend.php?query=${encodeURIComponent(query)}&page=${page}`)
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
