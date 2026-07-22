<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('HTTP/1.1 405 Method Not Allowed');
    exit('Invalid request method.');
}
include 'db.php';
header('Content-Type: application/json');
$response = [
    'success' => false,
    'message' => 'Something Went Wrong',
];
$title = $_POST['title'];
$description = $_POST['description'];

$stmt = $conn->prepare('INSERT INTO categories (name , description) VALUES (?,?)');
$stmt->bind_param('ss', $title, $description);
if ($stmt->execute()) {
    $response['success'] = true;
    echo json_encode($response);
} else {
    echo json_encode(['success' => false, 'message' => 'Something Went Wrong']);
}
exit;
