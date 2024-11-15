<?php
session_start();

require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (strlen($username) < 3 || strlen($password) < 6) {
        die('Корисничкото име мора да има најмалку 3 карактери, а лозинката најмалку 6.');
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (:username, :password, 'user')");
    try {
        $stmt->execute([':username' => $username, ':password' => $hashedPassword]);

        echo "Регистрацијата е успешна! <a href='login.php'>Најавете се тука</a>";
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            die("Корисничкото име веќе постои.");
        } else {
            die("Грешка: " . $e->getMessage());
        }
    }
}
?>
