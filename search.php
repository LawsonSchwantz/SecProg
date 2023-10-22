<?php
$search_query = isset($_GET['search_query']) ? $_GET['search_query'] : '';
$search_query = htmlspecialchars($search_query, ENT_QUOTES, 'UTF-8');
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