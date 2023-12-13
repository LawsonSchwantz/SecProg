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
                window.location.href = 'item.php?delete_item_id=' + itemId;
            }
        }
    </script>
    <?php
        echo "<a href='item.php?add_item_id'>Add</a><br>";
        echo "<a href='item.php?edit_item_id'>Edit</a><br>";
        echo "<br>";
        echo getcwd().DIRECTORY_SEPARATOR."picture".DIRECTORY_SEPARATOR;;

        if ($connection->error) {
            die($connection->error);
        }
            
            if (isset($_GET['add_item_id'])) {
                echo '<form action="item.php" method="post" enctype="multipart/form-data" autocomplete="on">'; // Added enctype attribute for file upload
                echo 'Item Name: <input type="text" name="item_name"> <br>';
                echo 'Picture: <input type="file" name="file" accept="image/x-png, image/jpeg"> <br>';
                echo 'Description: <input type="text" name="item_desc"> <br>';
                echo 'Stock: <input type="number" name="item_stock"> <br>';
                echo '<input type="submit" name="submit" value="Tambah">';
                echo '</form><br><br>';
            } else {
                $result = $connection->query("SELECT * FROM items");
                while ($row = $result->fetch_assoc()) {
                    if (isset($_GET['edit_item_id'])) {
                        echo '<form action="item.php" method="post" enctype="multipart/form-data">';
                        echo 'Item ID: '.htmlspecialchars($row["item_id"]).'<input type="hidden" name="item_id" value="' . htmlspecialchars($row["item_id"]) . '"> <br>';
                        echo 'Item Name: <input type="text" name="item_name" value="' . htmlspecialchars($row["item_name"]) . '"> <br>';
                        echo "Picture: <img class = 'item-image' src='" . $row['item_picture'] . "' alt='Item Picture'><br>";
                        echo 'Choose new picture: <input type="file" name="file" accept="image/x-png, image/jpeg"> <br>';
                        echo 'Description: <input type="text" name="item_desc" value="' . htmlspecialchars($row["item_desc"]) . '"> <br>';
                        echo 'Stock: <input type="number" name="item_stock" value="' . htmlspecialchars($row["item_stock"]) . '"> <br>';
                        echo '<input type="submit" name="submit-edit" value="Done Edit">';
                        echo '</form><br><br>';

                    } else {
                        // echo 'Item ID: ' . $row["item_id"] . '<br>';
                        echo "Item Name: " . $row["item_name"] . "<br>";
                        echo "Picture : <img class = 'item-image' src='" . $row['item_picture'] . "' alt='Item Picture'><br>";
                        echo "Description: " . $row["item_desc"] . "<br>";
                        echo "Stock: " . $row["item_stock"] . "<br>";
                        echo "<a href='#' onclick='confirmDelete(" . $row["item_id"] . ")'>Delete</a><br><br>";
                    }
                }
            }
            
            // Edit
            if (isset($_POST['submit-edit'])) {
                $item_id = $_POST['item_id'];
                $item_name = $_POST['item_name'];
                $item_desc = $_POST['item_desc'];
                $item_stock = $_POST['item_stock'];

                if (isset($_FILES['file'])) {
                    $file = $_FILES['file'];
                    
                    $extensions = ['jpg', 'png'];
                    
                    $uploaded_name = $_FILES['file']['name'];
                    $uploaded_ext  = pathinfo($uploaded_name, PATHINFO_EXTENSION);
                    $uploaded_size = $_FILES['file']['size'];
                    $uploaded_type = $_FILES['file']['type'];
                    $uploaded_tmp  = $_FILES['file']['tmp_name'];
                    
                    $path = "picture";
                    $target_directory = getcwd().DIRECTORY_SEPARATOR.$path.DIRECTORY_SEPARATOR;
                    $target_filename = md5(uniqid()) . '.' . $uploaded_ext;
                    $target_path = $target_directory . $target_filename;
                    
                    
                    if(in_array($uploaded_ext, $extensions)) {
                        if (move_uploaded_file($uploaded_tmp, $target_path)) {
                            
                            $item_picture = $path.DIRECTORY_SEPARATOR.$target_filename;
                            $edit_photo_query = "UPDATE items SET item_picture = ? WHERE item_id = ?";
                            $stmt = $connection->prepare($edit_photo_query);
                            $stmt->bind_param("si", $item_picture, $item_id);
                            $stmt->execute();
                            $stmt->close();

                            echo "<script>";
                            echo "alert('Berhasil mengubah!');";
                            echo "</script>";
                            
                            if(file_exists($uploaded_tmp)){
                                unlink($uploaded_tmp);
                            }
                            
                            $_SESSION['item_success'] = "Item has been successfully updated!";
                            header("Location: item.php");
                            exit();
                        } 
                    } else {
                        echo "<script>alert('Gagal menambahkan!');</script>";
                        $_SESSION['item_success'] = "Fail message"; // ubah saya
                        header("Location: item.php");
                        exit();
                    }
                }
            
                $edit_query = "UPDATE items SET item_name = ?, item_desc = ?, item_stock = ? WHERE item_id = ?";
                $stmt = $connection->prepare($edit_query);
                $stmt->bind_param("ssii", $item_name, $item_desc, $item_stock, $item_id);
                $stmt->execute();
                $stmt->close();
                
                $_SESSION['item_success'] = "Item has been successfully changed!";
                header("Location: item.php");
                exit();
            }
            
            // Add
            if(isset($_POST['submit'])){
                $file = $_FILES['file'];
                
                $extensions = ['jpg', 'png'];
                
                $uploaded_name = $_FILES['file']['name'];
                $uploaded_ext  = pathinfo($uploaded_name, PATHINFO_EXTENSION);
                $uploaded_size = $_FILES['file']['size'];
                $uploaded_type = $_FILES['file']['type'];
                $uploaded_tmp  = $_FILES['file']['tmp_name'];
                
                $path = "picture";
                $target_directory = getcwd().DIRECTORY_SEPARATOR.$path.DIRECTORY_SEPARATOR;
                $target_filename = md5(uniqid()) . '.' . $uploaded_ext;
                $target_path = $target_directory . $target_filename;
                
                
                if(in_array($uploaded_ext, $extensions)) {
                    if (move_uploaded_file($uploaded_tmp, $target_path)) {
                        $item_id = $_POST['item_id'];
                        $item_name = $_POST['item_name'];
                        $item_picture = $path.DIRECTORY_SEPARATOR.$target_filename;
                        $item_desc = $_POST['item_desc'];
                        $item_stock = $_POST['item_stock'];
                        $insert_query = "INSERT INTO items (item_id, item_name, item_picture, item_desc, item_stock) VALUES (NULL, ?, ?, ?, ?)";
                        $stmt = $connection->prepare($insert_query);
                        $stmt->bind_param("sssi", $item_name, $item_picture, $item_desc, $item_stock);
                        $stmt->execute();
                        $stmt->close();
                        echo "<script>";
                        echo "alert('Berhasil menambahkan!');";
                        echo "</script>";
                        
                        if(file_exists($uploaded_tmp)){
                            unlink($uploaded_tmp);
                        }
                        
                        $_SESSION['item_success'] = "Item has been successfully added!";
                        header("Location: item.php");
                        exit();
                    } 
                } else {
                    echo "<script>alert('Gagal menambahkan!');</script>";
                    $_SESSION['item_success'] = "Fail message"; // ubah saya
                    header("Location: item.php");
                    exit();
                }
            }
            
            // Delete
            if (isset($_GET['delete_item_id'])) {
                $item_id = $_GET['delete_item_id'];
                $delete_query = "DELETE FROM items WHERE item_id = ?";
                $stmt = $connection->prepare($delete_query);
                $stmt->bind_param("i", $item_id);
                $stmt->execute();
                $stmt->close();
                $_SESSION['item_success'] = "Item has been successfully deleted!";
                header("Location: item.php");
                exit();
            }
    ?>
</body>
</html>
