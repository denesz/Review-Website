<?php

include '../elements/session_start.php';

try {
    $conn = new PDO("mysql:host=mysql;dbname=db", 'root', 'root');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Throwable $th) {
    header("Location: /services/create_post_service.php");
}    

    $stmt = $conn->prepare("INSERT INTO posts (content, user_id) VALUES (:content, :user_id)");
    $stmt->bindParam(':content', $_POST['content']);
    $stmt->bindParam(':user_id', $_SESSION['auth']['id']);

    if ($stmt->execute()) {
        header("Location: /index.php");
    } else {
        header("Location: /services/create_post_service.php");
    }
?>