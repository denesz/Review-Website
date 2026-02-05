<?php include 'elements/session_start.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a post</title>
</head>
<body>
    <?php include 'elements/navbar.php'?>

    <h2>Create a post</h2>
    <form action="/services/create_post_service.php" method="post">        
        <label for="content">Content:</label>
        <textarea id="content" name="content" class="input" required></textarea><br><br>

        <button type="submit" class="button">Create</button>
    </form>
</body>
</html>
