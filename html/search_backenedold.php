<?php
include("dbconfig.php");

if (isset($_GET['query'])) {
    $searchedUsername = $_GET['query'];
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $limit = 10;
    $offset = ($page - 1) * $limit;

    $words = explode(" ", $searchedUsername);
    $conditions = [];
    foreach ($words as $word) {
        $safe_word = mysqli_real_escape_string($conn, $word);
        $conditions[] = "name LIKE '%$safe_word%'";
    }
    $whereClause = implode(" OR ", $conditions);

    // Count total
    $countQuery = "SELECT COUNT(*) as total FROM user WHERE $whereClause";
    $countResult = mysqli_query($conn, $countQuery);
    $total = mysqli_fetch_assoc($countResult)['total'];
    $totalPages = ceil($total / $limit);

    // Fetch paginated results
    $searchQuery = "SELECT * FROM user WHERE $whereClause LIMIT $limit OFFSET $offset";
    $result = mysqli_query($conn, $searchQuery);

    $response = [
        "html" => "",
        "pages" => $totalPages
    ];

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $response["html"] .= '<div class="profile-card">';
            $response["html"] .= '<div class="profile-left-section">
                    <div class="profile-image"></div>
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
            $response["html"] .= '<button class="view-profile">View Profile</button>
                </div>
              </div>';
        }
    } else {
        $response["html"] = '<div class="profile-card"><h2>No results found</h2></div>';
    }

    echo json_encode($response);
}
