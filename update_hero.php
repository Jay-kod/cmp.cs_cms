<?php

$file = __DIR__ . '/resources/views/pages/home-partials/hero.blade.php';
$content = file_get_contents($file);

$content = str_replace(
    '<section data-aos="fade-up" class="hero-carousel" style="position: relative; overflow: hidden; height: 652px;">',
    '<section data-aos="fade-up" class="hero-carousel relative overflow-hidden h-[652px]">',
    $content
);

$content = str_replace(
    '<div class="carousel-track" id="carouselTrack" style="display: flex; height: 100%; transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);">',
    '<div class="carousel-track flex h-full transition-transform duration-[600ms] ease-[cubic-bezier(0.25,0.46,0.45,0.94)]" id="carouselTrack">',
    $content
);

$content = str_replace(
    '<div class="carousel-slide" style="min-width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; text-align: center; color: white; position: relative;',
    '<div class="carousel-slide min-w-full h-full flex items-center justify-center text-center text-white relative"',
    $content
);

$content = str_replace(
    '<div class="container" data-aos="fade-up" style="position: relative; z-index: 10; max-width: 850px; padding: 0 1.5rem; text-align: center; margin: 0 auto; display: flex; flex-direction: column; align-items: center;">',
    '<div class="container relative z-10 max-w-[850px] px-6 text-center mx-auto flex flex-col items-center" data-aos="fade-up">',
    $content
);

file_put_contents($file, $content);
echo "Hero updated!\n";
