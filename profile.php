<?php
include 'elements/session_start.php';
include 'elements/navbar.php';
include 'services/get_user_service.php';
?>

<?php
    $userData = getUser($_SESSION['auth']['id']);
?>

<br>
<label for="first_name">First name:</label>
<span id="first_name"><?= htmlspecialchars($userData['first_name']) ?></span>
<br><br>

<label for="last_name">Last name:</label>
<span id="last_name"><?= htmlspecialchars($userData['last_name']) ?></span>
<br><br>

<label for="email">Email:</label>
<span id="email"><?= htmlspecialchars($userData['email']) ?></span>
<br><br>

<label for="date_of_birth">Date of Birth:</label>
<span id="date_of_birth"><?= htmlspecialchars($userData['date_of_birth']) ?></span>
<br><br>

<div>
    <a href="/profile_edit.php" class="button">Edit your profile</a>
</div>
<br>
<div>
    <a href="/change_password.php" class="button">Change your password</a>
</div>
