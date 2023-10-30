<?php

session_start();
require_once(__DIR__ . '/controllers/connection.php');

if ($connection->error) {
    die($connection->error);
}

if ($_SESSION['is_login'] !== true) {
    header("Location: login.php");
}

$user_id = $_SESSION['user_id'];

function gantiFotoProfil($user_id, $connection) {
    if (isset($_FILES['image'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $update_image_sql = $connection->prepare("UPDATE users SET profile_image = ? WHERE id = ?");
            $update_image_sql->bind_param("si", $target_file, $user_id);
            $update_image_sql->execute();
            $update_image_sql->close();
            return "Foto profil berhasil diubah.";
        } else {
            return "Gagal mengunggah gambar.";
        }
    }
}


function gantiUsername($user_id, $new_username, $connection) {
    $update_username_sql = $connection->prepare("UPDATE users SET username = ? WHERE id = ?");
    $update_username_sql->bind_param("si", $new_username, $user_id);
    $update_username_sql->execute();
    $update_username_sql->close();
    return "Username berhasil diubah.";
}

function gantiPassword($user_id, $new_password, $connection) {
    $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);
    $update_password_sql = $connection->prepare("UPDATE users SET password = ? WHERE id = ?");
    $update_password_sql->bind_param("si", $new_password_hash, $user_id);
    $update_password_sql->execute();
    $update_password_sql->close();
    return "Password berhasil diubah.";
}

$get_user_sql = $connection->prepare("SELECT id, name, username, email, phone_number, password FROM users WHERE id = ?");
$get_user_sql->bind_param("i", $user_id);
$get_user_sql->execute();
$get_user_sql->bind_result($user_id, $name, $username, $email, $phone_number, $password);
$get_user_sql->fetch();
$get_user_sql->close();

$pesan = gantiFotoProfil($user_id, $connection);
echo $pesan;

$pesan = gantiUsername($user_id, "new_username", $connection);
echo $pesan;

$pesan = gantiPassword($user_id, "new_password", $connection);
echo $pesan;
?>