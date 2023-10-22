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
        <title>Admin User</title>
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
        .adminn{
            margin-bottom: 10px;
        }
    </style>
    </head>
    
    <body>
    <header>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="adminuser.php">Users</a></li>
                <li><a href="admin.php">Reports</a></li>
                <div id='login'><a href='controllers/logoutc.php'>Logout</a></div>
            <!-- <li><a href="#">Services</a></li>-->
            </ul>
        </header>

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
                if($row["username"] === 'admin'){
                    echo "<div class = 'adminn'>Notes: This Account!</div>";
                    continue;
                }
                echo "<div class = 'delete'><a href='admin.php?delete_report_id=" . $row["user_id"] . "'>Delete</a><br><br></div>";
            }

            if (isset($_GET['delete_user_id']) && $_GET['delete_user_id'] !== 'admin') {
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