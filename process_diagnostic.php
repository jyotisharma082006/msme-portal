<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'db_connect.php';
session_start();

// Ensure the request is a POST submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Collect enterprise profile data
        $company_name = $_POST['company_name'] ?? 'Unknown Company';
        $owner_name = $_POST['owner_name'] ?? 'Unknown Owner';
        $email = $_POST['email'] ?? '';
        $sector = $_POST['sector'] ?? 'General';
        $employee_count = $_POST['employee_count'] ?? '1-10';
        
        // Calculate pillar averages from the 15 professional questions securely
        $score_financial = isset($_POST['q1'], $_POST['q2'], $_POST['q3']) 
            ? (intval($_POST['q1']) + intval($_POST['q2']) + intval($_POST['q3'])) / 3 
            : 50;

        $score_operations = isset($_POST['q4'], $_POST['q5'], $_POST['q6']) 
            ? (intval($_POST['q4']) + intval($_POST['q5']) + intval($_POST['q6'])) / 3 
            : 50;

        $score_digital = isset($_POST['q7'], $_POST['q8'], $_POST['q9']) 
            ? (intval($_POST['q7']) + intval($_POST['q8']) + intval($_POST['q9'])) / 3 
            : 50;

        $score_market = isset($_POST['q10'], $_POST['q11']) 
            ? (intval($_POST['q10']) + intval($_POST['q11'])) / 2 
            : 50;

        $score_supply = isset($_POST['q12'], $_POST['q13']) 
            ? (intval($_POST['q12']) + intval($_POST['q13'])) / 2 
            : 50;

        $score_compliance = isset($_POST['q14'], $_POST['q15']) 
            ? (intval($_POST['q14']) + intval($_POST['q15'])) / 2 
            : 50;

        // Calculate overall score percentage
        $overall_score = ($score_financial + $score_operations + $score_digital + $score_market + $score_supply + $score_compliance) / 6;

        // Save results to Database securely using prepared statement
        $stmt = $pdo->prepare("INSERT INTO diagnostic_submissions 
            (company_name, owner_name, email, sector, employee_count, score_financial, score_operations, score_digital, score_market, score_supply, score_compliance, overall_score) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        $stmt->execute([
            $company_name, 
            $owner_name, 
            $email, 
            $sector, 
            $employee_count, 
            $score_financial, 
            $score_operations, 
            $score_digital, 
            $score_market, 
            $score_supply, 
            $score_compliance, 
            $overall_score
        ]);

    } catch (PDOException $e) {
        // If database insertion fails, stop and show the error message
        die("<div style='background:#fee2e2; color:#991b1b; padding:20px; font-family:sans-serif; margin:20px; border-radius:8px;'>
                <h3>Database Error:</h3>
                <p>" . htmlspecialchars($e->getMessage()) . "</p>
                <a href='diagnostic.php'>Go Back to Diagnostic Test</a>
             </div>");
    }
} else {
    // If someone visits process_diagnostic.php directly without submitting the form
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diagnostic Report - <?php echo htmlspecialchars($company_name); ?></title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

    <!-- Nav -->
    <nav class="bg-[#e2e8f0] border-b border-slate-300 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 h-16 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="w-9 h-9 rounded-xl neu-flat flex items-center justify-center text-indigo-600 font-bold">
                    <i class="fa-solid fa-chart-line"></i>
                </div>
                <span class="font-bold text-base text-slate-800">MSME<span class="text-indigo-600">Transform</span></span>
            </div>
            <a href="index.php" class="text-xs font-semibold neu-button text-slate-700 px-4 py-2 rounded-xl transition">
                <i class="fa-solid fa-house mr-1.5"></i> Back to Home
            </a>
        </div>
    </nav>

    <div class="max-w-5xl mx-auto px-4 py-12 flex-grow">
        <!-- Report Header -->
        <div class="neu-flat rounded-3xl p-8 mb-8 flex flex-col md:flex-row justify-between items-center gap-6">
            <div>
                <span class="text-xs uppercase font-bold text-indigo-600 neu-pressed px-3.5 py-1.5 rounded-full inline-block">Assessment Result</span>
                <h1 class="text-3xl font-black text-slate-800 mt-3"><?php echo htmlspecialchars($company_name); ?></h1>
                <p class="text-slate-500 text-sm mt-1">Sector: <span class="text-slate-700 font-medium"><?php echo htmlspecialchars($sector); ?></span> • Evaluated for: <span class="text-slate-700 font-medium"><?php echo htmlspecialchars($owner_name); ?></span></p>
            </div>
            <div class="text-center neu-pressed p-6 rounded-2xl min-w-[200px]">
                <span class="text-xs text-slate-500 uppercase tracking-wider font-semibold">Overall Score</span>
                <div class="text-4xl font-black text-indigo-600 mt-1"><?php echo round($overall_score, 1); ?>%</div>
                <span class="text-xs text-slate-600 mt-2 inline-block neu-flat px-3 py-1 rounded-md">
                    <?php 
                        if ($overall_score >= 80) echo "Leader in Digital Maturity";
                        elseif ($overall_score >= 60) echo "Progressing & Stable";
                        else echo "High Transformation Potential";
                    ?>
                </span>
            </div>
        </div>

        <!-- Grid Layout for Chart & Recommendations -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
            <!-- Radar Chart Card -->
            <div class="neu-flat rounded-3xl p-6 sm:p-8 flex flex-col justify-center items-center">
                <h3 class="font-bold text-slate-800 mb-6 text-base flex items-center self-start">
                    <i class="fa-solid fa-chart-pie text-indigo-600 mr-2"></i>Pillar Performance Breakdown
                </h3>
                <div class="w-full max-w-xs sm:max-w-sm">
                    <canvas id="radarChart"></canvas>
                </div>
            </div>

            <!-- Strategic Recommendations -->
            <div class="neu-flat rounded-3xl p-6 sm:p-8">
                <h3 class="font-bold text-slate-800 mb-6 text-base flex items-center">
                    <i class="fa-solid fa-lightbulb text-amber-500 mr-2"></i>Strategic Recommendations
                </h3>
                <ul class="space-y-4 text-sm text-slate-600">
                    <?php if($score_financial < 70): ?>
                        <li class="p-4 rounded-2xl neu-pressed">
                            <strong class="text-slate-800">Financial Health:</strong> Adopt automated cloud accounting software to project cash flows and avoid working capital crunches.
                        </li>
                    <?php endif; ?>
                    <?php if($score_operations < 70): ?>
                        <li class="p-4 rounded-2xl neu-pressed">
                            <strong class="text-slate-800">Operations:</strong> Replace manual spreadsheets with an integrated lightweight ERP system to eliminate data silos.
                        </li>
                    <?php endif; ?>
                    <?php if($score_digital < 70): ?>
                        <li class="p-4 rounded-2xl neu-pressed">
                            <strong class="text-slate-800">Digital Security:</strong> Implement multi-factor authentication (MFA) and routine encrypted cloud backups.
                        </li>
                    <?php endif; ?>
                    <?php if($score_market < 70): ?>
                        <li class="p-4 rounded-2xl neu-pressed">
                            <strong class="text-slate-800">Market Reach:</strong> Modernize your web portal and initiate B2B digital lead generation campaigns.
                        </li>
                    <?php endif; ?>
                    <?php if($overall_score >= 70): ?>
                        <li class="p-4 rounded-2xl neu-pressed">
                            <strong class="text-slate-800">Great Standing:</strong> Your organization has a solid baseline. Consider AI-driven automation and IoT analytics to scale further.
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="roadmap.php" class="neu-button bg-[#e2e8f0] text-indigo-600 font-bold px-8 py-3.5 rounded-xl transition text-center text-sm">
                Generate Transformation Roadmap <i class="fa-solid fa-arrow-right ml-2"></i>
            </a>
            <a href="diagnostic.php" class="neu-button bg-[#e2e8f0] text-slate-700 font-bold px-6 py-3.5 rounded-xl transition text-center text-sm">
                Retake Assessment
            </a>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('radarChart').getContext('2d');
        const radarChart = new Chart(ctx, {
            type: 'radar',
            data: {
                labels: ['Financial', 'Operations', 'Digital Security', 'Market Presence', 'Supply Chain', 'Compliance'],
                datasets: [{
                    label: 'Score (%)',
                    data: [
                        <?php echo round($score_financial, 1); ?>,
                        <?php echo round($score_operations, 1); ?>,
                        <?php echo round($score_digital, 1); ?>,
                        <?php echo round($score_market, 1); ?>,
                        <?php echo round($score_supply, 1); ?>,
                        <?php echo round($score_compliance, 1); ?>
                    ],
                    backgroundColor: 'rgba(79, 70, 229, 0.2)',
                    borderColor: 'rgb(79, 70, 229)',
                    borderWidth: 2,
                    pointBackgroundColor: 'rgb(245, 158, 11)',
                    pointBorderColor: '#e2e8f0',
                }]
            },
            options: {
                scales: {
                    r: {
                        grid: { color: 'rgba(148, 163, 184, 0.4)' },
                        angleLines: { color: 'rgba(148, 163, 184, 0.4)' },
                        pointLabels: { color: '#475569', font: { size: 11, weight: '600' } },
                        ticks: { display: false, suggestedMin: 0, suggestedMax: 100 }
                    }
                },
                plugins: { legend: { display: false } }
            }
        });
    </script>
</body>
</html>