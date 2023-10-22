<?php 
    session_start();
    function generateCSRFToken() {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    function loginstatus(){
        if(!isset($_SESSION['is_login'])) {
            $_SESSION['is_login'] = false;
        }
        return $_SESSION['is_login'];
    }
    function adminstatus(){
        if(!isset($_SESSION['is_admin'])) {
            $_SESSION['is_admin'] = false;
        }
        return $_SESSION['is_admin'];
    }
    generateCSRFToken();
    loginstatus();
    adminstatus();
    if(isset($_SESSION['regist_successful'])) {
        echo $_SESSION['regist_successful'];
        unset($_SESSION['regist_successful']);
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
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
        .custom-table {
         width: 100%;
         border-collapse: collapse;
         
        }
        .custom-table td {
        border: 1px solid #ccc;
        padding: 10px;
        text-align: center;
        margin-right : 3%;
         margin-left: 3%;
        }
        /* .custom-table th {
        background-color: #333;
        color: #fff;
        } */
        .custom-table tbody tr:nth-child(4){
        background-color: #fff;
        margin-right : 3%;
        margin-left: 3%;
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
                <div id='login'><a href='controllers/logoutc.php'>Logout</a></div>
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
    
    <?php
        if(isset($_SESSION["loggedin"])) {
            echo $_SESSION["loggedin"];
            unset( $_SESSION["loggedin"]);
        }
    ?>
    <main>
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>" />
        <p>This is the main content of the page.</p>
        <table class="custom-table">
        <!-- PLEASE READ NOTES ON THE BOTTOM OF THIS CODE -->
        <tbody>
            <tr>
                <td>Data 1</td>
                <td>Data 2</td>
                <td>Data 3</td>
                <td>Data 4</td>
            </tr>
            <tr>
                <td>Data 1</td>
                <td>Data 2</td>
                <td>Data 3</td>
                <td>Data 4</td>
            </tr>
            <tr>
                <td>Data 1</td>
                <td>Data 2</td>
                <td>Data 3</td>
                <td>Data 4</td>
            </tr>
            <tr>
                <td>Data 1</td>
                <td>Data 2</td>
                <td>Data 3</td>
                <td>Data 4</td>
            </tr>
            <tr>
                <td>Data 1</td>
                <td>Data 2</td>
                <td>Data 3</td>
                <td>Data 4</td>
            </tr>
            <tr>
                <td>Data 1</td>
                <td>Data 2</td>
                <td>Data 3</td>
                <td>Data 4</td>
            </tr>
            <tr>
                <td>Data 1</td>
                <td>Data 2</td>
                <td>Data 3</td>
                <td>Data 4</td>
            </tr>
            <tr>
                <td>Data 1</td>
                <td>Data 2</td>
                <td>Data 3</td>
                <td>Data 4</td>
            </tr>
            <tr>
                <td>Data 1</td>
                <td>Data 2</td>
                <td>Data 3</td>
                <td>Data 4</td>
            </tr>
            <tr>
                <td>Data 1</td>
                <td>Data 2</td>
                <td>Data 3</td>
                <td>Data 4</td>
            </tr>
            <tr>
                <td>Data 1</td>
                <td>Data 2</td>
                <td>Data 3</td>
                <td>Data 4</td>
            </tr>
            <tr>
                <td>Data 1</td>
                <td>Data 2</td>
                <td>Data 3</td>
                <td>Data 4</td>
            </tr>
            <tr>
                <td>Data 1</td>
                <td>Data 2</td>
                <td>Data 3</td>
                <td>Data 4</td>
            </tr>
            <tr>
                <td>Data 1</td>
                <td>Data 2</td>
                <td>Data 3</td>
                <td>Data 4</td>
            </tr>
            <tr>
                <td>Data 1</td>
                <td>Data 2</td>
                <td>Data 3</td>
                <td>Data 4</td>
            </tr>
            <tr>
                <td>Data 1</td>
                <td>Data 2</td>
                <td>Data 3</td>
                <td>Data 4</td>
            </tr>
            <!-- Add more rows as needed -->
        </tbody>
    </table>
    </main>

    <footer>
        <hr></hr>
        <p class="footer">&copy; 2023 Underdev</p>
    </footer>
</body>
</html>



<!-- 
    - Table masih berupa dummy content. 
    - next progress adalah bikin php untuk auto generate jumlah table sesuai dengan jumlah barang yang dimiliki dalam database
    -->