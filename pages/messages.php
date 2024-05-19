<?php
session_start();
$db = new PDO("sqlite:../database.db");
require_once(__DIR__ . '/../php/navbar.tpl.php');
require_once(__DIR__ . '/../php/data_fetch.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$contact_id = isset($_GET['user']) ? $_GET['user'] : null;

$contacts = fetchContacts($db, $user_id);
$messages = $contact_id ? fetchMessages($db, $user_id, $contact_id) : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Messages</title>
    <link rel="stylesheet" href="../css/messages-style.css">
    <link rel="stylesheet" href="../css/navbar-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
</head>
<body>
<?php drawNavbar($db) ?>
<main>
    <div class="message-container">
        <div class="contacts">
            <ul>
                <?php foreach ($contacts as $contact): ?>
                    <li>
                        <a href="messages.php?user=<?= htmlspecialchars($contact['user_id']) ?>">
                            <img src="<?= htmlspecialchars($contact['pfp_url']) ?>" alt="Profile Picture">
                            <?= htmlspecialchars($contact['username']) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="chat">
            <?php if ($contact_id): ?>
                <?php foreach ($messages as $message): ?>
                    <div class="message <?= $message['sender_id'] == $user_id ? 'sent' : 'received' ?>">
                        <p><?= htmlspecialchars($message['content']) ?></p>
                    </div>
                <?php endforeach; ?>
                <form action="../php/send_message.php" method="POST">
                    <input type="hidden" name="recipient_id" value="<?= htmlspecialchars($contact_id) ?>">
                    <textarea name="message" placeholder="Type your message..."></textarea>
                    <button type="submit">Send</button>
                </form>
            <?php else: ?>
                <p>Select a contact to start chatting</p>
            <?php endif; ?>
        </div>
    </div>
</main>
</body>
</html>
