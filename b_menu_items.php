<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Invalid request method.');
}

include 'db.php';
header('Content-Type: application/json');

$response = [
    "success" => false,
    "message" => "",
    "counts" => [],
    "data" => []
];

// =======================
// Get Filters
// =======================
$search = trim($_POST['search'] ?? '');
$status = trim($_POST['status'] ?? 'All');
$category = trim($_POST['category'] ?? 'All');

// =======================
// Get Counts
// =======================
$countQuery = "
SELECT COUNT(*) AS totalItems, SUM(CASE WHEN status = 'Available' THEN 1 ELSE 0 END) AS availableItems FROM menu";

$countResult = $conn->query($countQuery);

if ($countResult) {
    $response['counts'] = $countResult->fetch_assoc();
}

// =======================
// Build Query
// =======================
$query = "
SELECT
    menu.id,
    menu.food_name,
    menu.description,
    menu.price,
    menu.image_path,
    menu.status,
    menu.category_id,
    categories.name AS category_name
FROM menu
LEFT JOIN categories
    ON menu.category_id = categories.id
WHERE 1
";

$params = [];
$types = "";

// Search
if ($search !== "") {
    $query .= " AND menu.food_name LIKE ?";
    $params[] = "%{$search}%";
    $types .= "s";
}

// Status
if (strtolower($status) !== "all") {
    $query .= " AND menu.status = ?";
    $params[] = $status;
    $types .= "s";
}

// Category
if (strtolower($category) !== "all") {
    $query .= " AND categories.name = ?";
    $params[] = $category;
    $types .= "s";
}

$query .= " ORDER BY menu.id DESC";

// =======================
// Execute Query
// =======================
$stmt = $conn->prepare($query);

if (!$stmt) {
    $response['message'] = $conn->error;
    echo json_encode($response);
    exit;
}

if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

if (!$stmt->execute()) {
    $response['message'] = $stmt->error;
    echo json_encode($response);
    exit;
}

$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $response['data'][] = $row;
}

$response['success'] = true;
$response['message'] = count($response['data']) > 0
    ? "Items fetched successfully."
    : "No items found.";

echo json_encode($response);

exit;
