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
    <fieldset class="form-group">
        <label for="report_type">Tipe laporan:</label>
        <select id="report_type" name="report_type" class="form-control">
            <option value="1">Kritik dan Saran</option>
            <option value="2">Pengajuan Keluhan</option>
            <option value="3">Lainnya</option>
        </select>
    </fieldset>
    <label for="description" class="form-label text-light">Deskripsi:</label>
    <textarea class="form-control" id="description" name="description"required></textarea>
    <button type="submit" class="btn btn-warning" name="send_data">Send data</button>
</form>

</body>


<?php
if(isset($_SESSION['error_report'])) {
    echo $_SESSION['error_report'];
    unset($_SESSION['error_report']);
}else if (isset($_SESSION['report_success'])){
    echo $_SESSION['report_success'];
    unset($_SESSION['report_success']);
}
?>
