<?php
    session_start();

    if(isset($_SESSION['is_login'])){
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