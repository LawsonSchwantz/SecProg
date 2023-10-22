
<!DOCTYPE html>
<html lang="en">
<head>
<style>
h1{
    font-size :650%;
    display: flex;
    justify-content: center; 
    align-items: center; 
    height: 100vh;
}
p{
    font-size : 24%;
    font-weight: 10;
    display: flex;
    justify-content: center; 
    align-items: center; 
    height: 100vh;
    margin-top:-97%;
}

</style>

</head>
<body>
    
</body>
</html>

<?php
    session_start();
    require_once(__DIR__ . '/connection.php');
    function validateCSRFToken($token) {
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['csrf_token']) && validateCSRFToken($_POST['csrf_token'])) {
        $name = $_POST["name"];
        $name_words = str_word_count($name);
        if ($name_words > 20 or $name_words < 1 ) {
            echo "<title>Error</title>";
            echo '<script>alert("Name should not exceed 20 words or empty!");window.location.href="../about-us.php";</script>';  
            echo "if you are not redirected yet <a href='../about-us.php'>click here</a>.";
            exit();   
        }else{
            if (!preg_match("/^[a-zA-Z ]+$/", $name)) {
                echo "<title>Error</title>";
                echo '<script>alert("Invalid name format. Please use only letters and spaces!");window.location.href="../about-us.php";</script>';
                echo "if you are not redirected yet <a href='../about-us.php'>click here</a>.";
                exit();
            }
        }

        $email = $_POST["email"];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<title>Error</title>";
            echo '<script>alert("Invalid email format. Please enter a valid email address.");window.location.href="../about-us.php";</script>';
            echo "if you are not redirected yet <a href='../about-us.php'>click here</a>.";
            exit();
        }

        $email_words = str_word_count($email);
        if ($email_words > 100 and $email_words < 1 ) {
            echo "<title>Error</title>";
            echo '<script>alert("Email should not exceed 100 words.");window.location.href="../about-us.php";</script>';
            echo "if you are not redirected yet <a href='../about-us.php'>click here</a>.";
            exit();
        }

        $message = $_POST["message"];
        $message_words = str_word_count($message);
        if ($message_words > 1000){
            echo "<title>Error</title>";
            echo '<script>alert("Message should not exceed 1000 words.");window.location.href="../about-us.php";</script>';
            echo "if you are not redirected yet <a href='../about-us.php'>click here</a>.";
            exit();
        }
        $message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

        //database process here! 
        if ($connection->error){
            echo $connection->error;
        }else{
            $connection->query("INSERT INTO aboutus VALUES (NULL,'$name','$email', '$message', NOW());");
        }
        echo "<title>About Us</title>";
        header("refresh:3 ; url=../about-us.php");                      //3 seconds delay
        echo "Thank you for your message!<br>";
        echo "if you are not redirected yet <a href='../about-us.php'>click here</a>.";
        
        exit();
        
    }else{
        echo "<title>Error 403</title>";
        echo "<h1>Forbidden!<h1>";
        echo "<p>You don't have permission to access this resource!<p>";
    }
?>
