<?php

function emailExists($email) {
    $dbh = new PDO('sqlite:database.db');
    $stmt = $dbh->prepare("SELECT * FROM Users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    return $stmt->fetch() !== false;
}

function correctPassword($email, $password) {
    $dbh = new PDO('sqlite:database.db');
    $stmt = $dbh->prepare("SELECT * FROM Users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch();
    return $user !== false && password_verify($password, $user['password']);
}

$email = $_POST['email'];
$password = $_POST['password'];

if (!emailExists($email)) {
    $errorMessage = "Email não existe!";
    header("Location: login.html?error=" . urlencode($errorMessage));
    exit;
}

if (!correctPassword($email, $password)) {
    $errorMessage = "Password incorreta!";
    header("Location: login.html?error=" . urlencode($errorMessage));
    exit;
}

session_start();
$_SESSION['email'] = $email;
header("Location: index.html");

?>