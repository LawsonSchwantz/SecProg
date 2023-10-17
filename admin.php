<?php
    session_start();
    if ($_SESSION['is_login'] !== true) {
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Page</title>
</head>
<body>
    <h1>Welcome, Administrator!</h1>

    <form action="controllers/adminc.php" method="POST">
        <input type="submit" name="add_report" value="Add Report">
    </form>
  
    <form action="controllers/adminc.php" method="POST">
        <input type="submit" name="edit_report" value="Edit Report">
    </form>

    <form action="controllers/adminc.php" method="POST">>
        <input type="submit" name="delete_report" value="Delete Report">
    </form>

</body>
</html>
