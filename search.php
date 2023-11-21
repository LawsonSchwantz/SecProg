<?php
$search_query = isset($_GET['search_query']) ? $_GET['search_query'] : '';
$search_query = htmlspecialchars($search_query, ENT_QUOTES, 'UTF-8');
// Connect to your database
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "SecureProg";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$search = $_GET['search'] ?? ''; 

$sql = "SELECT * FROM items WHERE item_name LIKE ? OR item_desc LIKE ?";
$stmt = $conn->prepare($sql);

$searchTerm = '%' . $search . '%';
$stmt->bind_param("ss", $searchTerm, $searchTerm);

$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "Item ID: " . $row["item_id"]. " - Name: " . $row["item_name"]. " - Description: " . $row["item_desc"]. " - Stock: " . $row["item_stock"] . "<br>";
    }
} else {
    echo "0 results found";
}

$stmt->close();
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="section search">
            <h2>Search</h2>
            <form action="search.php" method="GET">
                <input type="text" name="search_query" placeholder="Search..." value="<?php echo $search_query; ?>" required>
                <button type="submit">Search</button>
            </form>
        </div>
    </div>
</body>
</html>