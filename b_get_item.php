<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('HTTP/1.1 405 Method Not Allowed');
    exit('Invalid request method.');
}

include 'db.php';
header('Content-Type: application/json');

$id = $_POST['id'];
$sql = $conn->prepare('
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
WHERE menu.id = ?');
$sql->bind_param('i', $id);
$sql->execute();
$result = $sql->get_result();

$row = $result->fetch_assoc();

$data = [];
$data[] = $row;
$response = [
    'success' => true,
    'data' => $data
];
echo json_encode($response);
exit;