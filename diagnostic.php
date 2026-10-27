<?php
require_once 'db_connect.php';
session_start();

// SECURITY CHECK: Company must be logged in to take the diagnostic test
if (!isset($_SESSION['user_id'])) {
    header("Location: auth.php?error=Please register or login first to access the diagnostic test.");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprehensive Diagnostic Assessment - MSME Transform</title>
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
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-xl neu-flat flex items-center justify-center text-indigo-600 font-bold text-lg">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                    <span class="font-bold text-lg tracking-wide text-slate-800">MSME<span class="text-indigo-600">Transform</span></span>
                </div>
                <div class="flex items-center space-x-3 text-sm">
                    <span class="text-xs font-bold text-emerald-600 neu-pressed px-3 py-1.5 rounded-xl"><i class="fa-solid fa-shield mr-1"></i> Authenticated: <?php echo htmlspecialchars($_SESSION['company_name']); ?></span>
                    <a href="index.php" class="px-4 py-2 rounded-xl neu-button text-slate-700">Home</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Header Banner with Image -->
    <header class="py-10 px-4 bg-[#cbd5e1]/20 border-b border-slate-300">
        <div class="max-w-4xl mx-auto flex flex-col md:flex-row items-center gap-6">
            <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=400&q=80" alt="Team Evaluation" class="rounded-2xl w-36 h-36 object-cover neu-flat p-1">
            <div>
                <span class="neu-pressed px-3 py-1 rounded-full text-indigo-600 text-xs font-bold uppercase tracking-wider inline-block mb-2">Comprehensive 15-Point Evaluation</span>
                <h1 class="text-2xl sm:text-3xl font-black text-slate-800">Enterprise Digital Health Assessment</h1>
                <p class="text-slate-500 text-xs mt-1">Provide accurate insights across all 6 operational pillars to generate your precision transformation report.</p>
            </div>
        </div>
    </header>

    <!-- Diagnostic Form Section -->
    <main class="max-w-4xl mx-auto px-4 py-12 flex-grow w-full">
        <div class="neu-flat rounded-3xl p-6 sm:p-12">
            <form id="diagnosticForm" action="process_diagnostic.php" method="POST" class="space-y-10">
                
                <!-- Enterprise Profile Card -->
                <div class="neu-pressed p-6 sm:p-8 rounded-2xl">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-indigo-600 mb-4 flex items-center">
                        <i class="fa-solid fa-building mr-2"></i> Enterprise Profile
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-semibold uppercase text-slate-500 mb-2">Company Name</label>
                            <input type="text" name="company_name" required value="<?php echo htmlspecialchars($_SESSION['company_name']); ?>" class="w-full px-4 py-3 rounded-xl neu-flat bg-[#e2e8f0] border-none text-slate-700 focus:outline-none text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold uppercase text-slate-500 mb-2">Owner / Contact Person</label>
                            <input type="text" name="owner_name" required value="<?php echo htmlspecialchars($_SESSION['owner_name']); ?>" class="w-full px-4 py-3 rounded-xl neu-flat bg-[#e2e8f0] border-none text-slate-700 focus:outline-none text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold uppercase text-slate-500 mb-2">Email Address</label>
                            <input type="email" name="email" required placeholder="name@company.com" class="w-full px-4 py-3 rounded-xl neu-flat bg-[#e2e8f0] border-none text-slate-700 focus:outline-none text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold uppercase text-slate-500 mb-2">Industry Sector</label>
                            <select name="sector" class="w-full px-4 py-3 rounded-xl neu-flat bg-[#e2e8f0] border-none text-slate-700 focus:outline-none text-sm">
                                <option value="Manufacturing">Manufacturing & Engineering</option>
                                <option value="Retail">Retail & E-Commerce</option>
                                <option value="IT Services">IT & Professional Services</option>
                                <option value="Healthcare">Healthcare & Pharmaceuticals</option>
                                <option value="Logistics">Logistics & Supply Chain</option>
                            </select>
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-semibold uppercase text-slate-500 mb-2">Employee Count</label>
                            <select name="employee_count" class="w-full px-4 py-3 rounded-xl neu-flat bg-[#e2e8f0] border-none text-slate-700 focus:outline-none text-sm">
                                <option value="1-10">Micro (1 - 10 employees)</option>
                                <option value="11-50">Small (11 - 50 employees)</option>
                                <option value="50-250">Medium (50 - 250 employees)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- 15 Professional Assessment Questions -->
                <div class="space-y-6">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-indigo-600">Detailed Pillar Evaluation (15 Professional Questions)</h3>
                    
                    <!-- PILLAR 1: FINANCIAL HEALTH (Q1 - Q3) -->
                    <div class="p-4 bg-indigo-500/10 rounded-xl font-bold text-indigo-700 text-xs uppercase tracking-wider">
                        Pillar 1: Financial Health & Working Capital
                    </div>

                    <!-- Q1 -->
                    <div class="p-6 neu-pressed rounded-2xl flex flex-col md:flex-row gap-4 items-center">
                        <img src="https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?auto=format&fit=crop&w=200&q=80" alt="Finance" class="w-24 h-24 rounded-xl object-cover neu-flat p-1 hidden sm:block">
                        <div class="flex-1 w-full">
                            <label class="block font-bold text-slate-800 text-sm mb-1">1. Cash Flow Visibility & Forecasting</label>
                            <p class="text-xs text-slate-500 mb-3">How frequently do you analyze projected cash inflows versus operational expenses?</p>
                            <select name="q1" class="w-full px-4 py-3 rounded-xl neu-flat bg-[#e2e8f0] border-none text-slate-700 text-xs outline-none">
                                <option value="40">Rarely / Only during financial crunches (Score: 40%)</option>
                                <option value="70">Monthly reviews with standard accounting tools (Score: 70%)</option>
                                <option value="100">Automated rolling 12-month forecasts (Score: 100%)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Q2 -->
                    <div class="p-6 neu-pressed rounded-2xl flex flex-col md:flex-row gap-4 items-center">
                        <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=200&q=80" alt="Budget" class="w-24 h-24 rounded-xl object-cover neu-flat p-1 hidden sm:block">
                        <div class="flex-1 w-full">
                            <label class="block font-bold text-slate-800 text-sm mb-1">2. Working Capital Buffer & Emergency Reserves</label>
                            <p class="text-xs text-slate-500 mb-3">What is your current liquidity buffer to sustain operations during delayed client payments?</p>
                            <select name="q2" class="w-full px-4 py-3 rounded-xl neu-flat bg-[#e2e8f0] border-none text-slate-700 text-xs outline-none">
                                <option value="40">Less than 30 days of operating reserves (Score: 40%)</option>
                                <option value="70">1 to 3 months of emergency operating capital (Score: 70%)</option>
                                <option value="100">3 to 6+ months buffer with instant credit lines (Score: 100%)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Q3 -->
                    <div class="p-6 neu-pressed rounded-2xl flex flex-col md:flex-row gap-4 items-center">
                        <img src="https://images.unsplash.com/photo-1563986768609-322da13575f3?auto=format&fit=crop&w=200&q=80" alt="Invoicing" class="w-24 h-24 rounded-xl object-cover neu-flat p-1 hidden sm:block">
                        <div class="flex-1 w-full">
                            <label class="block font-bold text-slate-800 text-sm mb-1">3. Automated Invoicing & Receivables Management</label>
                            <p class="text-xs text-slate-500 mb-3">How do you manage client billing, tracking, and overdue payment reminders?</p>
                            <select name="q3" class="w-full px-4 py-3 rounded-xl neu-flat bg-[#e2e8f0] border-none text-slate-700 text-xs outline-none">
                                <option value="40">Manual paper invoices and manual tracking spreadsheets (Score: 40%)</option>
                                <option value="70">Desktop accounting software with semi-manual follow-ups (Score: 70%)</option>
                                <option value="100">Cloud automated invoicing with instant payment gateway integration (Score: 100%)</option>
                            </select>
                        </div>
                    </div>


                    <!-- PILLAR 2: OPERATIONAL EFFICIENCY (Q4 - Q6) -->
                    <div class="p-4 bg-indigo-500/10 rounded-xl font-bold text-indigo-700 text-xs uppercase tracking-wider mt-6">
                        Pillar 2: Operational Efficiency & Workflow Automation
                    </div>

                    <!-- Q4 -->
                    <div class="p-6 neu-pressed rounded-2xl flex flex-col md:flex-row gap-4 items-center">
                        <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=200&q=80" alt="Operations" class="w-24 h-24 rounded-xl object-cover neu-flat p-1 hidden sm:block">
                        <div class="flex-1 w-full">
                            <label class="block font-bold text-slate-800 text-sm mb-1">4. Core Workflow Digitization</label>
                            <p class="text-xs text-slate-500 mb-3">To what extent are internal departmental handoffs digitized versus paper-dependent?</p>
                            <select name="q4" class="w-full px-4 py-3 rounded-xl neu-flat bg-[#e2e8f0] border-none text-slate-700 text-xs outline-none">
                                <option value="40">High reliance on physical logs, files, and sticky notes (Score: 40%)</option>
                                <option value="70">Departmental spreadsheets and standalone software apps (Score: 70%)</option>
                                <option value="100">Fully paperless cross-departmental digital workflows (Score: 100%)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Q5 -->
                    <div class="p-6 neu-pressed rounded-2xl flex flex-col md:flex-row gap-4 items-center">
                        <img src="https://images.unsplash.com/photo-1507679799987-c73779587ccf?auto=format&fit=crop&w=200&q=80" alt="ERP" class="w-24 h-24 rounded-xl object-cover neu-flat p-1 hidden sm:block">
                        <div class="flex-1 w-full">
                            <label class="block font-bold text-slate-800 text-sm mb-1">5. Enterprise Resource Planning (ERP) Integration</label>
                            <p class="text-xs text-slate-500 mb-3">How integrated is your core database across manufacturing, sales, and HR?</p>
                            <select name="q5" class="w-full px-4 py-3 rounded-xl neu-flat bg-[#e2e8f0] border-none text-slate-700 text-xs outline-none">
                                <option value="40">Complete data silos with separate tools per department (Score: 40%)</option>
                                <option value="70">Partial integration for primary accounting and sales (Score: 70%)</option>
                                <option value="100">Unified cloud ERP connecting all enterprise branches (Score: 100%)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Q6 -->
                    <div class="p-6 neu-pressed rounded-2xl flex flex-col md:flex-row gap-4 items-center">
                        <img src="https://images.unsplash.com/photo-1581092160607-ee22621dd758?auto=format&fit=crop&w=200&q=80" alt="KPIs" class="w-24 h-24 rounded-xl object-cover neu-flat p-1 hidden sm:block">
                        <div class="flex-1 w-full">
                            <label class="block font-bold text-slate-800 text-sm mb-1">6. Performance Tracking & KPI Monitoring</label>
                            <p class="text-xs text-slate-500 mb-3">How do you measure employee productivity and operational throughput?</p>
                            <select name="q6" class="w-full px-4 py-3 rounded-xl neu-flat bg-[#e2e8f0] border-none text-slate-700 text-xs outline-none">
                                <option value="40">Informal supervisory reviews with no standardized metrics (Score: 40%)</option>
                                <option value="70">Quarterly manual performance reviews and output targets (Score: 70%)</option>
                                <option value="100">Real-time executive dashboards tracking live KPIs (Score: 100%)</option>
                            </select>
                        </div>
                    </div>


                    <!-- PILLAR 3: DIGITAL SECURITY (Q7 - Q9) -->
                    <div class="p-4 bg-indigo-500/10 rounded-xl font-bold text-indigo-700 text-xs uppercase tracking-wider mt-6">
                        Pillar 3: Digital Maturity & Cyber Security
                    </div>

                    <!-- Q7 -->
                    <div class="p-6 neu-pressed rounded-2xl flex flex-col md:flex-row gap-4 items-center">
                        <img src="https://images.unsplash.com/photo-1510519138161-5924d7b93171?auto=format&fit=crop&w=200&q=80" alt="Security" class="w-24 h-24 rounded-xl object-cover neu-flat p-1 hidden sm:block">
                        <div class="flex-1 w-full">
                            <label class="block font-bold text-slate-800 text-sm mb-1">7. Data Backup & Disaster Recovery Protocols</label>
                            <p class="text-xs text-slate-500 mb-3">How frequently are enterprise datasets backed up to secure offsite cloud storage?</p>
                            <select name="q7" class="w-full px-4 py-3 rounded-xl neu-flat bg-[#e2e8f0] border-none text-slate-700 text-xs outline-none">
                                <option value="40">Infrequent manual local hard drive backups (Score: 40%)</option>
                                <option value="70">Weekly automated external backups (Score: 70%)</option>
                                <option value="100">Continuous encrypted cloud redundancy with instant restoration (Score: 100%)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Q8 -->
                    <div class="p-6 neu-pressed rounded-2xl flex flex-col md:flex-row gap-4 items-center">
                        <img src="https://images.unsplash.com/photo-1563986768609-322da13575f3?auto=format&fit=crop&w=200&q=80" alt="Access" class="w-24 h-24 rounded-xl object-cover neu-flat p-1 hidden sm:block">
                        <div class="flex-1 w-full">
                            <label class="block font-bold text-slate-800 text-sm mb-1">8. Access Control & Authentication Security</label>
                            <p class="text-xs text-slate-500 mb-3">What level of authentication security is enforced for employee access to sensitive files?</p>
                            <select name="q8" class="w-full px-4 py-3 rounded-xl neu-flat bg-[#e2e8f0] border-none text-slate-700 text-xs outline-none">
                                <option value="40">Shared passwords or weak single-factor passwords (Score: 40%)</option>
                                <option value="70">Individual standard passwords with basic role permissions (Score: 70%)</option>
                                <option value="100">Multi-Factor Authentication (MFA) & granular role-based access (Score: 100%)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Q9 -->
                    <div class="p-6 neu-pressed rounded-2xl flex flex-col md:flex-row gap-4 items-center">
                        <img src="https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?auto=format&fit=crop&w=200&q=80" alt="Training" class="w-24 h-24 rounded-xl object-cover neu-flat p-1 hidden sm:block">
                        <div class="flex-1 w-full">
                            <label class="block font-bold text-slate-800 text-sm mb-1">9. Employee Cyber-Hygiene Awareness</label>
                            <p class="text-xs text-slate-500 mb-3">Do you conduct regular phishing simulations and security awareness training for staff?</p>
                            <select name="q9" class="w-full px-4 py-3 rounded-xl neu-flat bg-[#e2e8f0] border-none text-slate-700 text-xs outline-none">
                                <option value="40">No formal cybersecurity training conducted (Score: 40%)</option>
                                <option value="70">Onboarding security briefing provided once (Score: 70%)</option>
                                <option value="100">Regular mandatory training and simulated phishing tests (Score: 100%)</option>
                            </select>
                        </div>
                    </div>


                    <!-- PILLAR 4: MARKET COMPETITIVENESS (Q10 - Q11) -->
                    <div class="p-4 bg-indigo-500/10 rounded-xl font-bold text-indigo-700 text-xs uppercase tracking-wider mt-6">
                        Pillar 4: Market Competitiveness & Digital Presence
                    </div>

                    <!-- Q10 -->
                    <div class="p-6 neu-pressed rounded-2xl flex flex-col md:flex-row gap-4 items-center">
                        <img src="https://images.unsplash.com/photo-1432888498266-38ffec3eaf0a?auto=format&fit=crop&w=200&q=80" alt="Web" class="w-24 h-24 rounded-xl object-cover neu-flat p-1 hidden sm:block">
                        <div class="flex-1 w-full">
                            <label class="block font-bold text-slate-800 text-sm mb-1">10. Web Portal & E-Commerce Capability</label>
                            <p class="text-xs text-slate-500 mb-3">How mature is your company website and online sales/inquiry generation funnel?</p>
                            <select name="q10" class="w-full px-4 py-3 rounded-xl neu-flat bg-[#e2e8f0] border-none text-slate-700 text-xs outline-none">
                                <option value="40">Basic static brochure website with no lead capture (Score: 40%)</option>
                                <option value="70">Responsive website with contact forms and social links (Score: 70%)</option>
                                <option value="100">Full transactional e-commerce store or active B2B digital portal (Score: 100%)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Q11 -->
                    <div class="p-6 neu-pressed rounded-2xl flex flex-col md:flex-row gap-4 items-center">
                        <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=200&q=80" alt="Marketing" class="w-24 h-24 rounded-xl object-cover neu-flat p-1 hidden sm:block">
                        <div class="flex-1 w-full">
                            <label class="block font-bold text-slate-800 text-sm mb-1">11. Digital Marketing & CRM Lead Tracking</label>
                            <p class="text-xs text-slate-500 mb-3">How do you acquire new clients and track customer relationship pipelines?</p>
                            <select name="q11" class="w-full px-4 py-3 rounded-xl neu-flat bg-[#e2e8f0] border-none text-slate-700 text-xs outline-none">
                                <option value="40">Word of mouth only with manual contact notes (Score: 40%)</option>
                                <option value="70">Social media advertising and basic email marketing (Score: 70%)</option>
                                <option value="100">Omnichannel campaigns tracked via dedicated CRM software (Score: 100%)</option>
                            </select>
                        </div>
                    </div>


                    <!-- PILLAR 5: SUPPLY CHAIN (Q12 - Q13) -->
                    <div class="p-4 bg-indigo-500/10 rounded-xl font-bold text-indigo-700 text-xs uppercase tracking-wider mt-6">
                        Pillar 5: Supply Chain & Inventory Management
                    </div>

                    <!-- Q12 -->
                    <div class="p-6 neu-pressed rounded-2xl flex flex-col md:flex-row gap-4 items-center">
                        <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=200&q=80" alt="Inventory" class="w-24 h-24 rounded-xl object-cover neu-flat p-1 hidden sm:block">
                        <div class="flex-1 w-full">
                            <label class="block font-bold text-slate-800 text-sm mb-1">12. Inventory Tracking & Reorder Automation</label>
                            <p class="text-xs text-slate-500 mb-3">How do you manage stock thresholds and prevent stockouts or overstocking?</p>
                            <select name="q12" class="w-full px-4 py-3 rounded-xl neu-flat bg-[#e2e8f0] border-none text-slate-700 text-xs outline-none">
                                <option value="40">Manual physical stock counts and periodic estimation (Score: 40%)</option>
                                <option value="70">Spreadsheet ledger updated upon shipment or delivery (Score: 70%)</option>
                                <option value="100">Automated barcode/RFID inventory tracking with auto-reordering (Score: 100%)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Q13 -->
                    <div class="p-6 neu-pressed rounded-2xl flex flex-col md:flex-row gap-4 items-center">
                        <img src="https://images.unsplash.com/photo-1578575437130-527eed3abbec?auto=format&fit=crop&w=200&q=80" alt="Vendor" class="w-24 h-24 rounded-xl object-cover neu-flat p-1 hidden sm:block">
                        <div class="flex-1 w-full">
                            <label class="block font-bold text-slate-800 text-sm mb-1">13. Vendor Diversification & Procurement Risk</label>
                            <p class="text-xs text-slate-500 mb-3">How diversified is your supplier network to mitigate sudden supply chain disruptions?</p>
                            <select name="q13" class="w-full px-4 py-3 rounded-xl neu-flat bg-[#e2e8f0] border-none text-slate-700 text-xs outline-none">
                                <option value="40">High dependence on a single primary supplier (Score: 40%)</option>
                                <option value="70">Primary and secondary backup vendors identified (Score: 70%)</option>
                                <option value="100">Robust multi-vendor sourcing network with automated SLA tracking (Score: 100%)</option>
                            </select>
                        </div>
                    </div>


                    <!-- PILLAR 6: COMPLIANCE & GOVERNANCE (Q14 - Q15) -->
                    <div class="p-4 bg-indigo-500/10 rounded-xl font-bold text-indigo-700 text-xs uppercase tracking-wider mt-6">
                        Pillar 6: Statutory Compliance & Governance
                    </div>

                    <!-- Q14 -->
                    <div class="p-6 neu-pressed rounded-2xl flex flex-col md:flex-row gap-4 items-center">
                        <img src="https://images.unsplash.com/photo-1450133064473-71024230f91b?auto=format&fit=crop&w=200&q=80" alt="Tax" class="w-24 h-24 rounded-xl object-cover neu-flat p-1 hidden sm:block">
                        <div class="flex-1 w-full">
                            <label class="block font-bold text-slate-800 text-sm mb-1">14. Statutory Tax & Regulatory Filings</label>
                            <p class="text-xs text-slate-500 mb-3">Are your corporate taxes, labor laws, and regulatory filings consistently up to date?</p>
                            <select name="q14" class="w-full px-4 py-3 rounded-xl neu-flat bg-[#e2e8f0] border-none text-slate-700 text-xs outline-none">
                                <option value="40">Occasional filing delays or reactive deadline management (Score: 40%)</option>
                                <option value="70">Consistent compliance handled by external accountants (Score: 70%)</option>
                                <option value="100">Proactive automated tax tracking and compliance management (Score: 100%)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Q15 -->
                    <div class="p-6 neu-pressed rounded-2xl flex flex-col md:flex-row gap-4 items-center">
                        <img src="https://images.unsplash.com/photo-1521791136064-7986c2920216?auto=format&fit=crop&w=200&q=80" alt="Governance" class="w-24 h-24 rounded-xl object-cover neu-flat p-1 hidden sm:block">
                        <div class="flex-1 w-full">
                            <label class="block font-bold text-slate-800 text-sm mb-1">15. Internal Policies & Employee Governance</label>
                            <p class="text-xs text-slate-500 mb-3">Do you maintain documented standard operating procedures (SOPs) and employee handbooks?</p>
                            <select name="q15" class="w-full px-4 py-3 rounded-xl neu-flat bg-[#e2e8f0] border-none text-slate-700 text-xs outline-none">
                                <option value="40">Informal verbal agreements with minimal documentation (Score: 40%)</option>
                                <option value="70">Standard employee contracts and basic departmental SOPs (Score: 70%)</option>
                                <option value="100">Comprehensive digital knowledge base with active governance audits (Score: 100%)</option>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="text-center pt-6">
                    <button type="submit" class="neu-button px-10 py-4 rounded-xl text-indigo-600 font-bold text-sm w-full sm:w-auto">
                        <i class="fa-solid fa-wand-magic-sparkles mr-2 text-amber-500"></i> Generate Diagnostic Report
                    </button>
                </div>
            </form>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-[#cbd5e1]/40 text-slate-600 py-8 text-center text-xs border-t border-slate-300">
        <p>&copy; 2026 MSME Transformation Portal. Secure 15-Point Diagnostic Suite.</p>
    </footer>

</body>
</html>