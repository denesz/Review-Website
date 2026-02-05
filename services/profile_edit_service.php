<?php
include '../elements/session_start.php';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    try {
        $conn = new PDO("mysql:host=mysql;dbname=db", 'root', 'root');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (Throwable $th) {
        header("Location: /profile_edit.php");
        
    }

    $stmt = $conn->prepare("
        UPDATE users SET first_name = :first_name, last_name = :last_name, email = :email, modified = :modified WHERE username = :username
    ");

    $date = date('Y-m-d H:i:s');
    $stmt->bindParam(':first_name', $_POST['first_name']);
    $stmt->bindParam(':last_name', $_POST['last_name']);
    $stmt->bindParam(':email', $_POST['email']);
    $stmt->bindParam(':modified', $date);
    $stmt->bindParam(':username', $_SESSION['auth']['username']);

    try {
        $stmt->execute();
        header("Location: /profile.php");
        echo "Profile edited succesfully";
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>