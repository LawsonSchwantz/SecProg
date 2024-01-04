<?php

require_once(__DIR__ . '/connection.php');
$stmt = $connection->prepare("SELECT * FROM items");
$stmt->execute();
$result = $stmt->get_result();


$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

$connection->close();


?>
