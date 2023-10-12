<?php
    session_start();
    require_once(__DIR__ . '/connection.php');

    $maxLoginAttempts = 3;
    if (isset($_SESSION['login_attempts']) && $_SESSION['login_attempts'] >= $maxLoginAttempts) {
        die("Too many failed login attempts. Please try again later.");
    }
    function generateCSRFToken() {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }
    function validateCSRFToken($token) {
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['csrf_token']) && validateCSRFToken($_POST['csrf_token'])){
        $username = $_POST["username"];
        $password = $_POST["password"];
        $validate = 1;

        $username = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');

        if(strlen($username)==0){
            $validate=0;
            $error='Email cannot be empty!';
        }else if(strlen($password)==0){
            $validate=0;
            $error='Password Cannot be Empty!';
        }
        if ($connection->error){
            echo $connection->error;
        }
        else{
            if($validate==1){
                $result = $connection->query("SELECT * FROM users WHERE `username`='$username'");
                if($result->num_rows == 1){
                    $dataresult = $result->fetch_assoc();
                    if(password_verify($password,$dataresult["password"])){
                        unset($_SESSION['login_attempts']);
                        $_SESSION["is_login"] = true;
                        $_SESSION["username"] = $dataresult["username"];
                        $_SESSION["email"] = $dataresult["email"];
                        $_SESSION["id"] = $dataresult["id"];
                        $_SESSION["loggedin"] = "Welcome . $username";
                        header("Location: ../index.php");
                        die;
                    }else{
                        if (isset($_SESSION['login_attempts'])) {
                            $_SESSION['login_attempts']++;
                        } else {
                            $_SESSION['login_attempts'] = 1;
                        }
                        $error ='Invalid Username or Password!';
                        header("Location: ../login.php?error=".$error);
                    }
                }else{
                    if (isset($_SESSION['login_attempts'])) {
                        $_SESSION['login_attempts']++;
                    } else {
                        $_SESSION['login_attempts'] = 1;
                    }
                    $error ='Invalid Username or Password!';
                    header("Location: ../login.php?error=".$error);
                }
            }else{
                header("Location: ../login.php?error=".$error);
            }
        }
    }
    generateCSRFToken();

?>
