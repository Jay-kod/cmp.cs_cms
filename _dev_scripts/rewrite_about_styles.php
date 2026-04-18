<?php
$file = __DIR__ . '/../resources/views/pages/about.blade.php';
$content = file_get_contents($file);

$replacements = [
    // Hero Section
    '/<div class="about-hero" style="background: linear-gradient\(135deg, rgba\(15, 23, 42, 0\.97\) 0%, rgba\(4, 120, 87, 0\.92\) 50%, rgba\(15, 23, 42, 0\.95\) 100%\), url\(\'\{\{ \$heroUrl \}\}\'\) center\/cover; padding: 5\.5rem 0 6\.5rem; position: relative; overflow: hidden;">/' => '<div class="about-hero relative overflow-hidden py-[5.5rem] pb-[6.5rem] bg-cover bg-center" style="background-image: url(\'{{ $heroUrl }}\');">' . "\n" . '    <div class="absolute inset-0 bg-gradient-to-br from-slate-900/[0.97] via-emerald-800/[0.92] to-slate-900/[0.95]"></div>',
    
    '/<div style="position: absolute; inset: 0; background: radial-gradient\(circle at 20% 80%, rgba\(16, 185, 129, 0\.15\), transparent 50%\), radial-gradient\(circle at 80% 20%, rgba\(59, 130, 246, 0\.1\), transparent 50%\); pointer-events: none;"><\/div>/' => '<div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_80%,rgba(16,185,129,0.15),transparent_50%),radial-gradient(circle_at_80%_20%,rgba(59,130,246,0.1),transparent_50%)] pointer-events-none"></div>',

    '/<div style="position: absolute; top: -100px; right: -100px; width: 400px; height: 400px; border: 1px solid rgba\(255,255,255,0\.04\); border-radius: 50%;"><\/div>/' => '<div class="absolute -top-[100px] -right-[100px] w-[400px] h-[400px] border border-white/[0.04] rounded-full"></div>',

    '/<div style="position: absolute; bottom: -150px; left: -80px; width: 500px; height: 500px; border: 1px solid rgba\(255,255,255,0\.03\); border-radius: 50%;"><\/div>/' => '<div class="absolute -bottom-[150px] -left-[80px] w-[500px] h-[500px] border border-white/[0.03] rounded-full"></div>',

    '/<div class="container" data-aos="fade-up" style="position: relative; z-index: 10; text-align: center;">/' => '<div class="container relative z-10 text-center" data-aos="fade-up">',

    '/<div style="display: inline-flex; align-items: center; gap: 0\.5rem; padding: 0\.4rem 1\.2rem; background: rgba\(255,255,255,0\.08\); backdrop-filter: blur\(8px\); color: #a7f3d0; border-radius: 20px; font-size: 0\.8rem; font-weight: 600; letter-spacing: 1\.5px; text-transform: uppercase; margin-bottom: 1\.5rem; border: 1px solid rgba\(255,255,255,0\.1\);">/' => '<div class="inline-flex items-center gap-2 px-5 py-1.5 bg-white/5 backdrop-blur-md text-emerald-200 rounded-full text-[0.8rem] font-semibold tracking-[1.5px] uppercase mb-6 border border-white/10">',

    '/<i class="fa-solid fa-landmark" style="font-size: 0\.7rem;"><\/i>/' => '<i class="fa-solid fa-landmark text-[0.7rem]"></i>',

    '/<h1 style="color: white; font-size: 3\.2rem; font-family: var\(--font-heading\); margin: 0 0 1rem 0; font-weight: 800; text-shadow: 0 4px 20px rgba\(0,0,0,0\.3\);">/' => '<h1 class="text-white text-[3.2rem] font-heading m-0 mb-4 font-extrabold [text-shadow:0_4px_20px_rgba(0,0,0,0.3)]">',

    '/<p style="color: #cbd5e1; font-size: 1\.15rem; max-width: 680px; margin: 0 auto; line-height: 1\.7;">/' => '<p class="text-slate-300 text-[1.15rem] max-w-[680px] mx-auto leading-[1.7]">',

    '/<div class="container page-layout" style="margin-top: -3rem; position: relative; z-index: 20; padding-bottom: 4rem;">/' => '<div class="container page-layout relative z-20 mt-[-3rem] pb-16">',

    '/<div class="main-content about-main" style="background: white; border-radius: 16px; box-shadow: 0 20px 50px -12px rgba\(0,0,0,0\.1\); padding: 3rem 4rem;">/' => '<div class="main-content about-main bg-white rounded-2xl shadow-[0_20px_50px_-12px_rgba(0,0,0,0.1)] p-12 max-md:p-8">',
    
    // Headings
    '/<section data-aos="fade-up" id="([a-zA-Z0-9\-]+)" style="margin-bottom: 4rem;">/' => '<section data-aos="fade-up" id="$1" class="mb-16">',
    '/<div class="section-heading" style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1\.5rem;">/' => '<div class="section-heading flex items-center gap-4 mb-6">',
    '/<div class="section-heading-icon" style="width: 48px; height: 48px; background: linear-gradient\(135deg, rgba\(22, 163, 74, 0\.15\), rgba\(16, 185, 129, 0\.1\)\); color: var\(--color-primary\); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1\.3rem;">/' => '<div class="section-heading-icon w-12 h-12 bg-gradient-to-br from-green-600/15 to-emerald-500/10 text-[color:var(--color-primary)] rounded-[14px] flex items-center justify-center text-[1.3rem]">',
    '/<h2 style="margin: 0; font-size: 2rem; color: #0f172a; font-family: var\(--font-heading\); font-weight: 700;">/' => '<h2 class="m-0 text-[2rem] text-slate-900 font-heading font-bold">',
    '/<div style="width: 60px; height: 4px; background: linear-gradient\(90deg, var\(--color-primary\), var\(--color-accent\)\); margin-bottom: ([0-9\.]+)rem; border-radius: 2px;"><\/div>/' => '<div class="w-[60px] h-1 bg-gradient-to-r from-[color:var(--color-primary)] to-[color:var(--color-accent)] mb-[${1}rem] rounded-full"></div>',

    // About story layout
    '/<div class="about-story-layout" style="display: flex; gap: 2\.5rem; align-items: flex-start; flex-wrap: wrap; margin-bottom: 2rem;">/' => '<div class="about-story-layout flex gap-10 items-start flex-wrap mb-8">',
    '/<div data-aos="fade-up" class="about-hod-card" style="flex: 0 0 220px; max-width: 220px;">/' => '<div data-aos="fade-up" class="about-hod-card flex-[0_0_220px] max-w-[220px]">',
    '/<div style="aspect-ratio: 1; border-radius: 14px; overflow: hidden; box-shadow: 0 12px 30px rgba\(0,0,0,0\.1\); border: 3px solid var\(--color-accent\);">/' => '<div class="aspect-square rounded-[14px] overflow-hidden shadow-[0_12px_30px_rgba(0,0,0,0.1)] border-[3px] border-solid border-[color:var(--color-accent)]">',
    '/<img src="\{\{ asset\(\'storage\/\'\.\$hod->photo\) \}\}" alt="\{\{ \$hod->name \}\}" style="width: 100%; height: 100%; object-fit: cover;">/' => '<img src="{{ asset(\'storage/\'.$hod->photo) }}" alt="{{ $hod->name }}" class="w-full h-full object-cover">',
    '/<div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; background: #f0fdf4; padding: 1\.5rem;">/' => '<div class="w-full h-full flex items-center justify-center bg-green-50 p-6">',
    '/<img src="\{\{ asset\(config\(\'university\.logo\', \'images\/logo\.png\'\)\) \}\}" alt="Department Logo" style="width: 80%; height: 80%; object-fit: contain;">/' => '<img src="{{ asset(config(\'university.logo\', \'images/logo.png\')) }}" alt="Department Logo" class="w-4/5 h-4/5 object-contain">',
    '/<div style="text-align: center; margin-top: 0\.8rem;">/' => '<div class="text-center mt-3">',
    '/<p style="margin: 0; font-weight: 700; color: #0f172a; font-size: 0\.95rem;">/' => '<p class="m-0 font-bold text-slate-900 text-[0.95rem]">',
    '/<p style="margin: 0; color: var\(--color-primary\); font-size: 0\.82rem;">/' => '<p class="m-0 text-[color:var(--color-primary)] text-[0.82rem]">',
    '/<div class="about-story-text" style="flex: 1; min-width: 280px; font-size: 1\.05rem; line-height: 1\.85; color: #475569;">/' => '<div class="about-story-text flex-1 min-w-[280px] text-[1.05rem] leading-[1.85] text-slate-600">',
    '/<div class="about-quote" style="border-left: 4px solid var\(--color-primary\); padding: 1\.2rem 1\.5rem; background: linear-gradient\(90deg, rgba\(22,163,74,0\.04\), transparent\); border-radius: 0 8px 8px 0; margin: 1\.5rem 0; font-style: italic; color: #334155; font-size: 1\.08rem; line-height: 1\.7;">/' => '<div class="about-quote border-l-4 border-l-[color:var(--color-primary)] py-[1.2rem] px-6 bg-gradient-to-r from-green-600/[0.04] to-transparent rounded-r-lg my-6 italic text-slate-700 text-[1.08rem] leading-[1.7]">',
    '/<div style="margin-top: 1\.2rem; padding: 1rem 1\.4rem; background: #f8fafc; border-left: 3px solid var\(--color-primary\); border-radius: 0 8px 8px 0; color: #475569; font-size: 0\.97rem; line-height: 1\.7;">/' => '<div class="mt-5 py-4 px-6 bg-slate-50 border-l-[3px] border-l-[color:var(--color-primary)] rounded-r-lg text-slate-600 text-[0.97rem] leading-[1.7]">',
    
    // Milestones
    '/<div class="about-milestones about-milestones-grid" style="display: grid; grid-template-columns: repeat\(4, 1fr\); gap: 1\.2rem; margin-top: 2\.5rem;">/' => '<div class="about-milestones flex flex-wrap max-md:grid max-md:grid-cols-2 max-[480px]:grid-cols-1 gap-5 mt-10">',
    '/<div style="text-align: center; padding: 1\.5rem; background: #ffffff; border-radius: 14px; border: 1px solid rgba\(22, 163, 74, 0\.2\); box-shadow: 0 4px 15px -3px rgba\(22, 163, 74, 0\.05\);">/' => '<div class="flex-1 min-w-[200px] text-center p-6 bg-white rounded-[14px] border border-green-600/20 shadow-[0_4px_15px_-3px_rgba(22,163,74,0.05)]">',
    '/<div class="milestone-year" style="font-size: 2rem; font-weight: 800; color: var\(--color-primary\); font-family: var\(--font-heading\);">/' => '<div class="milestone-year text-[2rem] font-extrabold text-[color:var(--color-primary)] font-heading">',
    '/<div style="font-size: 0\.85rem; color: #475569; margin-top: 0\.3rem; font-weight: 500;">/' => '<div class="text-[0.85rem] text-slate-600 mt-1 font-medium">',
];

