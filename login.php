<?php

session_start();
require 'jwt_helper.php';

if (isset($_SESSION['jwt']) && decodeJWT($_SESSION['jwt'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Најава</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.1/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="flex items-center justify-center min-h-screen bg-gradient-to-r from-blue-50 to-blue-100">
<div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">
    <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Најавете се</h2>
    <form action="login_handler.php" method="POST" class="space-y-6">
        <div>
            <label for="username" class="block text-sm font-semibold text-gray-700">Корисничко име</label>
            <input
                    type="text"
                    name="username"
                    id="username"
                    class="w-full p-3 mt-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none"
                    placeholder="Внесете корисничко име"
                    required>
        </div>
        <div>
            <label for="password" class="block text-sm font-semibold text-gray-700">Лозинка</label>
            <input
                    type="password"
                    name="password"
                    id="password"
                    class="w-full p-3 mt-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none"
                    placeholder="Внесете лозинка"
                    required>
        </div>
        <button
                type="submit"
                class="w-full py-3 text-white bg-blue-500 rounded-lg hover:bg-blue-600 focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 transition">
            Најави се
        </button>
        <p class="text-sm text-center text-gray-600 mt-4">
            Немате акаунт?
            <a href="register.php" class="text-blue-500 hover:underline">Регистрирајте се тука</a>
        </p>
    </form>
</div>
</body>
</html>
