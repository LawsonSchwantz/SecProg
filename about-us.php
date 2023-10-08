<!DOCTYPE html>
<html>
<head>
    <title>About Us</title>
</head>
<body>
    <header>
        <h1>About Us</h1>
    </header>
    <main>
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
                <li><strong>Role:</strong> Founder and CEO</li>
                <br>
                
                <li><strong>Name:</strong> Fefe</li>
                <li><strong>Role:</strong> Co Founder</li>
                <br>

                <li><strong>Name:</strong> Leo</li>
                <li><strong>Role:</strong> Co Founder</li>
                <br>
                
                <li><strong>Name:</strong> Victor</li>
                <li><strong>Role:</strong> Co Founder</li>
                <br>

                </ul>
        </section>
                
        <section>
            <h2>Contact Us</h2>
            <p>If you have any questions or would like to leave us a message, please use the form below:</p>
            
            <form method="post" action="/controllers/process-contact.php">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required><br><br>
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required><br><br>
                
                <label for="message">Message:</label><br>
                <textarea id="message" name="message" rows="4" cols="50" required></textarea><br><br>
                
                <input type="submit" value="Submit">
            </form>
        </section>
        <script>
        function validateForm() {
            var nameField = document.getElementById("name");
            var emailField = document.getElementById("email");
            var messageField = document.getElementById("message");

            if (nameField.value.split(/\s+/).length > 20) {
                alert("Name should not exceed 20 words.");
                return false;
            }

            if (emailField.value.split(/\s+/).length > 100) {
                alert("Email should not exceed 100 words.");
                return false;
            }

            if (messageField.value.split(/\s+/).length > 1000) {
                alert("Message should not exceed 1000 words.");
                return false;
            }

            return true;
        }
    </script>
    </main>





    <footer>
        <p>&copy; <?php echo date("Y"); ?> "Underdev".</p>
    </footer>
</body>
</html>
