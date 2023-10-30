<?php
    session_start();
    require_once(__DIR__ . '/controllers/connection.php');
    if($_SESSION['is_admin'] !== true){
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
<h1>Welcome, Administrator!</h1>
    <script>
        function confirmDelete(itemId) {
            var confirmDelete = confirm("Are you sure want to delete this product?");
            if (confirmDelete) {
                window.location.href = 'adminitem.php?delete_item_id=' + itemId;
            }
        }
    </script>
    <?php
        echo "<a href='adminitem.php?add_item_id'>Add</a><br>";
        echo "<a href='adminitem.php?edit_item_id'>Edit</a><br>";
        echo "<br>";

        if ($connection->error) {
            die($connection->error);
        }

        $result = $connection->query("SELECT * FROM items");
        while ($row = $result->fetch_assoc()) {
            if(isset($_GET['add_item_id'])){
                echo '<form action="item.php" method="post">';
                echo 'Item ID: <input type="text" name="item_id" value="' . htmlspecialchars($row["item_id"]) . '"> <br>';
                echo 'Item Name: <input type="text" name="item_name" value="' . htmlspecialchars($row["item_name"]) . '"> <br>';
                // echo 'Picture : <input type="text" name="item_picture" value="' . htmlspecialchars($row["item_picture"]) . '"> <br>';
                echo 'Picture : 
                <form action="TESTUPLOAD.php" method="POST" enctype="multipart/form-data">
                    <input type="file" name="file">
                    <button type="submit" name="submit">UPLOAD</button>
                </form>';

                echo 'Description: <input type="text" name="item_desc" value="' . htmlspecialchars($row["item_desc"]) . '"> <br>';
                echo 'Stock: <input type="text" name="item_stock" value="' . htmlspecialchars($row["item_stock"]) . '"> <br>';
                echo '<input type="submit" name="submit" value="Tambakan barang!">';
                echo '</form><br><br>';
            }

            else if (isset($_GET['edit_item_id'])) {
                echo '<form action="adminitem.php" method="post">';
                echo 'Item ID: <input type="text" name="item_id" value="' . htmlspecialchars($row["item_id"]) . '"> <br>';
                echo 'Item Name: <input type="text" name="item_name" value="' . htmlspecialchars($row["item_name"]) . '"> <br>';
                echo 'Picture : <input type="text" name="item_picture" value="' . htmlspecialchars($row["item_picture"]) . '"> <br>';
                echo 'Description: <input type="text" name="item_desc" value="' . htmlspecialchars($row["item_desc"]) . '"> <br>';
                echo 'Stock: <input type="text" name="item_stock" value="' . htmlspecialchars($row["item_stock"]) . '"> <br>';
                echo '<input type="submit" name="submit" value="Done Edit">';
                echo '</form><br><br>';
            }
            
            else {
                echo 'Item ID: ' . $row["item_id"] . '<br>';
                echo "Item Name: " . $row["item_name"] . "<br>";
                echo "Picture : <img class = 'item-image' src='" . $row['item_picture'] . "' alt='Item Picture'><br>";
                echo "Description: " . $row["item_desc"] . "<br>";
                echo "Stock: " . $row["item_stock"] . "<br>";
                echo "<a href='#' onclick='confirmDelete(" . $row["item_id"] . ")'>Delete</a><br><br>";
            }
    }

    if(isset($_POST['add_item_id'])){
        $item_id = $_POST['item_id'];
        $item_name = $_POST['item_name'];
        $item_picture = $_POST['item_picture'];
        $item_desc = $_POST['item_desc'];
        $item_stock = $_POST['item_stock'];

        $insert_query = "INSERT INTO items (item_id, item_name, item_picture, item_desc, item_stock) VALUES (?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($insert_query);
        $stmt->bind_param("isssi", $item_id, $item_name, $item_picture, $item_desc, $item_stock);
        $stmt->execute();
        $stmt->close();
        $_SESSION['item_success'] = "Item has been successfully updated!";
        header("Location: item.php");
        exit();
    }

    if (isset($_POST['item_id'])) {
        $item_id = $_POST['item_id'];
        $item_name = $_POST['item_name'];
        $item_picture = $_POST['item_picture'];
        $item_desc = $_POST['item_desc'];
        $item_stock = $_POST['item_stock'];
    
        $edit_query = "UPDATE items SET item_name = ?, item_desc = ?, item_stock = ? WHERE item_id = ?";
        $stmt = $connection->prepare($edit_query);
        $stmt->bind_param("ssii", $item_name, $item_desc, $item_stock, $item_id);
        $stmt->execute();
        $stmt->close();
        $_SESSION['item_success'] = "Item has been successfully updated!";
        header("Location: adminitem.php");
        exit();
    }

    if (isset($_GET['delete_item_id'])) {
        $item_id = $_GET['delete_item_id'];
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
