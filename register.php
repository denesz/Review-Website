<?php include 'elements/session_start.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <?php include 'elements/navbar.php'?>

    <h2>Create your account</h2>
    <form action="/services/register_service.php" method="post">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" class="input"  required><br><br>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" class="input"  required><br><br>

        <label for="date_of_birth">Date of birth:</label>
        <input type="date" id="date_of_birth" name="date_of_birth" min="0" class="input" required> <br><br>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" class="input" required><br><br>

        <label for="email">Email:</label>
        <input type="text" id="email" name="email" class="input" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" class="input" required><br><br>

        <label for="password">Confirm your password:</label>
        <input type="password" id="confirm_password" name="confirm_password" class="input" required><br><br>

        <button type="submit" class="button">Register</button>
    </form>
</body>
</html>
