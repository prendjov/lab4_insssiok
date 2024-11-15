<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">
    <title>Add Expense</title>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Add Expense</h1>
    <form action="add_expense.php" method="POST">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name" id="name" required placeholder="Enter expense name">
        </div>
        <div class="form-group">
            <label for="amount">Amount:</label>
            <input type="number" class="form-control" name="amount" id="amount" required placeholder="Enter expense amount" min="0">
        </div>
        <div class="form-group">
            <label for="datetime">Date and Time:</label>
            <input type="datetime-local" class="form-control" name="datetime" id="datetime" required>
        </div>
        <div class="form-group">
            <label for="paymenttype">Payment Type:</label>
            <select class="form-control" name="paymenttype" id="paymenttype" required>
                <option value="">Select Payment Type</option>
                <option value="Cash">Cash</option>
                <option value="Credit Card">Credit Card</option>
                <option value="Bank Transfer">Bank Transfer</option>
                <option value="Other">Other</option>
            </select>
        </div>
        <div class="form-group">
            <a class="btn btn-danger" href="index.php">Go Back</a>
            <button type="submit" class="btn btn-success">Add Expense</button>
        </div>
    </form>
</div>
</body>
</html>
