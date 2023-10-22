<?php
    session_start();
    if (!isset($_SESSION['is_login'])){
        $is_login = false;
    }else{
        $is_login = true;
    }
    function generateCSRFToken() {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        
        return $_SESSION['csrf_token'];
    }
    generateCSRFToken();
?>

<!DOCTYPE html>
<html>
<head>
    <title>About Us</title>
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
        <h1>About Us</h1>
        <section>
            <h2>Our Mission</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora, corrupti.</p>
        </section>
        
        <section>
            <h2>Our History</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius provident mollitia quas velit enim eum veritatis doloremque id pariatur repellat vel nostrum temporibus minima, non corporis illum architecto cum quaerat odit aspernatur. Aliquid nobis necessitatibus amet beatae incidunt reiciendis quibusdam obcaecati impedit earum aliquam quaerat cupiditate, error minus porro repellendus placeat. Necessitatibus nesciunt tempore fuga illum animi, similique quo sunt voluptas voluptates saepe architecto labore. Consequuntur aliquam doloribus consequatur saepe harum libero minima debitis aliquid alias asperiores tenetur quis dolores odio, earum voluptatum consectetur! Ducimus, vel labore dolor doloribus autem fugit iste quas assumenda ut atque, repudiandae quasi ratione architecto..</p>
        </section>
        
        <section>
            <h2>Team</h2>
            <p>Meet our team:</p>
            <ul>
                <li><strong>Name:</strong> Bertrand</li>
                <br>
                <li><strong>Role:</strong> Founder and CEO</li>
                <br>
                
                <br>
                <li><strong>Name:</strong> Fefe</li>
                <br>
                <li><strong>Role:</strong> Co Founder</li>
                <br>
                <br>
                <li><strong>Name:</strong> Leo</li><br>
                <li><strong>Role:</strong> Co Founder</li>
                <br>
                <br>
                <li><strong>Name:</strong> Victor</li><br>
                <li><strong>Role:</strong> Co Founder</li>
                <br>

                </ul>
        </section>
                
        <section>
            <h2>Any Questions?</h2>
            <p>Feel free to contact us:</p>
            
            <form method="POST" action="controllers/process-contact.php">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>" />
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required><br><br>
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required><br><br>
                
                <label for="message">Message:</label><br>
                <textarea id="message" name="message" rows="4" cols="50" required></textarea><br><br>
                
                <input type="submit" value="Submit">
            </form>
        </section>
    </main>
   <footer>
        <hr></hr>
        <p>&copy; <?php echo date("Y"); ?> "Underdev".</p>
    </footer> 
</body>
</html>