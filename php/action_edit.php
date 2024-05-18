<?php
session_start();

require_once(__DIR__ . '/data_fetch.php');
$db = new PDO('sqlite:../database.db');

function editUsername ($db, $user_id) {
    $username = $_POST["username"];
    if (userExists($username)) {
        $errorMessage = "Username already in use!";
        header('Location: ../pages/edit.php?error=' . urlencode($errorMessage));
        exit;
    } else {
        $stmt = $db->prepare('UPDATE Users SET username = :new_username WHERE user_id = :user_id');
        $stmt->bindParam(':new_username', $username);
        $stmt->bindParam(':user_id', $user_id);
        $result = $stmt->execute();
        if(!$result) {
            $errorMessage = 'Failed updating username!';
            header('Location: ../pages/edit.php?error=' . urlencode($errorMessage));
            exit;
        }
        $_SESSION['username'] = $username;
    }
}

function editEmail ($db, $user_id) {
    $email = $_POST["email"];
    if (emailExists($email)) {
        $errorMessage = "Email already in use!";
        header('Location: ../pages/edit.php?error=' . urlencode($errorMessage));
        exit;
    } else {
        $stmt = $db->prepare('UPDATE Users SET email = :new_email WHERE user_id = :user_id');
        $stmt->bindParam(':new_email', $email);
        $stmt->bindParam(':user_id', $user_id);
        $result = $stmt->execute();
        if(!$result) {
            $errorMessage = 'Failed updating email!';
            header('Location: ../pages/edit.php?error=' . urlencode($errorMessage));
            exit;
        }
        $_SESSION['email'] = $email;
    }
}

function editPassword ($db, $user_id) {
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if($password !== $confirm_password) {
        $errorMessage = 'Passwords do not match!';
        header('Location: ../pages/edit.php?error=' . urlencode($errorMessage));
        exit;
    }

    $new_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $db->prepare('UPDATE Users SET password = :new_password WHERE user_id = :user_id');
    $stmt->bindParam(':new_password', $new_password);
    $stmt->bindParam(':user_id', $user_id);
    $result = $stmt->execute();
    if(!$result) {
        $errorMessage = 'Failed updating password!';
        header('Location: ../pages/edit.php?error=' . urlencode($errorMessage));
        exit;
    }
}

function editPFP ($db, $user_id) {
    $folder = '../images/user-pfps/';

    $file_name = $_FILES['new_pfp']['name'];
    $tmp_name = $_FILES['new_pfp']['tmp_name'];

    $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $new_file_name = uniqid() . 'U' . $user_id . '.' . $file_extension;
    $new_file_path = $folder . $new_file_name;
    move_uploaded_file($tmp_name, $new_file_path);

    $stmt = $db->prepare('UPDATE Users SET pfp_url = :new_pfp_url WHERE user_id = :user_id');
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':new_pfp_url', $new_file_path);
    $result = $stmt->execute();

    if (!$result) {
        $errorMessage = "Error adding image!";
        header("Location: ../pages/edit.php?error=" . urlencode($errorMessage));
    }

    $_SESSION['pfp_url'] = $new_file_path;
}

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    if (isset($_POST['username'])) {
        if (!empty(trim($_POST['username']))) {
            editUsername($db, $user_id);
        }
    }

    if (isset($_POST['email'])) {
        if (!empty(trim($_POST['email']))) {
            editEmail($db, $user_id);
        }
    }

    if (isset($_POST['password']) and isset($_POST['confirm_password'])) {
        if (!empty(trim($_POST['password']))) {
            editPassword($db, $user_id);
        }
    }

    if (isset($_FILES['new_pfp'])) {
        editPFP($db, $user_id);
        header('Location: ../pages/edit.php');
        exit;
    }
}

header('Location: ../pages/profile.php?user=' . $_SESSION['user_id']);

