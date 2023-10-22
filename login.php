<?php
    session_start();
    function generateCSRFToken() {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            
        }
        return $_SESSION['csrf_token'];
    }
    generateCSRFToken();
    if(isset($_SESSION['regist_successful'])) {
        echo $_SESSION['regist_successful'];
        unset($_SESSION['regist_successful']);
    }

    if (!isset($_SESSION['is_login'])){
    }else{
        echo"You are already logged in.<br>";
        echo"You will redirected into main page";
        header("refresh:3 ; url=index.php");          
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

        #menu {
            text-decoration: none;
            color: #fff;
        }
        #login{
            display: inline;
            margin-right : 3%;
        }
        .footer{
            color:black;
            margin-left:3%;
            margin-right:3%;
            margin-top:90%%
        }
        hr{
            color:lightgrey;
            
        }


    </style>
</head>
<body>
<header>
    <ul>
            <li><a id="menu" href="index.php">Home</a></li>
            <li><a id="menu" href="about-us.php">About</a></li>
            <li><a id="menu" href="report.php">Report</a></li>

     
            

        </ul>
        
    </header>
    
    <h1>Login</h1>
    <form action="controllers/loginc.php" method="POST">
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>" />
    <div class="form-group">
        <label for="">Username</label>
        <input type="text" class="form-control" name="username">
    </div>
    <div class="form-group">
        <label for="">Password</label>
        <input type="password" class="form-control" name="password">
    </div>
    <button class="btn btn-primary" name="login">Login</button>
    <br>
    <a href="register.php" class="pull-right">Don't Have Account? Register First</a>
    </form>

<?php
if(isset($_SESSION['login_failed'])) {
    echo $_SESSION['login_failed'];
    unset($_SESSION['login_failed']);
}
?>