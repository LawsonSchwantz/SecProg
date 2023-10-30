<?php
    session_start();
    require_once(__DIR__ . '/controllers/connection.php');
    if($_SESSION['is_admin']!==true){
        header("Location:login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
    
<head>
    <title>Admin Item</title>
</head>
<body>
<header>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="adminuser.php">Users</a></li>
                <li><a href="admin.php">Reports</a></li>
                <div id='login'><a href='controllers/logoutc.php'>Logout</a></div>
            </ul>
        </header>
        <h1>Welcome, Administrator!</h1>
        <form action="adminitem.php" method="post">
        <?php
            if($connection->error){
                die($connection->error);
            }

            $result = $connection->query("SELECT * FROM items");
            while ($row = $result->fetch_assoc()) {
                // if (isset($_GET['edit_item_id'])) {
                //     echo '<form action="admin.php" method="post">';
                //     echo "Item ID: <input type=\"text\" name=\"item_id\" value=\"". $row["item_id"] ."\"> <br>";
                //     echo "Item Name: <input type=\"text\" name=\"item_name\" value=\"". $row["item_name"] ."\"> <br>";
                //     echo "Picture: <input type=\"text\" name=\"item_picture\" value=\"". $row["item_picture"] ."\"> <br>";
                //     echo "Description: <input type=\"text\" name=\"item_desc\" value=\"". $row["item_desc"] ."\"> <br>";
                //     echo "Stock: <input type=\"text\" name=\"item_stock\" value=\"". $row["item_stock"] ."\"><br><input type='submit' value='Edit'><br><br>";

                    if(isset($_GET['delete_item_id'])) {
                        echo "Item ID: " . $row["item_id"] . '<br>';
                        echo "Item Name: " . $row["item_name"] . "<br>";
                        echo "Picture: " . $row["item_picture"] . "<br>";
                        echo "Description: " . $row["item_desc"] . "<br>";
                        echo "Stock: " . $row["item_stock"] . "<br>";
                        echo "<div class = 'delete'><a href='adminitem.php?delete_item_id=" . $row["item_id"] . "'>Delete</a><br><br></div>";
                    }
            }


            if (isset($_POST['edit_item_id'])) {
                $edit_item_id = $_POST['edit_item_id'];
                $item_name = $_POST['item_name'];
                $item_picture = $_POST['item_picture'];
                $item_desc = $_POST['item_desc'];
                $item_stock = $_POST['item_stock'];
            
                $edit_query = "UPDATE items SET item_name = ?, item_picture = ?, item_desc = ?, item_stock = ? WHERE item_id = ?";
                $stmt = $connection->prepare($edit_query);
                $stmt->bind_param("ssssi", $item_name, $item_picture, $item_desc, $item_stock, $edit_item_id);
                $stmt->execute();
                $stmt->close();
            
                header("Location: adminitem.php");
                exit();
            }

            if (isset($_GET['delete_item_id'])) {
                $report_id = $_GET['delete_item_id'];
                $delete_query = "DELETE FROM items WHERE item_id = ?";
                $stmt = $connection->prepare($delete_query);
                $stmt->bind_param("i", $item_id);
                $stmt->execute();
                $stmt->close();
                $_SESSION['item_success'] = "Item has been successfully deleted!";
                header("Location: adminitem.php");
                exit();
            }
        ?>

</body>
</html>

