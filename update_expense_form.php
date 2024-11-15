<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Update Expense</title>
</head>
<body>
<h1 class="mx-5 my-4">Update Expense</h1>

<?php if (isset($expense) && $expense): ?>
    <form class="mx-5" action="update_expense.php" method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($expense['id']); ?>">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name" id="name" value="<?php echo htmlspecialchars($expense['name']); ?>" required>
        </div>
        <div class="form-group">
            <label for="amount">Amount:</label>
            <input type="number" class="form-control" name="amount" id="amount" value="<?php echo htmlspecialchars($expense['amount']); ?>" required>
        </div>
        <div class="form-group">
            <label for="datetime">Date and Time:</label>
            <input type="datetime-local" class="form-control" name="datetime" id="datetime" value="<?php echo date('Y-m-d\TH:i', strtotime($expense['datetime'])); ?>" required>
        </div>
        <div class="form-group">
            <label for="paymenttype">Payment Type:</label>
            <select class="form-control" name="paymenttype" id="paymenttype" required>
                <option value="Cash" <?php echo $expense['paymenttype'] === 'Cash' ? 'selected' : ''; ?>>Cash</option>
                <option value="Credit Card" <?php echo $expense['paymenttype'] === 'Credit Card' ? 'selected' : ''; ?>>Credit Card</option>
                <option value="Bank Transfer" <?php echo $expense['paymenttype'] === 'Bank Transfer' ? 'selected' : ''; ?>>Bank Transfer</option>
                <option value="Other" <?php echo $expense['paymenttype'] === 'Other' ? 'selected' : ''; ?>>Other</option>
            </select>
        </div>
        <div class="form-group">
            <a class="btn btn-danger" href="index.php">Go Back</a>
            <button type="submit" class="btn btn-success">Update Expense</button>
        </div>
    </form>
<?php else: ?>
    <p>Expense not found.</p>
<?php endif; ?>
</body>
</html>
