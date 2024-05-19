<?php
session_start();
$db = new PDO("sqlite:../database.db");

if (!isset($_SESSION['user_id']) || !isset($_POST['recipient_id']) || !isset($_POST['message'])) {
    header('Location: not_found.php');
    exit();
}

$sender_id = $_SESSION['user_id'];
$recipient_id = $_POST['recipient_id'];
$message = $_POST['message'];

$stmt = $db->prepare("INSERT INTO messages (sender_id, recipient_id, content) VALUES (:sender_id, :recipient_id, :content)");
$stmt->bindValue(':sender_id', $sender_id, PDO::PARAM_INT);
$stmt->bindValue(':recipient_id', $recipient_id, PDO::PARAM_INT);
$stmt->bindValue(':content', $message, PDO::PARAM_STR);
$stmt->execute();

header('Location: ../pages/messages.php?user=' . $recipient_id);
exit();

