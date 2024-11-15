<?php
session_start();
require 'jwt_helper.php';

if (!isset($_SESSION['jwt']) || !decodeJWT($_SESSION['jwt'])) {
    header("Location: login.php");
    exit();
}

try {
    $dsn = 'sqlite:' . __DIR__ . '/database.sqlite';
    $db = new PDO($dsn);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $db->prepare("SELECT * FROM expenses ORDER BY datetime DESC");
    $stmt->execute();
    $expenses = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="mk">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Контролна табла</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-900 font-sans">

<div class="flex items-center justify-center min-h-screen">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-4xl">
        <h1 class="text-3xl font-semibold text-center text-green-600 mb-4">Добредојдовте на контролната табла!</h1>

        <p class="text-center text-lg mb-6">Вашата најава беше успешна. Добредојдовте!</p>

        <div class="text-right mb-4">
            <a href="add_expense_form.php" class="text-white bg-ble-500 hover:bg-blue-600 px-4 py-2 rounded-md text-lg">
                Додади трошок
            </a>
        </div>

        <div class="mb-6">
            <table class="table-auto w-full bg-gray-50 shadow-md rounded-lg">
                <thead>
                <tr class="bg-green-500 text-white">
                    <th class="px-4 py-2">Име</th>
                    <th class="px-4 py-2">Износ</th>
                    <th class="px-4 py-2">Датум и време</th>
                    <th class="px-4 py-2">Тип на плаќање</th>
                </tr>
                </thead>
                <tbody>
                <?php if (!empty($expenses)): ?>
                    <?php foreach ($expenses as $expense): ?>
                        <tr class="text-center border-b">
                            <td class="px-4 py-2"><?php echo htmlspecialchars($expense['name']); ?></td>
                            <td class="px-4 py-2"><?php echo htmlspecialchars($expense['amount']); ?> ден</td>
                            <td class="px-4 py-2"><?php echo htmlspecialchars($expense['datetime']); ?></td>
                            <td class="px-4 py-2"><?php echo htmlspecialchars($expense['paymenttype']); ?></td>
                            <a href="update_expense.php?id=<?php echo $expense['id']; ?>"
                               class="text-white bg-yellow-500 hover:bg-yellow-600 px-2 py-1 rounded-md text-sm">
                                Промени
                            </a>
                            <a href="delete_expense.php?id=<?php echo $expense['id']; ?>"
                               onclick="return confirm('Дали сте сигурни дека сакате да го избришете овој трошок?');"
                               class="text-white bg-red-500 hover:bg-red-600 px-2 py-1 rounded-md text-sm">
                                Избриши
                            </a>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center text-gray-500 py-4">Нема внесени трошоци.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="text-center">
            <a href="logout_handler.php" class="text-white bg-red-500 hover:bg-red-600 px-4 py-2 rounded-md text-lg">
                Одјави се
            </a>
        </div>
    </div>
</div>

</body>

</html>
