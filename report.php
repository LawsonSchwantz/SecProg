<?php
    session_start();
    if ($_SESSION['is_login'] !== true) {
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<body>

<form action="controllers/ReportController.php" method="POST">
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>" />
    <label for="feedback" class="form-label text-light">Tuliskan keluhanmu dibawah ini:</label>
    <textarea class="form-control" id="feedback" name="feedback"required></textarea>
    <button type="submit" class="btn btn-warning">Send data</button>
</form>

</body>
