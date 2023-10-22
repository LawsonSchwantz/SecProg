<?php
    require_once(__DIR__ . '/controllers/connection.php');
    session_start();
    if ($_SESSION['is_login'] !== true) {
        header("Location: login.php");
    }

    $report_typelist = array(
        "1" => "Kritik dan Saran",
        "2" => "Pengajuan Keluhan",
        "3" => "Lainnya"
    );

    ?>

<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Page</title>
    </head>

    <body>
        <h1>Welcome, Administrator!</h1>
        <form action="admin.php" method="post">
            <h3>Add Report</h3>
            <label for="report_type">Report Type:</label>
            <select name="report_type" id="report_type">
                <?php
                foreach ($report_typelist as $key => $value) {
                    echo "<option value='$key'>$value</option>";
                }
                ?>
        </select><br><br>
        
        <label for="description">Description:</label><br>
        <textarea name="description" id="description" cols="30" rows="5"></textarea><br>
        
        <input type="submit" value="Submit">
    </form>
    <?php
        echo "<h3>Delete Report</h3>";
        if ($connection->error) {
            die($connection->error);
        }

        $result = $connection->query("SELECT * FROM reports");
        while ($row = $result->fetch_assoc()) {
         
            echo 'Report ID: ' . $row["report_id"] . '<br>';
            echo "Sender ID: " . $row["sender_id"] . "<br>";
            echo "Type: " . $row["report_type"] . "<br>";
            echo "Description: " . $row["description"] . "<br>";
            echo "Time: " . $row["send_time"] . "<br>";
            echo "<a href='admin.php?delete_report_id=" . $row["report_id"] . "'>Delete</a><br><br>";
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $user_id = $_SESSION['user_id'];
            $type = $report_typelist[$_POST["report_type"]];

            $user_id = mysqli_real_escape_string($connection, $user_id);
            $report_type = mysqli_real_escape_string($connection, $type);
            $description = mysqli_real_escape_string($connection, $_POST["description"]);

            $query = "INSERT INTO reports VALUES (NULL, $user_id, '$report_type', '$description', NOW());";
            $connection->query($query);
            $_SESSION['report_success'] = "Report has been successfully sent!";
            header("Location: admin.php");
            exit();
        }
        
        if (isset($_GET['delete_report_id'])) {
            $report_id = $_GET['delete_report_id'];
            $delete_query = "DELETE FROM reports WHERE report_id = ?";
            $stmt = $connection->prepare($delete_query);
            $stmt->bind_param("i", $report_id);
            $stmt->execute();
            $stmt->close();
            $_SESSION['report_success'] = "Report has been successfully deleted!";
            header("Location: admin.php");
            exit();
        }

        ?>
