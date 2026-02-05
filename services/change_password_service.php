<?php
include '../elements/session_start.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $conn = new PDO("mysql:host=mysql;dbname=db", 'root', 'root');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Throwable $th) {
        header("Location: /profile.php");
    }
         
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];

    if ($new_password !== $confirm_new_password) {
        header("Location: /change_password.php?error=password_mismatch");
    }

    $stmt = $conn->prepare("SELECT password FROM users WHERE id = :id");
    $stmt->bindParam(':id', $_SESSION['auth']['id']);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($current_password, $user['password'])) {

        $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

        $update_stmt = $conn->prepare("UPDATE users SET password = :password WHERE id = :id");
        $update_stmt->bindParam(':password', $hashed_new_password);
        $update_stmt->bindParam(':id', $_SESSION['auth']['id']);
        $update_stmt->execute();

        header("Location: /profile.php");
    }else{
        header("Location: /profile.php?error=incorrect_current_password");
    }
    
}
?>
