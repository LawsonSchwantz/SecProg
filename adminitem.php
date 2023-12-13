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
        <title>Admin Items page</title>
    <style>
        header {
            background-color: #333;
            display: block;
            color: #fff;
            padding: 1%;
            position:sticky;
            
            top:0px;
        }

        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        li {
            display: inline;
            margin-right: 3%;
        }

        a {
            text-decoration: none;
            color: #fff;
        }
        #login{
            display: inline;
            margin-right : 3%;
        }
        /* footer{
            position:sticky;
            bottom:0px;
            background-color: white;
            color: #fff;
            padding: 0%;
        } */
        .footer{
            color:black;
            margin-left:3%;
            margin-right:3%;
            margin-top:90%;
        }
        hr{
            color:lightgrey;
            
        }
        .custom-table {
         width: 100%;
         border-collapse: collapse;
         
        }
        .custom-table td {
        border: 1px solid #ccc;
        padding: 10px;
        text-align: center;
        margin-right : 3%;
         margin-left: 3%;
        }
        /* .custom-table th {
        background-color: #333;
        color: #fff;
        } */
        .custom-table tbody tr:nth-child(4){
        background-color: #fff;
        margin-right : 3%;
        margin-left: 3%;
        }
        .delete{
            background-color: black;
            display: inline;
        }
    </style>
    </head>

<body>
    <header>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="adminuser.php">Users</a></li>
                <li><a href="admin.php">Reports</a></li>
                <li><a href="adminitem.php">Items</a></li>
                <li><a href='adminitem.php?add_item_id'>Add Item</a></li>
                <li><a href='adminitem.php?edit_item_id'>Edit Item</a></li>
                <div id='login'><a href='settings.php'>Settings</a></div>
                <div id='login'><a href='controllers/logoutc.php'>Logout</a></div>
            <!-- <li><a href="#">Services</a></li>-->
            </ul>
    </header>
    <?php
        if ($connection->error) {
            die($connection->error);
        }
        if(isset($_SESSION['item_failed'])){
            echo $_SESSION['item_failed'];
            echo "<br>";
            unset($_SESSION['item_failed']);
        }else if(isset($_SESSION['item_success'])){
            echo $_SESSION['item_success'];
            echo "<br>";
            unset($_SESSION['item_success']);
        }
        
        $result = $connection->query("SELECT * FROM items");
        while ($row = $result->fetch_assoc()) {
            if(isset($_GET['add_item_id'])){
                echo '<form action="controllers/adminitemc.php" method="post">';
                echo '<input type="hidden" name="item_id" value="' . htmlspecialchars($row["item_id"]) . '">';
                echo 'Item Name: <input type="text" name="item_name" value=""> <br>';
                echo 'Picture (In URL): <input type="text" name="item_picture" value=""> <br>';
                echo 'Description: <input type="text" name="item_desc" value=""> <br>';
                echo 'Stock: <input type="text" name="item_stock" value=""> <br>';
                echo '<button type="submit" name="add_item">Tambahkan Barang</button>';
                echo '</form><br><br>';
                break;
            }

            else if (isset($_GET['edit_item_id'])) {
                echo '<form action="controllers/adminitemc.php" method="post">';
                // echo 'Item ID: <input type="hidden" name="item_id" value="' . htmlspecialchars($row["item_id"]) . '"> ' . htmlspecialchars($row["item_id"]) . '<br>';
                echo 'Item Name: <input type="text" name="item_name" value="' . htmlspecialchars($row["item_name"]) . '"> <br>';
                echo 'Description: <input type="text" name="item_desc" value="' . htmlspecialchars($row["item_desc"]) . '"> <br>';
                echo 'Stock: <input type="text" name="item_stock" value="' . htmlspecialchars($row["item_stock"]) . '"> <br>';
                echo '<button type="submit" name="edit_item">Done Edit</button>';
                echo '</form><br><br>';
                
            }else {
                // echo 'Item ID: ' . $row["item_id"] . '<br>';
                // echo 'Item ID: ' . htmlentities($row["item_id"], ENT_QUOTES) . '<br>';
                // echo "Item Name: " .  $row["item_name"] . "<br>";
                echo "Item Name: " .  htmlentities($row["item_name"], ENT_QUOTES) . "<br>";
                // echo "Picture : <img class = 'item-image' src='" . $row['item_picture'] . "' alt='Item Picture'><br>";
                echo "Picture : <img class = 'item-image' src='" . htmlentities($row['item_picture'], ENT_QUOTES) . "' alt='Item Picture'><br>";
                // echo "Description: " . $row["item_desc"] . "<br>";
                echo "Description: " . htmlentities($row["item_desc"], ENT_QUOTES) . "<br>";
                // echo "Stock: " . $row["item_stock"] . "<br>";
                echo "Stock: " . htmlentities($row["item_stock"], ENT_QUOTES) . "<br>";
                echo "<div class = 'delete'><a href='adminitem.php?delete_item_id=" . $row["item_id"] . "'>Delete</a><br><br></div>";
            }
    }

    if (isset($_GET['delete_item_id'])) {
        $item_id = $_GET['delete_item_id'];
        $delete_query = "DELETE FROM items WHERE item_id = ?";
        $stmt = $connection->prepare($delete_query);
        $stmt->bind_param("i", $item_id);
        $stmt->execute();
        $connection->close();
        $_SESSION['item_success'] = "Item has been successfully deleted!";
        header("Location: adminitem.php");
    }
    ?>
    </body>
</html>
