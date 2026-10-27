<?php
require_once 'db_connect.php';

$stmt = $pdo->query("SELECT * FROM diagnostic_submissions ORDER BY created_at DESC");
$submissions = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal - MSME Submissions</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #e2e8f0; color: #334155; }
        .neu-flat { background: #e2e8f0; box-shadow: 8px 8px 16px #cbd5e1, -8px -8px 16px #ffffff; }
        .neu-pressed { background: #e2e8f0; box-shadow: inset 4px 4px 8px #cbd5e1, inset -4px -4px 8px #ffffff; }
        .neu-button { background: #e2e8f0; box-shadow: 5px 5px 10px #cbd5e1, -5px -5px 10px #ffffff; transition: all 0.2s ease; }
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
                <span class="font-bold text-base text-slate-800">MSME<span class="text-indigo-600">Transform</span> <span class="text-xs px-2 py-0.5 rounded neu-pressed text-indigo-600 ml-2">Admin</span></span>
            </div>
            <div class="hidden md:flex space-x-3 font-medium text-sm">
                <a href="index.php" class="px-4 py-2 rounded-xl neu-flat text-slate-600 hover:text-indigo-600 transition">Diagnostic Tool</a>
                <a href="roadmap.php" class="px-4 py-2 rounded-xl neu-flat text-slate-600 hover:text-indigo-600 transition">Roadmap Generator</a>
                <a href="resources.php" class="px-4 py-2 rounded-xl neu-flat text-slate-600 hover:text-indigo-600 transition">Resource Library</a>
                <a href="admin.php" class="px-4 py-2 rounded-xl neu-pressed text-indigo-600">Admin Portal</a>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 py-12 flex-grow w-full">
        <div class="neu-flat rounded-3xl p-6 sm:p-8">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
                <div>
                    <h1 class="text-2xl font-black text-slate-800">Diagnostic Submissions Database</h1>
                    <p class="text-slate-500 text-sm mt-1">Manage and inspect health evaluations submitted by enterprises.</p>
                </div>
                <div class="neu-pressed px-4 py-2 rounded-xl text-xs font-semibold text-slate-600">
                    Total Submissions: <span class="text-indigo-600 font-bold ml-1"><?php echo count($submissions); ?></span>
                </div>
            </div>
            
            <div class="overflow-x-auto rounded-2xl neu-pressed p-4">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="text-slate-500 text-xs uppercase tracking-wider border-b border-slate-300">
                            <th class="p-4">Company</th>
                            <th class="p-4">Owner</th>
                            <th class="p-4">Sector</th>
                            <th class="p-4">Employees</th>
                            <th class="p-4">Overall Score</th>
                            <th class="p-4">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-300">
                        <?php if (count($submissions) > 0): ?>
                            <?php foreach ($submissions as $row): ?>
                                <tr class="hover:bg-slate-200/50 transition">
                                    <td class="p-4 font-bold text-slate-800"><?php echo htmlspecialchars($row['company_name']); ?></td>
                                    <td class="p-4 text-slate-600"><?php echo htmlspecialchars($row['owner_name']); ?></td>
                                    <td class="p-4 text-slate-600"><?php echo htmlspecialchars($row['sector']); ?></td>
                                    <td class="p-4 text-slate-600"><?php echo htmlspecialchars($row['employee_count']); ?></td>
                                    <td class="p-4 font-black text-indigo-600"><?php echo round($row['overall_score'], 1); ?>%</td>
                                    <td class="p-4 text-slate-400 text-xs"><?php echo $row['created_at']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="p-8 text-center text-slate-400">No submissions found in database.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>