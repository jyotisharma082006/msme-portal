<?php
require_once 'db_connect.php';
$roadmapGenerated = false;
$milestones = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $company_name = $_POST['company_name'];
    $target_goal = $_POST['target_goal'];
    $timeline = $_POST['timeline'];

    if ($target_goal == 'Automation') {
        $milestones = [
            "Month 1-2: Workflow Audit & Bottleneck Identification",
            "Month 3-4: Cloud ERP Implementation & Staff Training",
            "Month 5-6: Automated Inventory & Invoicing Integration",
            "Month 7+: Performance Review & Optimization"
        ];
    } elseif ($target_goal == 'E-Commerce') {
        $milestones = [
            "Month 1: Digital Product Catalog Digitization",
            "Month 2-3: B2B/B2C E-Commerce Portal Development",
            "Month 4: Payment Gateway & Logistics API Integration",
            "Month 5+: Digital Marketing & SEO Optimization"
        ];
    } else {
        $milestones = [
            "Month 1: Cybersecurity Assessment & Firewall Upgrades",
            "Month 2: Data Migration to Encrypted Cloud Storage",
            "Month 3: Employee Cyber-Hygiene & Phishing Training",
            "Month 4+: Continuous Vulnerability Monitoring"
        ];
    }

    $milestones_json = json_encode($milestones);
    $stmt = $pdo->prepare("INSERT INTO roadmaps (company_name, target_goal, timeline, milestones) VALUES (?, ?, ?, ?)");
    $stmt->execute([$company_name, $target_goal, $timeline, $milestones_json]);
    $roadmapGenerated = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transformation Roadmap Generator - Neumorphic UI</title>
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
    <!-- Navbar -->
    <nav class="bg-[#e2e8f0] border-b border-slate-300 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 h-16 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="w-9 h-9 rounded-xl neu-flat flex items-center justify-center text-indigo-600 font-bold">
                    <i class="fa-solid fa-chart-line"></i>
                </div>
                <span class="font-bold text-base text-slate-800">MSME<span class="text-indigo-600">Transform</span></span>
            </div>
            <div class="hidden md:flex space-x-3 font-medium text-sm">
                <a href="index.php" class="px-4 py-2 rounded-xl neu-flat text-slate-600 hover:text-indigo-600 transition">Diagnostic Tool</a>
                <a href="roadmap.php" class="px-4 py-2 rounded-xl neu-pressed text-indigo-600">Roadmap Generator</a>
                <a href="resources.php" class="px-4 py-2 rounded-xl neu-flat text-slate-600 hover:text-indigo-600 transition">Resource Library</a>
                <a href="admin.php" class="px-4 py-2 rounded-xl neu-flat text-slate-600 hover:text-indigo-600 transition">Admin Portal</a>
            </div>
        </div>
    </nav>

    <div class="max-w-3xl mx-auto px-4 py-12 flex-grow">
        <div class="neu-flat rounded-3xl p-8 sm:p-10">
            <h1 class="text-2xl font-black text-slate-800 mb-2">Transformation Roadmap Generator</h1>
            <p class="text-slate-500 text-sm mb-8">Build a custom milestone schedule tailored precisely to your core business goals.</p>

            <form method="POST" class="space-y-6">
                <div>
                    <label class="block text-xs font-semibold uppercase text-slate-500 mb-2">Company Name</label>
                    <input type="text" name="company_name" required placeholder="e.g. Apex Industries" class="w-full px-4 py-3 rounded-xl neu-flat bg-[#e2e8f0] border-none text-slate-700 focus:outline-none text-sm">
                </div>
                <div>
                    <label class="block text-xs font-semibold uppercase text-slate-500 mb-2">Primary Transformation Goal</label>
                    <select name="target_goal" class="w-full px-4 py-3 rounded-xl neu-flat bg-[#e2e8f0] border-none text-slate-700 focus:outline-none text-sm">
                        <option value="Automation">Process Automation & ERP Integration</option>
                        <option value="E-Commerce">E-Commerce & Digital Sales Channel</option>
                        <option value="Cybersecurity">Cybersecurity & Cloud Security Upgrade</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold uppercase text-slate-500 mb-2">Desired Timeline</label>
                    <select name="timeline" class="w-full px-4 py-3 rounded-xl neu-flat bg-[#e2e8f0] border-none text-slate-700 focus:outline-none text-sm">
                        <option value="6 Months">6 Months Fast-Track</option>
                        <option value="12 Months">12 Months Comprehensive</option>
                    </select>
                </div>
                <button type="submit" class="neu-button w-full text-indigo-600 font-bold px-8 py-3.5 rounded-xl transition text-sm">
                    Generate Custom Roadmap
                </button>
            </form>

            <?php if ($roadmapGenerated): ?>
                <div class="mt-10 p-6 neu-pressed rounded-2xl">
                    <h3 class="text-base font-bold text-slate-800 mb-4 flex items-center">
                        <i class="fa-solid fa-map-location-dot text-amber-500 mr-2"></i>Generated Milestone Plan
                    </h3>
                    <ul class="space-y-3">
                        <?php foreach ($milestones as $m): ?>
                            <li class="flex items-center space-x-3 neu-flat p-3.5 rounded-xl text-sm text-slate-700">
                                <i class="fa-solid fa-check-circle text-emerald-600"></i>
                                <span><?php echo htmlspecialchars($m); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>