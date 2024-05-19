<?php
session_start();
if (!isset($_SESSION['user_id']) || !isset($_GET['user'])) {
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

$user_id = $_SESSION['user_id'];
$recipient_id = $_GET['user'];

$db = new PDO('sqlite:../database.db');
$stmt = $db->prepare('SELECT * FROM Messages WHERE (sender_id = :user_id AND recipient_id = :recipient_id) OR (sender_id = :recipient_id AND recipient_id = :user_id) ORDER BY timestamp ASC');
$stmt->execute(['user_id' => $user_id, 'recipient_id' => $recipient_id]);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(['messages' => $messages, 'user_id' => $user_id]);
?>