foreach ($replacements as $pattern => $replacement) {
    if (preg_match($pattern, $content)) {
        $content = preg_replace($pattern, $replacement, $content);
    } else {
        echo "Pattern not found: $pattern\n";
    }
}

// Write the partially replaced file back
file_put_contents($file, $content);

// Part 2 replacements
$replacements2 = [
    // Vision and Mission
    '/<div class="about-vm-grid" style="display: grid; grid-template-columns: repeat\(auto-fit, minmax\(300px, 1fr\)\); gap: 1\.5rem;">/' => '<div class="grid grid-cols-[repeat(auto-fit,minmax(300px,1fr))] gap-6">',
    '/<div data-aos="fade-up" class="about-vm-card" style="background: linear-gradient\(135deg, #f0fdf4 0%, #dcfce7 100%\); border-radius: 16px; padding: 2\.5rem; position: relative; overflow: hidden; border: 1px solid rgba\(22, 163, 74, 0\.15\); transition: transform 0\.3s, box-shadow 0\.3s;" onmouseover="this\.style\.transform=\'translateY\(-5px\)\'; this\.style\.boxShadow=\'0 20px 40px -12px rgba\(22,163,74,0\.2\)\'" onmouseout="this\.style\.transform=\'translateY\(0\)\'; this\.style\.boxShadow=\'none\'">/' => '<div data-aos="fade-up" class="group bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-10 relative overflow-hidden border border-green-600/15 transition-all duration-300 hover:-translate-y-[5px] hover:shadow-[0_20px_40px_-12px_rgba(22,163,74,0.2)]">',
    '/<div style="position: absolute; top: -20px; right: -20px; font-size: 7rem; color: rgba\(22, 163, 74, 0\.06\); transform: rotate\(-15deg\); pointer-events: none;">/' => '<div class="absolute -top-5 -right-5 text-[7rem] text-green-600/[0.06] -rotate-15 pointer-events-none">',
    '/<div style="width: 52px; height: 52px; background: linear-gradient\(135deg, #16a34a, #15803d\); color: white; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1\.4rem; margin-bottom: 1\.5rem; box-shadow: 0 8px 20px -4px rgba\(22, 163, 74, 0\.4\);">/' => '<div class="w-[52px] h-[52px] bg-gradient-to-br from-green-600 to-green-700 text-white rounded-[14px] flex items-center justify-center text-[1.4rem] mb-6 shadow-[0_8px_20px_-4px_rgba(22,163,74,0.4)]">',
    '/<h3 style="font-size: 1\.4rem; color: #1e293b; margin: 0 0 1rem 0; font-family: var\(--font-heading\); font-weight: 700;">/' => '<h3 class="text-[1.4rem] text-slate-800 m-0 mb-4 font-heading font-bold">',
    '/<p style="color: #334155; font-size: 1rem; line-height: 1\.7; margin: 0;">/' => '<p class="text-slate-700 text-[1rem] leading-[1.7] m-0">',
    
    // Mission Card
    '/<div data-aos="fade-up" class="about-vm-card" style="background: linear-gradient\(135deg, #ecfdf5 0%, #d1fae5 100%\); border-radius: 16px; padding: 2\.5rem; position: relative; overflow: hidden; border: 1px solid rgba\(16, 185, 129, 0\.15\); transition: transform 0\.3s, box-shadow 0\.3s;" onmouseover="this\.style\.transform=\'translateY\(-5px\)\'; this\.style\.boxShadow=\'0 20px 40px -12px rgba\(16,185,129,0\.2\)\'" onmouseout="this\.style\.transform=\'translateY\(0\)\'; this\.style\.boxShadow=\'none\'">/' => '<div data-aos="fade-up" class="group bg-gradient-to-br from-emerald-50 to-emerald-100 rounded-2xl p-10 relative overflow-hidden border border-emerald-500/15 transition-all duration-300 hover:-translate-y-[5px] hover:shadow-[0_20px_40px_-12px_rgba(16,185,129,0.2)]">',
    '/<div style="position: absolute; top: -20px; right: -20px; font-size: 7rem; color: rgba\(16, 185, 129, 0\.06\); transform: rotate\(-15deg\); pointer-events: none;">/' => '<div class="absolute -top-5 -right-5 text-[7rem] text-emerald-500/[0.06] -rotate-15 pointer-events-none">',
    '/<div style="width: 52px; height: 52px; background: linear-gradient\(135deg, #10b981, #059669\); color: white; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1\.4rem; margin-bottom: 1\.5rem; box-shadow: 0 8px 20px -4px rgba\(16, 185, 129, 0\.4\);">/' => '<div class="w-[52px] h-[52px] bg-gradient-to-br from-emerald-500 to-emerald-600 text-white rounded-[14px] flex items-center justify-center text-[1.4rem] mb-6 shadow-[0_8px_20px_-4px_rgba(16,185,129,0.4)]">',
    
    // Objectives section
    '/<div class="about-objectives-wrap" style="margin-top: 1\.5rem; background: #ffffff; border-radius: 20px; padding: 3rem; border: 1px solid rgba\(22, 163, 74, 0\.12\); box-shadow: 0 10px 30px -10px rgba\(0,0,0,0\.05\); position: relative; overflow: hidden;">/' => '<div class="about-objectives-wrap mt-6 bg-white rounded-[20px] p-12 border border-green-600/12 shadow-[0_10px_30px_-10px_rgba(0,0,0,0.05)] relative overflow-hidden max-md:p-8">',
    '/<div style="position: absolute; top: -40px; right: -40px; width: 200px; height: 200px; background: radial-gradient\(circle, rgba\(22,163,74,0\.05\), transparent 70%\); pointer-events: none;"><\/div>/' => '<div class="absolute -top-10 -right-10 w-[200px] h-[200px] bg-[radial-gradient(circle,rgba(22,163,74,0.05),transparent_70%)] pointer-events-none"></div>',
    '/<div style="position: absolute; bottom: -30px; left: -30px; width: 150px; height: 150px; background: radial-gradient\(circle, rgba\(16,185,129,0\.04\), transparent 70%\); pointer-events: none;"><\/div>/' => '<div class="absolute -bottom-[30px] -left-[30px] w-[150px] h-[150px] bg-[radial-gradient(circle,rgba(16,185,129,0.04),transparent_70%)] pointer-events-none"></div>',
    '/<div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; position: relative;">/' => '<div class="flex items-center gap-4 mb-8 relative">',
    '/<h3 style="font-size: 1\.4rem; color: #1e293b; margin: 0; font-family: var\(--font-heading\); font-weight: 700;">/' => '<h3 class="text-[1.4rem] text-slate-800 m-0 font-heading font-bold">',
    '/<p style="margin: 0\.2rem 0 0; font-size: 0\.85rem; color: #64748b;">/' => '<p class="mt-1 mb-0 text-[0.85rem] text-slate-500">',
    '/<div class="about-objectives-grid" style="display: grid; grid-template-columns: repeat\(auto-fit, minmax\(200px, 1fr\)\); gap: 1rem; position: relative;">/' => '<div class="grid grid-cols-[repeat(auto-fit,minmax(200px,1fr))] gap-4 relative">',
    '/<div style="text-align: center; padding: 1\.2rem 1rem; background: #fafaf9; border-radius: 12px; border: 1px solid rgba\(22,163,74,0\.05\); transition: all 0\.3s cubic-bezier\(0\.4,0,0\.2,1\); cursor: default;" onmouseover="this\.style\.transform=\'translateY\(-4px\)\'; this\.style\.boxShadow=\'0 12px 28px -6px rgba\(22,163,74,0\.12\)\'; this\.style\.borderColor=\'rgba\(22,163,74,0\.2\)\'" onmouseout="this\.style\.transform=\'translateY\(0\)\'; this\.style\.boxShadow=\'none\'; this\.style\.borderColor=\'rgba\(22,163,74,0\.05\)\'">/' => '<div class="text-center py-5 px-4 bg-stone-50 rounded-xl border border-green-600/[0.05] transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_12px_28px_-6px_rgba(22,163,74,0.12)] hover:border-green-600/20 cursor-default">',
    '/<div style="width: 40px; height: 40px; background: rgba\(22,163,74,0\.06\); color: var\(--color-primary\); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1rem; margin: 0 auto 0\.8rem; border: 1px solid rgba\(22,163,74,0\.1\);">/' => '<div class="w-10 h-10 bg-green-600/[0.06] text-[color:var(--color-primary)] rounded-lg flex items-center justify-center text-[1rem] mx-auto mb-3 border border-green-600/10">',
    '/<h4 style="margin: 0 0 0\.4rem; font-size: 0\.85rem; font-weight: 700; color: #1e293b; font-family: var\(--font-heading\);">/' => '<h4 class="m-0 mb-1.5 text-[0.85rem] font-bold text-slate-800 font-heading">',
    '/<p style="margin: 0; color: #475569; font-size: 0\.82rem; line-height: 1\.6;">/' => '<p class="m-0 text-slate-600 text-[0.82rem] leading-[1.6]">',
    
    // Core values
    '/<div class="about-values-grid" style="display: grid; grid-template-columns: repeat\(auto-fit, minmax\(200px, 1fr\)\); gap: 1\.2rem;">/' => '<div class="grid grid-cols-[repeat(auto-fit,minmax(200px,1fr))] gap-5">',
    '/<div style="text-align: center; padding: 2rem 1\.2rem; background: \{\{ \$b \}\}; border-radius: 14px; border: 1px solid \{\{ \$c \}\}20; transition: all 0\.3s cubic-bezier\(0\.4, 0, 0\.2, 1\); cursor: default;" onmouseover="this\.style\.transform=\'translateY\(-6px\)\'; this\.style\.boxShadow=\'0 18px 35px -8px \{\{ \$c \}\}25\'" onmouseout="this\.style\.transform=\'translateY\(0\)\'; this\.style\.boxShadow=\'none\'">/' => '<div class="text-center py-8 px-5 bg-[{{ $b }}] rounded-[14px] border border-[{{ $c }}20] transition-all duration-300 hover:-translate-y-1.5 hover:shadow-[0_18px_35px_-8px_{{ $c }}25] cursor-default">',
    '/<div class="val-icon" style="width: 56px; height: 56px; margin: 0 auto 1rem; background: linear-gradient\(135deg, \{\{ \$c \}\}, \{\{ \$c \}\}dd\); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1\.5rem; box-shadow: 0 8px 20px -4px \{\{ \$c \}\}40;">/' => '<div class="w-14 h-14 mx-auto mb-4 bg-gradient-to-br from-[{{ $c }}] to-[{{ $c }}dd] text-white rounded-full flex items-center justify-center text-[1.5rem] shadow-[0_8px_20px_-4px_{{ $c }}40]">',
    '/<h4 style="margin: 0 0 0\.4rem; font-size: 1\.1rem; color: #1e293b; font-weight: 700;">/' => '<h4 class="m-0 mb-1 z-[1.1rem] text-slate-800 font-bold mb-1.5">',
    '/<p style="margin: 0; font-size: 0\.82rem; color: #64748b; line-height: 1\.5;">/' => '<p class="m-0 text-[0.82rem] text-slate-500 leading-[1.5]">',
];

