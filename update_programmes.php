<?php

$file = __DIR__ . '/resources/views/pages/home-partials/programmes.blade.php';
$content = file_get_contents($file);

// Outer section
$content = str_replace(
    '<section data-aos="fade-up" style="padding: 6rem 0; background: linear-gradient(to bottom, white 0%, #f8fafc 100%); position: relative;">',
    '<section data-aos="fade-up" class="py-[6rem] relative" style="background: linear-gradient(to bottom, white 0%, #f8fafc 100%);">',
    $content
);

// SVG Container
$content = str_replace(
    '<div style="position: absolute; top: 0; left: 0; width: 100%; overflow: hidden; line-height: 0;">',
    '<div class="absolute top-0 left-0 w-full overflow-hidden leading-[0]">',
    $content
);
$content = str_replace(
    '<svg viewBox="0 0 1200 120" preserveAspectRatio="none" style="position: relative; display: block; width: calc(100% + 1.3px); height: 50px;">',
    '<svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="relative block w-[calc(100%+1.3px)] h-[50px]">',
    $content
);

// Container wrapper
$content = str_replace(
    '<div class="container" data-aos="fade-up" style="position: relative; z-index: 2;">',
    '<div class="container relative z-[2]" data-aos="fade-up">',
    $content
);

// Heading wrapper
$content = str_replace(
    '<div style="text-align: center; margin-bottom: 4rem;">',
    '<div class="text-center mb-[4rem]">',
    $content
);
$content = str_replace(
    '<span style="display: inline-block; color: var(--color-primary); font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 1rem; background: rgba(59,130,246,0.1); padding: 0.3rem 1rem; border-radius: 20px;">',
    '<span class="inline-block text-primary text-[0.85rem] font-bold uppercase tracking-[1.5px] mb-4 bg-blue-500/10 py-1.5 px-4 rounded-full">',
    $content
);
$content = str_replace(
    '<h2 style="font-size: 2.8rem; font-family: var(--font-heading); font-weight: 800; color: #0f172a; margin-bottom: 1rem;">',
    '<h2 class="text-[2.8rem] font-heading font-extrabold text-slate-900 mb-4">',
    $content
);
$content = str_replace(
    '<p style="color: #64748b; font-size: 1.1rem; max-width: 600px; margin: 0 auto; line-height: 1.7;">',
    '<p class="text-slate-500 text-[1.1rem] max-w-[600px] mx-auto leading-relaxed">',
    $content
);

// Card 
$content = str_replace(
    '<a href="{{ url(\'/academics#\' . $prog->slug) }}" class="hover-card" style="background: white; border-radius: 20px; text-decoration: none; color: inherit; position: relative; overflow: hidden; transition: all 0.3s ease; display: flex; flex-direction: column; box-shadow: 0 4px 15px -3px rgba(0,0,0,0.05); border: 1px solid #f1f5f9;">',
    '<a href="{{ url(\'/academics#\' . $prog->slug) }}" class="hover-card bg-white rounded-xl no-underline text-inherit relative overflow-hidden transition-all duration-300 flex flex-col shadow-sm border border-slate-100 group">',
    $content
);

// Gradient Header Strip
$content = str_replace(
    '<div style="height: 6px; background: linear-gradient(90deg, {{ $pc[\'from\'] }}, {{ $pc[\'to\'] }});"></div>',
    '<div class="h-1.5" style="background: linear-gradient(90deg, {{ $pc[\'from\'] }}, {{ $pc[\'to\'] }});"></div>',
    $content
);

// Inner padding
$content = str_replace(
    '<div style="padding: 2rem 2rem 1.5rem;">',
    '<div class="pt-8 px-8 pb-6">',
    $content
);

// Icon + Badge Row
$content = str_replace(
    '<div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1.2rem;">',
    '<div class="flex justify-between items-start mb-5">',
    $content
);
$content = str_replace(
    '<div class="hover-icon-wrapper" style="width: 56px; height: 56px; border-radius: 16px; background: {{ $pc[\'bg\'] }}; color: {{ $pc[\'from\'] }}; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; transition: all 0.3s ease;">',
    '<div class="hover-icon-wrapper w-14 h-14 rounded-2xl flex items-center justify-center text-[1.4rem] transition-all duration-300" style="background: {{ $pc[\'bg\'] }}; color: {{ $pc[\'from\'] }};">',
    $content
);
$content = str_replace(
    '<span style="background: {{ $pc[\'badge\'] }}; color: {{ $pc[\'badgeText\'] }}; font-size: 0.75rem; font-weight: 700; padding: 0.35rem 0.9rem; border-radius: 20px; letter-spacing: 0.5px; text-transform: uppercase;">',
    '<span class="text-[0.75rem] font-bold py-1.5 px-3.5 rounded-full tracking-[0.5px] uppercase" style="background: {{ $pc[\'badge\'] }}; color: {{ $pc[\'badgeText\'] }};">',
    $content
);

// Programme Name
$content = str_replace(
    '<h3 style="font-size: 1.15rem; margin: 0 0 0.8rem; color: #1e293b; font-family: var(--font-heading); font-weight: 700; line-height: 1.3; transition: color 0.3s ease;" class="hover-title">',
    '<h3 class="hover-title text-[1.15rem] m-0 mb-3 text-slate-800 font-heading font-bold leading-snug transition-colors duration-300 group-hover:text-primary">',
    $content
);

// Description
$content = str_replace(
    '<p style="font-size: 0.88rem; color: #64748b; line-height: 1.6; flex: 1; margin: 0;">',
    '<p class="text-[0.88rem] text-slate-500 leading-relaxed flex-1 m-0">',
    $content
);

// Card Footer
$content = str_replace(
    '<div style="padding: 1rem 2rem; border-top: 1px solid #f8fafc; display: flex; justify-content: space-between; align-items: center; margin-top: auto; background: white; transition: background 0.3s ease;" class="hover-footer">                    <div style="display: flex; gap: 1.2rem; font-size: 0.78rem; color: #64748b; font-weight: 500;">',
    '<div class="hover-footer py-4 px-8 border-t border-slate-50 flex justify-between items-center mt-auto bg-white transition-colors duration-300">                    <div class="flex gap-5 text-[0.78rem] text-slate-500 font-medium">',
    $content
);

// Inside footer spans
$content = str_replace(
    '<span style="display: flex; align-items: center; gap: 0.4rem;">',
    '<span class="flex items-center gap-[0.4rem]">',
    $content
);

// Footer arrow
$content = str_replace(
    '<div data-aos="fade-up" style="width: 32px; height: 32px; border-radius: 50%; background: #f1f5f9; color: #64748b; display: flex; align-items: center; justify-content: center; font-size: 0.85rem; transition: all 0.3s ease;" class="card-arrow" data-color="{{ $pc[\'from\'] }}" data-bg="{{ $pc[\'bg\'] }}">',
    '<div data-aos="fade-up" class="card-arrow w-8 h-8 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center text-[0.85rem] transition-all duration-300 group-hover:bg-[var(--hover-bg)] group-hover:text-[var(--hover-color)]" data-color="{{ $pc[\'from\'] }}" data-bg="{{ $pc[\'bg\'] }}">',
    $content
);

file_put_contents($file, $content);
echo "Programmes updated!\n";
