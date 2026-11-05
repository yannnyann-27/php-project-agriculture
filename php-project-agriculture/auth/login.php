<?php
session_start();
if (isset($_SESSION['user_id'])) { header("Location: ../index.php"); exit; }

// PROTOTYPE users (real version reads the users table and uses password_verify)
$users = [
    ['user_id' => 1, 'username' => 'admin', 'role' => 'admin', 'password_hash' => password_hash('admin123', PASSWORD_DEFAULT)],
    ['user_id' => 2, 'username' => 'staff', 'role' => 'staff', 'password_hash' => password_hash('staff123', PASSWORD_DEFAULT)],
];

$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = (string) trim($_POST['username'] ?? '');
    $password = (string) ($_POST['password'] ?? '');

    if ($username === '' || $password === '') {
        $error = "Please enter your username and password.";
    } else {
        foreach ($users as $user) {
            if ($user['username'] === $username && password_verify($password, $user['password_hash'])) {
                $_SESSION['user_id']  = $user['user_id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role']     = $user['role'];
                header("Location: ../index.php");
                exit;
            }
        }
        $error = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Agriculture Information System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-50 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white w-full max-w-sm p-8 rounded-lg shadow">
        <h1 class="text-2xl font-bold text-green-700 text-center">Agriculture Information System</h1>
        <p class="text-sm text-gray-500 text-center mb-6">Please log in to continue</p>

        <?php if ($error): ?>
            <div class="mb-4 p-3 text-sm rounded bg-red-100 text-red-800 border border-red-400"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" class="space-y-4">
            <div>
                <label class="block text-sm font-medium mb-1">Username</label>
                <input type="text" name="username" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-green-500" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Password</label>
                <input type="password" name="password" class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-green-500" required>
            </div>
            <button type="submit" class="w-full bg-green-700 hover:bg-green-800 text-white py-2 rounded">Login</button>
        </form>

        <p class="text-xs text-gray-500 mt-6 text-center">
            Demo accounts: <b>admin / admin123</b> &middot; <b>staff / staff123</b>
        </p>
    </div>
</body>
</html>