foreach ($replacements2 as $pattern => $replacement) {
    if (preg_match($pattern, $content)) {
        $content = preg_replace($pattern, $replacement, $content);
    } else {
        echo "Pattern not found: $pattern\n";
    }
}

// Part 3
$replacements3 = [
    '/<p style="font-size: 1\.02rem; color: #64748b; line-height: 1\.7; margin-bottom: 2rem;">/' => '<p class="text-[1.02rem] text-slate-500 leading-[1.7] mb-8">',
    '/<p style="font-size: 1\.02rem; color: #475569; line-height: 1\.7; margin-bottom: 2rem;">/' => '<p class="text-[1.02rem] text-slate-600 leading-[1.7] mb-8">',
    '/<div class="about-programmes-grid" style="display: grid; grid-template-columns: repeat\(auto-fit, minmax\(300px, 1fr\)\); gap: 1\.2rem;">/' => '<div class="grid grid-cols-[repeat(auto-fit,minmax(300px,1fr))] gap-5">',
    '/<div style="background: linear-gradient\(135deg, \{\{ \$prog\[\'theme_main\'\] \?\? \'#0f172a\' \}\} 0%, \{\{ \$prog\[\'theme_accent\'\] \?\? \'#1e293b\' \}\} 100%\); border-radius: 14px; padding: 2rem; color: \{\{ \$textColor \}\}; position: relative; overflow: hidden; border: \{\{ \$border \}\};">/' => '<div class="rounded-[14px] p-8 text-[{{ $textColor }}] relative overflow-hidden border-[{{ $border }}]" style="background: linear-gradient(135deg, {{ $prog[\'theme_main\'] ?? \'#0f172a\' }} 0%, {{ $prog[\'theme_accent\'] ?? \'#1e293b\' }} 100%); border: {{ $border }};">',
    '/<div style="position: absolute; top: -30px; right: -30px; width: 100px; height: 100px; border-radius: 50%; background: \{\{ \$isDark \? \'rgba\(255,255,255,0\.04\)\' : \'rgba\(22,163,74,0\.06\)\' \}\};"><\/div>/' => '<div class="absolute -top-8 -right-8 w-[100px] h-[100px] rounded-full bg-[{{ $isDark ? \'rgba(255,255,255,0.04)\' : \'rgba(22,163,74,0.06)\' }}]"></div>',
    '/<div style="display: flex; align-items: center; gap: 0\.8rem; margin-bottom: 1\.2rem;">/' => '<div class="flex items-center gap-3 mb-5">',
    '/<div style="width: 40px; height: 40px; background: \{\{ \$iconBg \}\}; color: \{\{ \$iconColor \}\}; border-radius: 10px; display: flex; align-items: center; justify-content: center;">/' => '<div class="w-10 h-10 rounded-lg flex items-center justify-center bg-[{{ $iconBg }}] text-[{{ $iconColor }}]">',
    '/<h4 style="margin: 0; font-size: 1\.1rem; font-weight: 700;">/' => '<h4 class="m-0 text-[1.1rem] font-bold">',
    '/<ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 0\.6rem;">/' => '<ul class="list-none p-0 m-0 flex flex-col gap-2.5">',
    '/<li style="display: flex; align-items: center; gap: 0\.5rem; font-size: 0\.88rem; color: \{\{ \$listColor \}\};"><i class="fa-solid fa-chevron-right" style="font-size: 0\.55rem; color: \{\{ \$bulletColor \}\};"><\/i> \{!! trim\(\$item\) !!\}<\/li>/' => '<li class="flex items-center gap-2 text-[0.88rem] text-[{{ $listColor }}]"><i class="fa-solid fa-chevron-right text-[0.55rem] text-[{{ $bulletColor }}]"></i> {!! trim($item) !!}</li>',
    '/<a href="\{\{ url\(\'\/academics\'\) \}\}" style="display: inline-flex; align-items: center; gap: 0\.5rem; margin-top: 1\.5rem; font-size: 0\.88rem; color: var\(--color-primary\); font-weight: 600; text-decoration: none;" onmouseover="this\.style\.gap=\'0\.8rem\'" onmouseout="this\.style\.gap=\'0\.5rem\'">/' => '<a href="{{ url(\'/academics\') }}" class="group/link inline-flex items-center gap-2 mt-6 text-[0.88rem] text-[color:var(--color-primary)] font-semibold no-underline hover:gap-3 transition-all duration-200">',
    '/<i class="fa-solid fa-arrow-right" style="font-size: 0\.75rem; transition: transform 0\.2s;"><\/i>/' => '<i class="fa-solid fa-arrow-right text-[0.75rem] transition-transform duration-200"></i>',
];

foreach ($replacements3 as $pattern => $replacement) {
    if (preg_match($pattern, $content)) {
        $content = preg_replace($pattern, $replacement, $content);
    } else {
         echo "Pattern not found: $pattern\n";
    }
}

file_put_contents($file, $content);
echo "Completed";

