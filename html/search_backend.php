<?php
 if (session_status() == PHP_SESSION_NONE) {
                        session_start();
                    }
include("dbconfig.php");
if (!isset($_SESSION['user'])) {
    // Redirect to the login page or handle the error appropriately
    header("location:login.php");
    exit;
}
if(isset($_GET['query'])){
$searchedUsername = $_GET['query'] ?? '';
$batch = $_GET['batch'] ?? '';
$degree = $_GET['degree'] ?? '';
$location = $_GET['location'] ?? '';
$occupation = $_GET['occupation'] ?? '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$limit = 10;
$offset = ($page - 1) * $limit;

$conditions = [];

// Search query
if (!empty($searchedUsername)) {
    $words = explode(" ", $searchedUsername);
    $searchParts = [];
    foreach ($words as $word) {
        $safe = mysqli_real_escape_string($conn, $word);
        $searchParts[] = "name LIKE '%$safe%'";
    }
    $conditions[] = '(' . implode(" OR ", $searchParts) . ')';
}

// Filters
if (!empty($batch)) {
    $safe = mysqli_real_escape_string($conn, $batch);
    $conditions[] = "batch = '$safe'";
}
if (!empty($degree)) {
    $safe = mysqli_real_escape_string($conn, $degree);
    $conditions[] = "degree = '$safe'";
}
if (!empty($location)) {
    $parts = explode(",", $location);
    $city = mysqli_real_escape_string($conn, trim($parts[0]));
    $country = isset($parts[1]) ? mysqli_real_escape_string($conn, trim($parts[1])) : '';
    if ($city && $country) {
        $conditions[] = "(city = '$city' AND country = '$country')";
    }
}
if (!empty($occupation)) {
    $safe = mysqli_real_escape_string($conn, $occupation);
    $conditions[] = "occupation = '$safe'";
}

// Build WHERE clause
$where = count($conditions) ? 'WHERE ' . implode(' AND ', $conditions) : '';

// Count total results
$countQuery = "SELECT COUNT(*) AS total FROM user $where";
$countResult = mysqli_query($conn, $countQuery);
$total = mysqli_fetch_assoc($countResult)['total'];
$totalPages = ceil($total / $limit);

// Fetch paginated results
$query = "SELECT * FROM user $where LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $query);

$response = [
    "html" => "",
    "pages" => $totalPages
];

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $response["html"] .= '<div class="profile-card">';
        $response["html"] .= '<div class="profile-left-section">
                <div class="profile-image"><img src="/alumni/assets/avatar.png" alt=""></div>
                <div class="profile-name">
                  <h2>' . htmlspecialchars($row["name"]) . '</h2>';
        if ($row["designation"] || $row["organization"]) {
            $response["html"] .= '<p><span id="position">' . htmlspecialchars($row["designation"]) . ', </span>' . htmlspecialchars($row["organization"]) . '</p>';
        }
        $response["html"] .= '</div>
            </div>
            <div class="profile-details">
                <p>' . htmlspecialchars($row["degree"]) . ', ' . htmlspecialchars($row["specialization"]) . '</p>
                <p>' . htmlspecialchars($row["batch"]) . '</p>';
        if ($row["city"] || $row["country"]) {
            $response["html"] .= '<p>' . htmlspecialchars($row["city"]) . ', ' . htmlspecialchars($row["country"]) . '</p>';
        }
        $name=$row['name'];
        $user_id=$row['user_id'];
        if(isset($_SESSION['user']) && $_SESSION['user']==$row['email']){
          $response["html"] .= '<form action="profile.php" method="POST">
  <button  class="view-profile" type="submit">View Profile</button>
</form>
</div>
 </div>';
        }
        else{
$response["html"] .= '<form action="showprofile.php?name='.  urlencode($name) .' " method="POST">
  <input type="hidden" name="user_id" value="'. $user_id .'">
  <button  class="view-profile" type="submit">View Profile</button>
</form>
</div>


          </div>';
    }
}} else {
    $response["html"] = '<div class="profile-card"><h2>No results found</h2></div>';
}

echo json_encode($response);
}
else{
    header("location:searchpage.php");
}