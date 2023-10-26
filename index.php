<?php 
    session_start();
    if (!isset($_SESSION['is_login'])){
        $is_login = false;
    }else{
        $is_login = true;
    }

    require(__DIR__ . '/controllers/indexConnection.php');
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
            margin-top:90%%
        }
        hr{
            color:lightgrey;
            
        }
        .custom-table td {
        border: 1px solid #ccc;
        padding: 10px;
        text-align: center;
        margin-right : 3%;
         margin-left: 3%;
        }
        img.item-image {
            max-width: 200px; /* Set a maximum width for the images */
            display: block; /* Make images appear in a block to control alignment */
            margin: 0 auto; /* Center the images horizontally */
        }
        .item_name{
            color: black;
            font-weight:bold;

        }
        .item_desc{
            color:grey;
            font-weight :150;
        }
        
        .stocks{
            color:black;
            font-weight:150;

        }
        

    </style>
</head>
<body>
    <header>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about-us.php">About</a></li>
            <li><a href="report.php">Report</a></li>
            <?php
             if ($is_login === true) {
                  echo "<div id='login'><a href='controllers/logoutc.php'>Logout</a></div>";
             }else {
                  echo "<div id='login'><a href='login.php'>Login</a></div>";
              }
          
            ?>
     
            

        </ul>
    </header>

    <main>
        
        <table class="custom-table">
        
        <tbody>
        <?php
        foreach ($data as $row) {
            echo "<tr>";
            echo "<td> <img class = 'item-image' src='" . $row['item_picture'] . "' alt='Item Picture'>
            <p class='item_name'>" . $row['item_name'] . "</p>            
            <p class='item_desc'>". $row['item_desc'] ."</p>
            <p class='stocks'>Stock: ". $row['item_stock'] ."</p>
            </td>";

            // echo "<p>" . $row['item_desc'] . "</p>";
            // echo "<p>" . $row['item_stock'] . "</td>";
            echo "</tr>";
        }
        ?>
            
            
        </tbody>
    </table>
    </main>

    <footer>
        <hr></hr>
        <p class="footer">&copy; 2023 Underdev</p>
    </footer>
</body>
</html>



