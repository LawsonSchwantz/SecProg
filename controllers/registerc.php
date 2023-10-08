<?php

    session_start();
    require_once(__DIR__ . '/connection.php');

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
        $username = htmlspecialchars($_POST['username']);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = $_POST["password"];
        $confirm_pass = $_POST["confirmpassword"];
        $validate = 1;
        
        if(strlen($username)==0){
            $validate=0;
            $error='Username cannot be empty!';
        }else if(strlen($username)<5 || strlen($username)>15){
            $validate=0;
            $error='Username length must be 5-15 characters!';
        }else if(strlen($password)==0){
            $validate=0;
            $error='Password cannot be empty!';
        }else if(strlen($password)<8){
            $validate=0;
            $error='Password length must be atleast 8 characters!';
        }
        
        if ($connection->error){
            echo $connection->error;
        }
        else {
            if($validate==1){
                $result = $connection->query("SELECT * FROM users WHERE `username`='$username'");
                if($result->num_rows == 1){
                    $error ='Username has been taken!';
                    header("Location: ../register.php?error=".$error.'?reg=1');
                }else if($confirm_pass != $password){
                    $error ='Password did not match!';
                    header("Location: ../register.php?error=".$error.'?reg=1');
                }
                else{
                    $password = password_hash($password,PASSWORD_BCRYPT);
                    $connection->query("INSERT INTO `users` (`id`,`username`, `email`, `password`) VALUES (NULL,'$username', '$email', '$password', NOW());");
                    $_POST["register"] = "Register Successfull";
                    header("Location: ../index.php");
                }
            }else{
                header("Location: ../register.php?error=".$error.'&reg=1');
            }
        }
    }
    generateCSRFToken();
?>
