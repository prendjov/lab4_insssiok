<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    try {
        $id = intval($_POST['id']);
        $name = $_POST['name'] ?? '';
        $amount = intval($_POST['amount'] ?? 0);
        $datetime = $_POST['datetime'] ?? '';
        $paymenttype = $_POST['paymenttype'] ?? '';

        if (empty($name) || $amount <= 0 || empty($datetime) || empty($paymenttype)) {
            echo "Please fill in all required fields correctly.";
            exit;
        }

        $dsn = 'sqlite:' . __DIR__ . '/database.sqlite';
        $db = new PDO($dsn);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Enable exceptions for errors

        $stmt = $db->prepare("
            UPDATE expenses 
            SET name = :name, amount = :amount, datetime = :datetime, paymenttype = :paymenttype 
            WHERE id = :id
        ");
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':amount', $amount, PDO::PARAM_INT);
        $stmt->bindValue(':datetime', $datetime, PDO::PARAM_STR);
        $stmt->bindValue(':paymenttype', $paymenttype, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        echo "Error updating expense: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}
?>
