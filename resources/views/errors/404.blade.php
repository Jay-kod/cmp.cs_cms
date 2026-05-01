@extends('layouts.public')

@section('title', 'Page Not Found - 404')

@section('content')
<section class="relative bg-[#0f172a] min-h-[70vh] flex items-center justify-center overflow-hidden py-20">
    <!-- Abstract background elements -->
    <div class="absolute top-0 left-0 w-full h-full bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5 pointer-events-none"></div>
    <div class="absolute -top-[20%] -right-[10%] w-[600px] h-[600px] bg-emerald-500/10 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute -bottom-[20%] -left-[10%] w-[600px] h-[600px] bg-blue-500/10 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="container relative z-10 text-center px-4" data-aos="zoom-in" data-aos-duration="800">
        <!-- 404 Typography -->
        <div class="relative inline-block mb-6">
            <h1 class="text-[clamp(6rem,15vw,12rem)] font-black text-transparent bg-clip-text bg-gradient-to-br from-emerald-400 via-emerald-300 to-blue-500 leading-none tracking-tighter drop-shadow-[0_0_40px_rgba(16,185,129,0.3)]">
                404
            </h1>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[120%] h-[120%] bg-white/5 blur-2xl rounded-full -z-10"></div>
        </div>

        <!-- Content -->
        <h2 class="text-white text-[2rem] md:text-[2.5rem] font-bold mb-4 tracking-tight">Oops! Page not found.</h2>
        <p class="text-slate-400 text-[1.1rem] md:text-[1.25rem] max-w-2xl mx-auto mb-10 leading-relaxed text-balance">
            The page you are looking for might have been removed, had its name changed, or is temporarily unavailable. Let's get you back on track.
        </p>

        <!-- Call to Action Buttons -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 sm:gap-6">
            <a href="{{ route('home') }}" class="w-full sm:w-auto bg-emerald-500 hover:bg-emerald-400 text-slate-900 py-3.5 px-8 rounded-full font-bold text-[1.05rem] no-underline transition-all duration-300 shadow-[0_0_20px_rgba(16,185,129,0.4)] hover:shadow-[0_0_30px_rgba(16,185,129,0.6)] hover:-translate-y-1 flex items-center justify-center gap-2">
                <i class="fa-solid fa-house"></i> Back to Home
            </a>
            <a href="{{ route('contact') }}" class="w-full sm:w-auto bg-slate-800/80 hover:bg-slate-700 backdrop-blur-md text-white border border-slate-700 py-3.5 px-8 rounded-full font-bold text-[1.05rem] no-underline transition-all duration-300 shadow-lg hover:-translate-y-1 flex items-center justify-center gap-2">
                <i class="fa-solid fa-life-ring"></i> Contact Support
            </a>
        </div>
    </div>
</section>
@endsection
