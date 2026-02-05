<?php
if ($_POST['password'] !== $_POST['confirm_password']) {
    header("Location: /services/register_service.php");
} else {
    try {
        $conn = new PDO("mysql:host=mysql;dbname=db", 'root', 'root');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (Throwable $th) {
        header("Location: /services/register_service.php");

    }

    $stmt = $conn->prepare("
        INSERT INTO users (first_name, last_name, date_of_birth, username, email, password, created, modified)
        VALUES (:first_name, :last_name, :date_of_birth, :username, :email, :password, :created, :modified)
    ");

    $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $date = date('Y-m-d H:i:s');
    $stmt->bindParam(':first_name', $_POST['first_name']);
    $stmt->bindParam(':last_name', $_POST['last_name']);
    $stmt->bindParam(':date_of_birth', $_POST['date_of_birth']);
    $stmt->bindParam(':username', $_POST['username']);
    $stmt->bindParam(':email', $_POST['email']);
    $stmt->bindParam(':password', $hashed_password);
    $stmt->bindParam(':created', $date);
    $stmt->bindParam(':modified', $date);

    if ($stmt->execute() === false) {
        header("Location: /services/register_service.php");
    } else {
        header("Location: /login.php");
    }

}
?>