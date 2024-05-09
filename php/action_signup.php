<?php

// Verifica se o username já existe
function userExists($username) {
    $dbh = new PDO('sqlite:../database.db');
    $stmt = $dbh->prepare("SELECT * FROM Users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    return $stmt->fetch() !== false;
}

// Verifica se o email já existe
function emailExists($email) {
    $dbh = new PDO('sqlite:../database.db');
    $stmt = $dbh->prepare("SELECT * FROM Users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    return $stmt->fetch() !== false;
}

// Atribuir valores aos parâmetros
$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$confirm_password = $_POST['confirm_password'];

if (userExists($username)) {
    $errorMessage = "Usuário já existe!";
    header("Location: signup.html?error=" . urlencode($errorMessage));
    exit;
}

if (emailExists($email)) {
    $errorMessage = "Email já existe!";
    header("Location: signup.html?error=" . urlencode($errorMessage));
    exit;
}

if ($_POST['password'] !== $confirm_password) {
    $errorMessage = "As passwords não coincidem!";
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
    $errorMessage = "Erro ao registrar!";
    header("Location: ../pages/signup.php?error=" . urlencode($errorMessage));
    exit;
}

?>
