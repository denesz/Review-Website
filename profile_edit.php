<?php
include 'elements/session_start.php';
include 'elements/navbar.php';
?>

<form action="/services/profile_edit_service.php" method="post">
    <br>
    <label for="first_name">First name:</label>
    <input type="text" id="first_name" name="first_name" class="input" required>
    <br><br>

    <label for="last_name">Last name:</label>
    <input type="text" id="last_name" name="last_name" class="input" required>
    <br><br>

    <label for="email">Email:</label>
    <input type="text" id="email" name="email" class="input" required> 
    <br><br>

    <button type="submit" class="button">Edit profile</button>
</form>
