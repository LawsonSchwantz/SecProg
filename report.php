<?php
    session_start();
    if ($_SESSION['is_login'] !== true) {
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Report</title>
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
        .form-group{
            margin-top: 10px;
        }

    </style>
</head>

<body>
    <header>
    <?php if($_SESSION['is_admin'] === true){ ?>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about-us.php">About</a></li>
                <li><a href="report.php">Report</a></li>
                <li><a href="admin.php">Admin Panel</a></li>
                <?php
                if ($_SESSION['is_login'] === true) {
                    echo "<div id='login'><a href='controllers/logoutc.php'>Logout</a></div>";
                }else{
                    echo "<div id='login'><a href='login.php'>Login</a></div>";
                }
            
                ?>
            <!-- <li><a href="#">Services</a></li>-->
            </ul>
            <?php }else{ ?>
                <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about-us.php">About</a></li>
                <li><a href="report.php">Report</a></li>
                <?php
                if ($_SESSION['is_login'] === true) {
                    echo "<div id='login'><a href='controllers/logoutc.php'>Logout</a></div>";
                }else{
                    echo "<div id='login'><a href='login.php'>Login</a></div>";
                }
            
                ?>
            <!-- <li><a href="#">Services</a></li>-->
            </ul>
            <?php } ?>
    </header>

<form action="controllers/ReportController.php" method="POST">
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>" />
    <div class="form-group">
        <label for="report_type">Tipe laporan:</label>
        <select id="report_type" name="report_type" class="form-control">
            <option value="1">Kritik dan Saran</option>
            <option value="2">Pengajuan Keluhan</option>
            <option value="3">Lainnya</option>
        </select>
    </div>
    <label for="description">Deskripsi:</label>
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
