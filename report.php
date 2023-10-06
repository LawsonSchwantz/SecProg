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
    <label for="firstname" class="form-label text-light">First Name</label>
    <input id="firstname" name="name" type="text" placeholder="" class="form-control" required>
    <label for="lastname" class="form-label text-light">Last Name</label>
    <input id="lastname" name="name" type="text" placeholder="" class="form-control" required>
    <label for="email" class="form-label text-light">Your Email Address</label>
    <input type="email" class="form-control" id="email" aria-describedby="email" required/>
    <label for="pesan" class="form-label text-light">Feedback</label>
    <textarea class="form-control" id=pesan required></textarea>
    <button type="submit" class="btn btn-warning">Send data</button>
</form>

</body>
