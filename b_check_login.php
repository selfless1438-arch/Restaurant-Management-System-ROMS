<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('HTTP/1.1 405 Method Not Allowed');
    exit('Invalid request method.');
}
include 'db.php';
header('Content-Type: application/json');
session_start();

$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $conn->prepare('SELECT * FROM users WHERE email = ?');
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        $_SESSION['roms_loged'] = true;
        $_SESSION['email'] = $email;
        $dtime = date('d-m-Y H:i:s');
        $sql = $conn->prepare('UPDATE users SET last_login = ? WHERE email = ? ');
        $sql->bind_param('ss', $dtime, $email);
        $sql->execute();
        echo json_encode(['success' => true, 'message' => 'User Verified']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Wrong Password']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'User Does Not Exist']);
}

exit;
