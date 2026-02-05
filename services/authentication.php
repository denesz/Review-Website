<?php
if( $_SERVER['REQUEST_METHOD'] === 'POST'){
    try{
        $conn = new PDO("mysql:host=mysql;dbname=db", 'root', 'root');
        $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = :username");
        $stmt->bindParam(':username', $_POST['username']);
        $stmt->execute();

        $user = $stmt -> fetch(PDO::FETCH_ASSOC);
        if($user && password_verify($_POST['password'], $user['password'])){
            session_start();
            $_SESSION['auth'] = [
                'id' => $user['id'],
                'username' => $user['username']
            ];
            header("Location: /index.php");
        }
        else{
            header("Location: /login.php?error=invalid_credentials");
        }
    } catch(Exception $e){
        echo "Error: " . $e->getMessage();
    }
}

?>