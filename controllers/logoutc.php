<?php
    session_start();

    if($_SESSION['is_admin'] === true){
        unset($_SESSION['is_admin']);
        unset($_SESSION['is_login']);
        unset($_SESSION["user_id"]);
        unset($_SESSION["name"]);
        unset($_SESSION["username"]);
        unset($_SESSION["email"]);
        unset($_SESSION["phone_number"]);
        header("Location: ../index.php");
    }else if($_SESSION['is_login'] === true){
        unset($_SESSION['is_login']);
        unset($_SESSION["user_id"]);
        unset($_SESSION["name"]);
        unset($_SESSION["username"]);
        unset($_SESSION["email"]);
        unset($_SESSION["phone_number"]);
        header("Location: ../index.php");
    }else{
        header("Location: ../index.php");
    }