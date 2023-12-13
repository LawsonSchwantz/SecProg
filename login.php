<?php
    function generateCSRFToken() {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }
    generateCSRFToken();
    session_start();
    if(isset($_SESSION['regist_successful'])) {
        echo $_SESSION['regist_successful'];
        unset($_SESSION['regist_successful']);
    }
    if($_SESSION['is_login'] === true){
        header("Location: ../index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form action="controllers/loginc.php" method="POST">
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>" />
    <div class="form-group">
        <label for="">Username</label>
        <input type="text" name="username">
    </div>
    <div class="form-group">
        <label for="">Password</label>
        <input type="password" name="password">
    </div>
    <button name="login">Login</button>
    <br>
    <a href="register.php" class="pull-right">Don't Have Account? Register First</a>
    </form>

<?php
if(isset($_SESSION['login_failed'])) {
    echo $_SESSION['login_failed'];
    unset($_SESSION['login_failed']);
}
?>