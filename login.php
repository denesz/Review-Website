<?php include 'elements/session_start.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body{
            display: grid;
            place-items: center;
            /* height: 40vh; */
            margin: 0;
        }
    </style>
</head>
<body>
<?php include 'elements/navbar.php'; ?>
    
    <?php
    if (isset($_GET['error']) && $_GET['error'] == 'invalid_credentials') {
        echo "<p style='color: red;'>Invalid username or password!</p>";
    }
    
    ?>

    <h2>Log In</h2>
    <form action="/services/authentication.php" method="post">
        <div class="label-input-allign">
            <label for="username" class="bold_text" >Username:</label>
            <input type="text" id="username" name="username" class="input" placeholder="my_username"><br><br>
        </div>
        
        <div class="label-input-allign">
        <label for="password" class="bold_text" >Password:</label>
        <input type="password" id="password" name="password" class="input" placeholder="Password"><br><br>
        </div>

        <button type="submit" class="button">Log In</button>
        <br><br>
        First time here? <br><br>
        <a href="/register.php" class="button">Register</a>
    </form>
    
</body>
</html>
