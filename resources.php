<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resource Library - Neumorphic UI</title>
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
                <a href="roadmap.php" class="px-4 py-2 rounded-xl neu-flat text-slate-600 hover:text-indigo-600 transition">Roadmap Generator</a>
                <a href="resources.php" class="px-4 py-2 rounded-xl neu-pressed text-indigo-600">Resource Library</a>
                <a href="admin.php" class="px-4 py-2 rounded-xl neu-flat text-slate-600 hover:text-indigo-600 transition">Admin Portal</a>
            </div>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto px-4 py-12 flex-grow">
        <div class="text-center mb-12">
            <h1 class="text-3xl font-black text-slate-800">Digital Transformation Resource Library</h1>
            <p class="text-slate-500 text-sm mt-2">Explore government subsidy schemes, implementation checklists, and case studies.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Resource Card 1 -->
            <div class="neu-flat rounded-3xl p-6 flex flex-col justify-between">
                <div>
                    <span class="text-xs neu-pressed text-indigo-600 px-3 py-1 rounded-full font-bold inline-block">Government Scheme</span>
                    <h3 class="text-lg font-bold text-slate-800 mt-4">Digital MSME Scheme Handbook</h3>
                    <p class="text-slate-500 text-sm mt-2">Comprehensive guide to government grants, subsidies, and zero-defect manufacturing schemes for small enterprises.</p>
                </div>
                <button class="mt-6 neu-button text-indigo-600 font-bold py-2.5 rounded-xl text-xs transition flex items-center justify-center">
                    <i class="fa-solid fa-download mr-2"></i>Download PDF
                </button>
            </div>

            <!-- Resource Card 2 -->
            <div class="neu-flat rounded-3xl p-6 flex flex-col justify-between">
                <div>
                    <span class="text-xs neu-pressed text-emerald-600 px-3 py-1 rounded-full font-bold inline-block">Toolkit</span>
                    <h3 class="text-lg font-bold text-slate-800 mt-4">Cloud ERP Buyer's Checklist</h3>
                    <p class="text-slate-500 text-sm mt-2">A 20-point evaluation matrix to help SMEs select the right cloud ERP and inventory software vendors.</p>
                </div>
                <button class="mt-6 neu-button text-indigo-600 font-bold py-2.5 rounded-xl text-xs transition flex items-center justify-center">
                    <i class="fa-solid fa-download mr-2"></i>Download Checklist
                </button>
            </div>

            <!-- Resource Card 3 -->
            <div class="neu-flat rounded-3xl p-6 flex flex-col justify-between">
                <div>
                    <span class="text-xs neu-pressed text-amber-600 px-3 py-1 rounded-full font-bold inline-block">Case Study</span>
                    <h3 class="text-lg font-bold text-slate-800 mt-4">Apex Agro's Digital Turnaround</h3>
                    <p class="text-slate-500 text-sm mt-2">How a mid-sized agricultural manufacturer automated its supply chain and increased operational efficiency by 40%.</p>
                </div>
                <button class="mt-6 neu-button text-indigo-600 font-bold py-2.5 rounded-xl text-xs transition flex items-center justify-center">
                    <i class="fa-solid fa-book-open mr-2"></i>Read Case Study
                </button>
            </div>
        </div>
    </div>
</body>
</html>