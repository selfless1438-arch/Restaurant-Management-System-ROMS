<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('HTTP/1.1 405 Method Not Allowed');
    exit('Invalid request method.');
}

include 'db.php';
header('Content-Type: application/json');

$response = [
    'success' => false,
    'message' => 'Something went wrong.'
];

// ===========================
// Get POST Data
// ===========================
$id = intval($_POST['id']);
$name = trim($_POST['name']);
$category = trim($_POST['category']);
$price = trim($_POST['price']);
$status = trim($_POST['status']);
$description = trim($_POST['description']);

// ===========================
// Get Category ID
// ===========================
$stmt = $conn->prepare("SELECT id FROM categories WHERE name = ?");
$stmt->bind_param("s", $category);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    $response['message'] = "Category not found.";
    echo json_encode($response);
    exit;
}

$category_id = $result->fetch_assoc()['id'];

// ===========================
// Check if image uploaded
// ===========================
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {

    // Get old image
    $old = $conn->prepare("SELECT image_path FROM menu WHERE id = ?");
    $old->bind_param("i", $id);
    $old->execute();

    $oldImage = $old->get_result()->fetch_assoc();

    // Delete old image
    if ($oldImage && file_exists($oldImage['image_path'])) {
        unlink($oldImage['image_path']);
    }

    // Upload new image
    $uploadDir = "item_thumbnails/";
    $fileName = time() . "_" . basename($_FILES['image']['name']);
    $filePath = $uploadDir . $fileName;

    if (!move_uploaded_file($_FILES['image']['tmp_name'], $filePath)) {
        $response['message'] = "Failed to upload image.";
        echo json_encode($response);
        exit;
    }

    // Update including image
    $sql = $conn->prepare("
        UPDATE menu
        SET
            category_id = ?,
            food_name = ?,
            description = ?,
            price = ?,
            image_path = ?,
            status = ?
        WHERE id = ?
    ");

    $sql->bind_param(
        "issdssi",
        $category_id,
        $name,
        $description,
        $price,
        $filePath,
        $status,
        $id
    );

} else {

    // Update without image
    $sql = $conn->prepare("
        UPDATE menu
        SET
            category_id = ?,
            food_name = ?,
            description = ?,
            price = ?,
            status = ?
        WHERE id = ?
    ");

    $sql->bind_param(
        "issdsi",
        $category_id,
        $name,
        $description,
        $price,
        $status,
        $id
    );
}

// ===========================
// Execute
// ===========================
if ($sql->execute()) {

    $response['success'] = true;
    $response['message'] = "Item updated successfully.";

} else {

    $response['message'] = $sql->error;
}

echo json_encode($response);

$conn->close();
exit;