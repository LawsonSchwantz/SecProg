<?php
session_start();
require_once(__DIR__ . '/controllers/connection.php');
if ($_SESSION['is_admin'] !== true) {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>TEST UPLOAD</title>
</head>
<body>
    <form action="TESTUPLOAD.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="file">
        <button type="submit" name="submit">UPLOAD</button>
    </form>

    <?php

        if(isset($_POST['submit'])){
            $file = $_FILES['file'];

            $extensions = ['jpg', 'png'];

            $uploaded_name = $_FILES['file']['name'];
            $uploaded_ext  = pathinfo($uploaded_name, PATHINFO_EXTENSION);
            $uploaded_size = $_FILES['file']['size'];
            $uploaded_type = $_FILES['file']['type'];
            $uploaded_tmp  = $_FILES['file']['tmp_name'];

            $target_directory = "C:/xampp/htdocs/SecProg-main/picture/";
            $target_filename = md5(uniqid()) . '.' . $uploaded_ext;
            $target_path = $target_directory . $target_filename;


            if(in_array($uploaded_ext, $extensions)) {
                if (move_uploaded_file($uploaded_tmp, $target_path)) {
                    echo "File uploaded successfully!<br>";
                    if( file_exists( $uploaded_tmp ) )
                        unlink( $uploaded_tmp );
                } 
            } else {
                echo "File upload failed.<br>";
            }

        }

    ?>
</body>

