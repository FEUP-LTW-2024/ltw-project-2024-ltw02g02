<?php

$dbh = new PDO('sqlite:../database.db');
require_once(__DIR__ . '/data_fetch.php');

// Atribuir valores aos parâmetros
$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$confirm_password = $_POST['confirm_password'];

if (userExists($username)) {
    $errorMessage = "Username already in use!";
    header("Location: signup.html?error=" . urlencode($errorMessage));
    exit;
}

if (emailExists($email)) {
    $errorMessage = "E-Mail already in use!";
    header("Location: signup.html?error=" . urlencode($errorMessage));
    exit;
}

if ($_POST['password'] !== $confirm_password) {
    $errorMessage = "Passwords do not match!";
    header("Location: signup.html?error=" . urlencode($errorMessage));
    exit;
}

// Se tudo estiver certo, podemos fazer a conexão com a base de dados
$dbh = new PDO('sqlite:../database.db');

// Prepara a query
$stmt = $dbh->prepare("INSERT INTO Users (username, email, password) VALUES (:username, :email, :password)");

// Vincular os parâmetros
$stmt->bindParam(':username', $username);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':password', $password);

// Executar a query
$result = $stmt->execute();

if ($result) {
    header("Location: ../pages/login.php");
    exit;
} else {
    $errorMessage = "Error signing up!";
    header("Location: ../pages/signup.php?error=" . urlencode($errorMessage));
    exit;
}

?>
