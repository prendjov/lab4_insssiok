<?php
try {
    $dsn = 'sqlite:' . __DIR__ . '/database.sqlite';
    $pdo = new PDO($dsn);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT NOT NULL,
        password TEXT NOT NULL,
        role TEXT NOT NULL
    );
    CREATE TABLE IF NOT EXISTS expenses (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NUL
        amount INTEGER NOT NULL,
        datetime DATETIME NOT NULL,
        paymenttype TEXT NOT NULL
    );";

    $pdo->exec($query);
} catch (PDOException $e) {
    die("Поврзувањето со базата на податоци не успеа: " .
        "Message: " . $e->getMessage() . "\n" .
        "Code: " . $e->getCode() . "\n" .
        "File: " . $e->getFile() . "\n" .
        "Line: " . $e->getLine() . "\n" .
        "Trace: " . $e->getTraceAsString());}
?>