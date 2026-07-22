<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('HTTP/1.1 405 Method Not Allowed');
    exit('Invalid request method.');
}

include 'db.php';
header('Content-Type: application/json');

$response = [
    'success' => false,
    'message' => 'Something Went Wrong.'
];

// =====================
// Collect POST data
// =====================
$name = $_POST['name'];
$category = $_POST['category'];
$price = $_POST['price'];
$status = $_POST['status'];
$description = $_POST['description'];
$image = $_FILES['image'];

$uploadDir = "item_thumbnails/";
$fileName = time() . "_" . basename($image['name']); // ✅ CHANGED: Using $image variable instead of $_FILES again.
$filePath = $uploadDir . $fileName;

// =====================
// Check if category exists
// =====================
$stmt = $conn->prepare('SELECT id FROM categories WHERE name = ?'); // ✅ CHANGED: Only selecting id because that's all we need.

$stmt->bind_param('s', $category);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();
    $category_id = $row['id'];

    // =====================
    // Upload image
    // =====================
    if (move_uploaded_file($image['tmp_name'], $filePath)) { // ✅ CHANGED: Using $image variable.

        // =====================
        // Insert item
        // =====================
        $sql = $conn->prepare(
            'INSERT INTO menu
            (category_id, food_name, description, price, image_path, status)
            VALUES (?, ?, ?, ?, ?, ?)'
        );
        // ✅ ADDED: Check if prepare() failed.
        if (!$sql) {
            $response['message'] = $conn->error;
            echo json_encode($response);
            exit;
        }
        // ✅ CORRECT: 6 placeholders = 6 type specifiers.
        $sql->bind_param(
            'issdss',
            $category_id,
            $name,
            $description,
            $price,
            $filePath,
            $status
        );
        if ($sql->execute()) {
            $response['success'] = true;
            $response['message'] = 'Item Added Successfully';
        } else {
            // ✅ CHANGED: Return actual SQL error for debugging.
            $response['message'] = $sql->error;
        }
    } else {
        // ✅ CHANGED: More descriptive error.
        $response['message'] = 'Failed to upload image.';
    }
} else {
    // ✅ CHANGED: Corrected grammar.
    $response['message'] = 'Category not found.';
}

// ✅ CHANGED: Output JSON only once.
echo json_encode($response);
exit;