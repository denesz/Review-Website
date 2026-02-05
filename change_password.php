<?php 
include 'elements/session_start.php';
include 'elements/navbar.php'; 
if (isset($_GET['error']) && $_GET['error'] == 'password_mismatch') {
        echo "<p>Your new passwords don't match!</p>";
    }
if (isset($_GET['error']) && $_GET['error'] == 'incorrect_current_password') {
        echo "<p>Your current password is incorrect!</p>";
    }
?>


<form action="/services/change_password_service.php" method="post">
        <label for="password">Current Password:</label>
        <input type="password" id="current_password" name="current_password" class="input"><br><br>

        <label for="password">New Password</label>
        <input type="password" id="new_password" name="new_password" class="input"><br><br>

        <label for="password">Confirm New Password</label>
        <input type="password" id="confirm_new_password" name="confirm_new_password" class="input"><br><br>

        <button type="submit" class="button">Change your password</button>
</form>