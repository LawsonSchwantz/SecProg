<?php
    session_start();
    require_once(__DIR__ . '/connection.php');
    if($_SESSION['is_admin'] !== true){
        header("Location: login.php");
    }

    if(isset($_POST['add_item'])){
        $item_id = $_POST['item_id'];
        $item_name = $_POST['item_name'];
        $item_picture = $_POST['item_picture'];
        $item_desc = $_POST['item_desc'];
        $item_stock = $_POST['item_stock'];

        if(is_numeric($item_stock) == 0){
            $_SESSION['item_failed'] = "Stock must be a number!"; 
            header("Location: ../adminitem.php");
        }

        $insert_query = "INSERT INTO items VALUES (NULL, ?, ?, ?, ?)";
        $stmt = $connection->prepare($insert_query);
        $stmt->bind_param("sssi", $item_name, $item_picture, $item_desc, $item_stock);
        $stmt->execute();
        $connection->close();
        $_SESSION['item_success'] = "Item has been successfully added!";
        header("Location: ../adminitem.php");
    }

    if (isset($_POST['edit_item'])) {
        $item_id = $_POST['item_id'];
        $item_name = $_POST['item_name'];
        $item_picture = $_POST['item_picture'];
        $item_desc = $_POST['item_desc'];
        $item_stock = $_POST['item_stock'];
        
        if(is_numeric($item_stock) == 0){
            $_SESSION['item_failed'] = "Stock must be a number!"; 
            header("Location: ../adminitem.php");
        }

        $edit_query = "UPDATE items SET item_name = ?, item_picture = ?, item_desc = ?, item_stock = ? WHERE item_id = ?";
        $stmt = $connection->prepare($edit_query);
        $stmt->bind_param("sssii", $item_name, $item_picture, $item_desc, $item_stock, $item_id);
        $stmt->execute();
        $connection->close();
        $_SESSION['item_success'] = "Item has been successfully updated!";
        header("Location: ../adminitem.php");
    }