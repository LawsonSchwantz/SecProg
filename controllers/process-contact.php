<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    if (!preg_match("/^[a-zA-Z ]+$/", $name)) {
        header("refresh:3 ; url=../about-us.php");
        echo '<script>setTimeout(function(){ window.location.href = "../about-us.php"; }, 5000);</script>';
        echo '<script>alert("Invalid name format. Please use only letters and spaces.");window.location.href="../about-us.php";</script>';
        echo "if you are not redirected yet <a href='../about-us.php'>click here</a>.";
        exit();
    }
    $name_words = str_word_count($name);
    if ($name_words > 20 and $name_words < 1 ) {
        header("refresh:3 ; url=../about-us.php");
        echo '<script>setTimeout(function(){ window.location.href = "../about-us.php"; }, 5000);</script>';
        echo '<script>alert("Name should not exceed 20 words.");window.location.href="../about-us.php";/script>';
        echo "if you are not redirected yet <a href='../about-us.php'>click here</a>.";
        exit();
    }

    $email = $_POST["email"];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("refresh:3 ; url=../about-us.php");
        echo '<script>setTimeout(function(){ window.location.href = "../about-us.php"; }, 5000);</script>';
        echo '<script>alert("Invalid email format. Please enter a valid email address.");window.location.href="../about-us.php";</script>';
        echo "if you are not redirected yet <a href='../about-us.php'>click here</a>.";
        exit();
    }
    $email_words = str_word_count($email);
    if ($email_words > 100 and $email_words < 1 ) {
        header("refresh:3 ; url=../about-us.php");
        echo '<script>setTimeout(function(){ window.location.href = "../about-us.php"; }, 5000);</script>';
        echo '<script>alert("Email should not exceed 100 words.");window.location.href="../about-us.php";</script>';
        echo "if you are not redirected yet <a href='../about-us.php'>click here</a>.";
        exit();
    }

    $message = $_POST["message"];
    $message_words = str_word_count($message);
    if ($message_words > 1000){
        echo '<script>setTimeout(function(){ window.location.href = "../about-us.php"; }, 5000);</script>';
        echo '<script>alert("Message should not exceed 1000 words.");window.location.href="../about-us.php";</script>';
        echo "if you are not redirected yet <a href='../about-us.php'>click here</a>.";
        exit();
    }
    $message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

    //database process here! (Coming Soon ;D )
    
    
    header("refresh:3 ; url=../about-us.php");                      //3 seconds delay
    echo "Thank you for your message!<br>";
    echo "if you are not redirected yet <a href='../about-us.php'>click here</a>.";
   
    exit();
}else{
    echo "nothing to see :) ";
    echo '<img src="https://s3.getstickerpack.com/storage/uploads/sticker-pack/hyperrabbit-very-good/sticker_22.gif?12372c9e3893053ef92458f6bd17234d" alt="GIF">';
}
?>

