<?php
    session_start();
    require_once(__DIR__ . '/connection.php');
    if($_SESSION['is_admin'] === true || $_SESSION['is_login'] === true){
        $username = $_SESSION['username'];
        $login_status = FALSE;
        $stmt = $connection->prepare("UPDATE user_sessions SET login_status = ?, user_agent = NULL WHERE username = ? ");
        $stmt->bind_param("ss", $login_status, $username);
        $stmt->execute();
        $connection->close();
        
        session_unset();
        session_destroy();
        session_regenerate_id(true);
        header("Location: ../index.php");
    }else{
        header("Location: ../index.php");
    }