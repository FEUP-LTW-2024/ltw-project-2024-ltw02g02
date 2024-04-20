<?php

// Verifica se o username já existe
function userExists($username) {
    $dbh = new PDO('sqlite:database.db');
    $stmt = $dbh->prepare("SELECT * FROM Users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    return $stmt->fetch() !== false;
}

// Verifica se o email já existe
function emailExists($email) {
    $dbh = new PDO('sqlite:database.db');
    $stmt = $dbh->prepare("SELECT * FROM Users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    return $stmt->fetch() !== false;
}

// Atribuir valores aos parâmetros
$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

if (userExists($username))
    die("Usuário já existe!");

if (emailExists($email))
    die("Email já existe!");

// Verifica se password é igual à confirmação de password
if ($_POST['password'] !== $_POST['confirm_password'])
    die("As senhas não coincidem!");

// Se tudo estiver certo, podemos fazer a conexão com a base de dados
$dbh = new PDO('sqlite:database.db');

// Prepara a query
$stmt = $dbh->prepare("INSERT INTO Users (username, email, password) VALUES (:username, :email, :password)");

// Vincular os parâmetros
$stmt->bindParam(':username', $username);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':password', $password);

// Executar a query
$stmt->execute();

if ($stmt->rowCount() > 0) {
echo "Usuário registrado com sucesso!";
}

else {
    echo "Método de requisição inválido.";
}

?>