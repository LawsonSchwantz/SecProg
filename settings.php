<?php

session_start();
require_once(__DIR__ . '/controllers/connection.php');

if ($connection->error) {
    die($connection->error);
}

if (!isset($_SESSION['is_login']) || $_SESSION['is_login'] !== true) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

function updateEmail($user_id, $new_email, $connection) {
    $update_email_sql = $connection->prepare("UPDATE users SET email = ? WHERE user_id = ?");
    $update_email_sql->bind_param("si", $new_email, $user_id);
    if ($update_email_sql->execute()) {
        $update_email_sql->close();
        return "Email berhasil diubah.";
    } else {
        return "Gagal mengubah email.";
    }
}

function gantiUsername($user_id, $new_username, $connection) {
    $update_username_sql = $connection->prepare("UPDATE users SET username = ? WHERE user_id = ?");
    $update_username_sql->bind_param("si", $new_username, $user_id);
    if ($update_username_sql->execute()) {
        $update_username_sql->close();
        return "Username berhasil diubah. ";
    } else {
        return "Gagal mengubah username. ";
    }
}

function gantiPassword($user_id, $new_password, $connection) {
    $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);
    $update_password_sql = $connection->prepare("UPDATE users SET password = ? WHERE user_id = ?");
    $update_password_sql->bind_param("si", $new_password_hash, $user_id);
    if ($update_password_sql->execute()) {
        $update_password_sql->close();
        return "Password berhasil diubah. ";
    } else {
        return "Gagal mengubah password. ";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pesan = gantiUsername($user_id, $_POST['new_username'], $connection);
    echo $pesan;

    $new_password = $_POST['new_password'];
    $pesan = gantiPassword($user_id, $new_password, $connection);
    echo $pesan;

    $new_email = $_POST['new_email'];
    $pesan = updateEmail($user_id, $new_email, $connection);
    echo $pesan;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile Settings</title>
</head>
<body>
    <h1>Profile Settings</h1>
    <form method="post" enctype="multipart/form-data">
        <label for="new_username">New Username:</label>
        <input type="text" name="new_username" id="new_username">
        <br>
        <label for="new_password">New Password:</label>
        <input type="password" name="new_password" id="new_password">
        <br>
        <label for="new_email">New Email:</label>
        <input type="email" name="new_email" id="new_email">
        <br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
