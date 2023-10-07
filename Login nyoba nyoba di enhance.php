<?php
session_start();

// Implementing anti-bruteforce measures - locking out after multiple failed login attempts
$maxLoginAttempts = 3;
if (isset($_SESSION['login_attempts']) && $_SESSION['login_attempts'] >= $maxLoginAttempts) {
    die("Too many failed login attempts. Please try again later.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');

    // Add your authentication logic here, kek validate credentials against a database
    $authenticated = validateCredentials($username, $password);

    if ($authenticated) {
        // Successful login
        $_SESSION['is_login'] = true;
        // Reset login attempts
        unset($_SESSION['login_attempts']);
        header("Location: dashboard.php"); // Redirect to a dashboard or home page
        exit();
    } else {
        // Failed login attempt
        if (isset($_SESSION['login_attempts'])) {
            $_SESSION['login_attempts']++;
        } else {
            $_SESSION['login_attempts'] = 1;
        }
        // You may log the failed attempt for auditing purposes
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<!--login html disini -->
</html>