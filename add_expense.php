<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $amount = (int)($_POST['amount'] ?? 0);
    $datetime = $_POST['datetime'] ?? '';
    $paymenttype = $_POST['paymenttype'] ?? '';

    if (empty($name) || $amount <= 0 || empty($datetime) || empty($paymenttype)) {
        echo "Please fill in all required fields correctly.";
        exit;
    }

    try {
        $dsn = 'sqlite:' . __DIR__ . '/database.sqlite';
        $db = new PDO($dsn);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $db->prepare("INSERT INTO expenses (name, amount, datetime, paymenttype) VALUES (:name, :amount, :datetime, :paymenttype)");
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':amount', $amount, PDO::PARAM_INT);
        $stmt->bindValue(':datetime', $datetime, PDO::PARAM_STR);
        $stmt->bindValue(':paymenttype', $paymenttype, PDO::PARAM_STR);

        $stmt->execute();

        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        echo "Error adding expense: " . $e->getMessage();
    }
} else {
    echo "Invalid request method. Please submit the form to add an expense.";
}
?>
