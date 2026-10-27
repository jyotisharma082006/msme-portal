<?php
require_once 'db_connect.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MSME Business Diagnostic & Digital Transformation Portal</title>
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
<body class="font-sans antialiased min-h-screen flex flex-col">

    <!-- Navigation Bar -->
    <nav class="bg-[#e2e8f0] border-b border-slate-300 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-xl neu-flat flex items-center justify-center text-indigo-600 font-bold text-lg">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                    <span class="font-bold text-lg tracking-wide text-slate-800">MSME<span class="text-indigo-600">Transform</span></span>
                </div>
                <div class="hidden md:flex space-x-3 font-medium text-sm items-center">
                    <a href="index.php" class="px-4 py-2 rounded-xl neu-pressed text-indigo-600">Home</a>
                    <a href="diagnostic.php" class="px-4 py-2 rounded-xl neu-flat text-slate-600 hover:text-indigo-600 transition">Diagnostic Tool</a>
                    <a href="roadmap.php" class="px-4 py-2 rounded-xl neu-flat text-slate-600 hover:text-indigo-600 transition">Roadmap</a>
                    <a href="resources.php" class="px-4 py-2 rounded-xl neu-flat text-slate-600 hover:text-indigo-600 transition">Resources</a>
                    <?php if(isset($_SESSION['user_id'])): ?>
                        <span class="text-xs font-bold text-slate-700 neu-pressed px-3 py-1.5 rounded-xl ml-2"><i class="fa-solid fa-user-check text-emerald-600 mr-1"></i> <?php echo htmlspecialchars($_SESSION['company_name']); ?></span>
                        <a href="logout.php" class="px-3 py-1.5 rounded-xl neu-button text-red-600 text-xs font-bold">Logout</a>
                    <?php else: ?>
                        <a href="auth.php" class="px-4 py-2 rounded-xl neu-button text-indigo-600 font-bold">Login / Register</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section with Feature Image -->
    <header class="py-16 px-4">
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div>
                <span class="neu-flat px-4 py-2 rounded-full text-indigo-600 text-xs font-bold uppercase tracking-wider inline-block mb-6">
                    <i class="fa-solid fa-shield-halved mr-1.5 text-amber-500"></i>Secure Enterprise Evaluation
                </span>
                <h1 class="text-4xl sm:text-5xl font-black tracking-tight mb-6 text-slate-800 leading-tight">
                    Smart Business Diagnostic & <span class="text-indigo-600">Digital Transformation</span>
                </h1>
                <p class="text-base text-slate-600 mb-8 leading-relaxed">
                    Evaluate your business health across 6 core operational pillars, uncover critical vulnerabilities, and generate secure customized transformation roadmaps.
                </p>
                <div class="flex gap-4">
                    <a href="diagnostic.php" class="neu-button px-8 py-4 rounded-xl text-indigo-600 font-bold inline-flex items-center text-sm">
                        Start Diagnostic Test <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                    </a>
                    <?php if(!isset($_SESSION['user_id'])): ?>
                        <a href="auth.php" class="neu-pressed px-6 py-4 rounded-xl text-slate-700 font-bold inline-flex items-center text-sm">
                            Register Company
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="neu-flat p-4 rounded-3xl">
                <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=800&q=80" alt="Business Analytics Dashboard" class="rounded-2xl w-full h-[320px] object-cover shadow-sm">
            </div>
        </div>
    </header>

    <!-- Visual Feature Grid Section -->
    <section class="max-w-6xl mx-auto px-4 py-12">
        <div class="text-center mb-12">
            <h2 class="text-2xl font-black text-slate-800">Core Operational Pillars</h2>
            <p class="text-slate-500 text-sm mt-1">Our secure diagnostic platform evaluates enterprises across key sectors.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="neu-flat rounded-3xl p-6">
                <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=500&q=80" alt="Financial Analytics" class="rounded-2xl w-full h-40 object-cover mb-4">
                <h3 class="font-bold text-slate-800 text-base mb-2">Financial Health</h3>
                <p class="text-xs text-slate-500">Analyze working capital buffers, cash flow forecasting, and accounting automation.</p>
            </div>
            <div class="neu-flat rounded-3xl p-6">
                <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=500&q=80" alt="Operations" class="rounded-2xl w-full h-40 object-cover mb-4">
                <h3 class="font-bold text-slate-800 text-base mb-2">Operational Automation</h3>
                <p class="text-xs text-slate-500">Measure ERP integration, workflow digitization, and operational efficiency.</p>
            </div>
            <div class="neu-flat rounded-3xl p-6">
                <img src="https://images.unsplash.com/photo-1563986768609-322da13575f3?auto=format&fit=crop&w=500&q=80" alt="Security" class="rounded-2xl w-full h-40 object-cover mb-4">
                <h3 class="font-bold text-slate-800 text-base mb-2">Digital Security</h3>
                <p class="text-xs text-slate-500">Evaluate cloud encryption, backup reliability, and firewall protection protocols.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-[#cbd5e1]/40 text-slate-600 py-8 text-center text-xs border-t border-slate-300 mt-auto">
        <p>&copy; 2026 MSME Transformation Portal. Securely protected.</p>
    </footer>

</body>
</html>