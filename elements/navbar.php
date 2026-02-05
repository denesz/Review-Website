<link rel="stylesheet" href="../styles/main.css">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

<div class="navbar">
    <div class="nav-left">
        <a href="/" class="nav-item">Home</a>
    </div>
    <div class="nav-right">
        <?php if (isset($_SESSION['auth']['id'])) { ?>
            <a href="/profile.php" class="nav-item">Profile</a>
            <a href="../services/logout_service.php" class="nav-item">Log out</a>
        <?php } else { ?>
            <a href="/login.php" class="nav-item">Log In</a>
        <?php } ?>
    </div>
</div>
