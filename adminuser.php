<?php
    require_once(__DIR__ .'/controllers/connection.php');
    session_start();
    if($_SESSION['is_login']!==true){
        header("Location: login.php");
    }
    ?>
<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin User</title>
    </head>
    
    <body>
        <h1>Admin User</h1>
        <form action="adminuser.php" method=post></form>
        <?php
            echo"<h3>List user yang ada</h3>";
            if($connection->error){
                die($connection->error);
            }

            $result = $connection->query("SELECT * FROM users");
            while ($row = $result->fetch_assoc()) {
                echo 'User ID: ' . $row["user_id"] . '<br>';
                echo "Name: " . $row["username"] . "<br>";
                echo "Email: " . $row["email"] . "<br>";
                echo "<a href='adminuser.php?delete_user_id=" . $row["user_id"] . "'>Delete</a><br><br>";
            }


            if (isset($_GET['delete_user_id'])) {
                $user_id = $_GET['delete_user_id'];
                $delete_query = "DELETE FROM users WHERE user_id = ?";
                $stmt = $connection->prepare($delete_query);
                $stmt->bind_param("i", $user_id);
                $stmt->execute();
                $stmt->close();
                $_SESSION['user_success'] = "User has been successfully deleted!";
                header("Location: adminuser.php");
                exit();
            }
        ?>

    </body>

</html>
