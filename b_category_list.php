<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('HTTP/1.1 405 Method Not Allowed');
    exit('Invalid request method.');
}

include 'db.php';
header('Content-Type: application/json');

$search = $_POST['search'] ?? '';
$like_search = "%{$search}%";

$sql = $conn->prepare("
    SELECT
        c.id,
        c.name,
        c.description,
        COUNT(m.id) AS items
    FROM categories c
    LEFT JOIN menu m
        ON c.id = m.category_id
    WHERE c.name LIKE ?
    GROUP BY c.id, c.name, c.description
    ORDER BY c.id DESC
");

$sql->bind_param("s", $like_search);
$sql->execute();

$result = $sql->get_result();

$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = [
        'id' => $row['id'],
        'name' => $row['name'],
        'description' => $row['description'],
        'items' => $row['items']
    ];
}

echo json_encode([
    'success' => true,
    'data' => $data
]);
