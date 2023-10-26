<?php
// Connect to the database
require_once(__DIR__ . '/connection.php');


// Query the database
$sql = "SELECT * FROM items";
$result = $connection->query($sql);

// Fetch and store data in an array
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Close the database connection

?>
