<?php
require_once 'db_connect.php';
session_start();

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    if ($action === 'register') {
        $company_name = trim($_POST['company_name']);
        $owner_name = trim($_POST['owner_name']);
        $email = trim($_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        // Check if email exists
        $check = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $check->execute([$email]);
        if ($check->rowCount() > 0) {
            $error = "Email already registered. Please login.";
        } else {
            $stmt = $pdo->prepare("INSERT INTO users (company_name, owner_name, email, password) VALUES (?, ?, ?, ?)");
            if ($stmt->execute([$company_name, $owner_name, $email, $password])) {
                $success = "Registration successful! Please login below.";
            } else {
                $error = "Registration failed. Try again.";
            }
        }
    } elseif ($action === 'login') {
        $email = trim($_POST['email']);
        $password = $_POST['password'];

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['company_name'] = $user['company_name'];
            $_SESSION['owner_name'] = $user['owner_name'];
            header("Location: index.php");
            exit();
        } else {
            $error = "Invalid email or password.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Access - MSME Transform</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #e2e8f0; color: #334155; }
        .neu-flat { background: #e2e8f0; box-shadow: 8px 8px 16px #cbd5e1, -8px -8px 16px #ffffff; }
        .neu-pressed { background: #e2e8f0; box-shadow: inset 4px 4px 8px #cbd5e1, inset -4px -4px 8px #ffffff; }
        .neu-button { background: #e2e8f0; box-shadow: 5px 5px 10px #cbd5e1, -5px -5px 10px #ffffff; transition: all 0.2s ease; }
        .neu-button:hover { box-shadow: 2px 2px 5px #cbd5e1, -2px -2px 5px #ffffff; }
    </style>
</head>
<body class="font-sans antialiased min-h-screen flex items-center justify-center py-12 px-4">
    <div class="max-w-md w-full neu-flat rounded-3xl p-8">
        <div class="text-center mb-8">
            <div class="w-12 h-12 rounded-2xl neu-flat flex items-center justify-center text-indigo-600 font-bold text-xl mx-auto mb-3">
                <i class="fa-solid fa-lock"></i>
            </div>
            <h1 class="text-2xl font-black text-slate-800">Secure Portal Access</h1>
            <p class="text-slate-500 text-xs mt-1">Register or login to access the diagnostic testing suite.</p>
        </div>

        <?php if($error): ?>
            <div class="mb-4 p-3 rounded-xl neu-pressed text-red-600 text-xs text-center font-bold">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        <?php if($success): ?>
            <div class="mb-4 p-3 rounded-xl neu-pressed text-emerald-600 text-xs text-center font-bold">
                <?php echo $success; ?>
            </div>
        <?php endif; ?>

        <!-- Tabs -->
        <div class="flex mb-6 neu-pressed p-1 rounded-xl">
            <button onclick="switchTab('login')" id="btn-login" class="flex-1 py-2 text-xs font-bold rounded-lg text-indigo-600 bg-[#e2e8f0] shadow-sm transition">Login</button>
            <button onclick="switchTab('register')" id="btn-register" class="flex-1 py-2 text-xs font-bold rounded-lg text-slate-500 transition">Register</button>
        </div>

        <!-- Login Form -->
        <form id="form-login" method="POST" class="space-y-4">
            <input type="hidden" name="action" value="login">
            <div>
                <label class="block text-xs font-semibold uppercase text-slate-500 mb-1">Email Address</label>
                <input type="email" name="email" required class="w-full px-4 py-3 rounded-xl neu-flat bg-[#e2e8f0] border-none text-slate-700 focus:outline-none text-sm">
            </div>
            <div>
                <label class="block text-xs font-semibold uppercase text-slate-500 mb-1">Password</label>
                <input type="password" name="password" required class="w-full px-4 py-3 rounded-xl neu-flat bg-[#e2e8f0] border-none text-slate-700 focus:outline-none text-sm">
            </div>
            <button type="submit" class="neu-button w-full text-indigo-600 font-bold py-3.5 rounded-xl transition text-sm mt-2">
                Secure Login <i class="fa-solid fa-arrow-right ml-1"></i>
            </button>
        </form>

        <!-- Register Form -->
        <form id="form-register" method="POST" class="space-y-4 hidden">
            <input type="hidden" name="action" value="register">
            <div>
                <label class="block text-xs font-semibold uppercase text-slate-500 mb-1">Company Name</label>
                <input type="text" name="company_name" required class="w-full px-4 py-3 rounded-xl neu-flat bg-[#e2e8f0] border-none text-slate-700 focus:outline-none text-sm">
            </div>
            <div>
                <label class="block text-xs font-semibold uppercase text-slate-500 mb-1">Owner / Contact Name</label>
                <input type="text" name="owner_name" required class="w-full px-4 py-3 rounded-xl neu-flat bg-[#e2e8f0] border-none text-slate-700 focus:outline-none text-sm">
            </div>
            <div>
                <label class="block text-xs font-semibold uppercase text-slate-500 mb-1">Email Address</label>
                <input type="email" name="email" required class="w-full px-4 py-3 rounded-xl neu-flat bg-[#e2e8f0] border-none text-slate-700 focus:outline-none text-sm">
            </div>
            <div>
                <label class="block text-xs font-semibold uppercase text-slate-500 mb-1">Password</label>
                <input type="password" name="password" required class="w-full px-4 py-3 rounded-xl neu-flat bg-[#e2e8f0] border-none text-slate-700 focus:outline-none text-sm">
            </div>
            <button type="submit" class="neu-button w-full text-indigo-600 font-bold py-3.5 rounded-xl transition text-sm mt-2">
                Register Company <i class="fa-solid fa-user-plus ml-1"></i>
            </button>
        </form>
        
        <div class="mt-6 text-center">
            <a href="index.php" class="text-xs text-slate-500 hover:text-indigo-600 font-medium"><i class="fa-solid fa-house mr-1"></i> Back to Homepage</a>
        </div>
    </div>

    <script>
        function switchTab(tab) {
            if(tab === 'login') {
                document.getElementById('form-login').classList.remove('hidden');
                document.getElementById('form-register').classList.add('hidden');
                document.getElementById('btn-login').className = 'flex-1 py-2 text-xs font-bold rounded-lg text-indigo-600 bg-[#e2e8f0] shadow-sm transition';
                document.getElementById('btn-register').className = 'flex-1 py-2 text-xs font-bold rounded-lg text-slate-500 transition';
            } else {
                document.getElementById('form-register').classList.remove('hidden');
                document.getElementById('form-login').classList.add('hidden');
                document.getElementById('btn-register').className = 'flex-1 py-2 text-xs font-bold rounded-lg text-indigo-600 bg-[#e2e8f0] shadow-sm transition';
                document.getElementById('btn-login').className = 'flex-1 py-2 text-xs font-bold rounded-lg text-slate-500 transition';
            }
        }
    </script>
</body>
</html>