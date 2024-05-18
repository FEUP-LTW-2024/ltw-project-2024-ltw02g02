<?php
session_start();

function emailExists($email) {
    $dbh = new PDO('sqlite:../database.db');
    $stmt = $dbh->prepare("SELECT * FROM Users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function correctPassword($user, $password) {
    return password_verify($password, $user['password']);
}

$email = $_POST['email'];
$password = $_POST['password'];

$user = emailExists($email);

if (!$user) {
    $errorMessage = "Email or password is incorrect!";
    header("Location: ../pages/login.php?error=" . urlencode($errorMessage));
    exit;
}

if (!correctPassword($user, $password)) {
    $errorMessage = "Email or password is incorrect!";
    header("Location: ../pages/login.php?error=" . urlencode($errorMessage));
    exit;
}

// Armazenando dados do usuário na sessão
$_SESSION['user_id'] = $user['user_id'];
$_SESSION['username'] = $user['username'];
$_SESSION['email'] = $user['email'];
$_SESSION['pfp_url'] = $user['pfp_url'];

header("Location: ../index.php");
exit;
?>
