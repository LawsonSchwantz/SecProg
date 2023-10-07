<?php
session_start();

// Anti-CSRF token generation and validation
function generateCSRFToken() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function validateCSRFToken($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['csrf_token']) && validateCSRFToken($_POST['csrf_token'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmpassword'];

    // Add your validation logic here ( sekelas password complexity, email uniqueness)

    if (registrationIsValid($email, $username, $password, $confirmPassword)) {
        // Registration kalo valid, proceed with user registration
        // Hash and securely store the password in the database
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        
        // Add your user registration logic here
        // After successful registration, move ke login page
    } else {
        // Registration kalo gak valid, show an error message to the user
    }
}


function registrationIsValid($email, $username, $password, $confirmPassword) {
    // Implement your custom validation logic here
    // Return true if all validation checks pass, otherwise return false
    return (
        filter_var($email, FILTER_VALIDATE_EMAIL) !== false &&
        !empty($username) &&
        strlen($password) >= 8 && // Example: Password should be at least 8 characters long
        $password === $confirmPassword // Password and confirm password should match
    );
}

// Generate a new CSRF token for the form
$csrfToken = generateCSRFToken();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Register</h1>
        <form action="register.php" method="POST">
            <input type="hidden" name="csrf_token" value="<?php echo $csrfToken; ?>" />

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="confirmpassword">Confirm Password</label>
                <input type="password" id="confirmpassword" name="confirmpassword" required>
            </div>

            <button type="submit" name="register">Register</button>
        </form>
        <br>
        <a href="login.php" class="pull-right">Already Have an Account? Login Now</a>
    </div>
</body>
</html>