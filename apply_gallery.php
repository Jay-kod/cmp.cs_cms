<?php
$file = 'resources/views/pages/home-partials/gallery.blade.php';
$content = file_get_contents($file);

$newGallery = <<<EOT
        <!-- Modern Masonry Gallery Layout -->
        <style>
            .home-gallery-masonry {
                column-count: 1;
                column-gap: 1.5rem;
                margin-top: 2.5rem;
            }
            @media (min-width: 640px) {
                .home-gallery-masonry {
                    column-count: 2;
                }
            }
            @media (min-width: 1024px) {
                .home-gallery-masonry {
                    column-count: 3;
                }
            }
            @media (min-width: 1280px) {
                .home-gallery-masonry {
                    column-count: 4;
                }
            }
            .home-gallery-item {
                break-inside: avoid;
                margin-bottom: 1.5rem;
                position: relative;
                border-radius: 16px;
                overflow: hidden;
                background: #1e293b;
                box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            }
            .home-gallery-item a {
                display: block;
                width: 100%;
                height: 100%;
            }
            .home-gallery-item img {
                width: 100%;
                height: auto;
                display: block;
                transition: transform 0.7s cubic-bezier(0.165, 0.84, 0.44, 1), filter 0.7s ease;
                filter: brightness(0.85);
            }
            .home-gallery-item:hover img {
                transform: scale(1.05);
                filter: brightness(1.05);
            }
            .home-gallery-overlay {
                position: absolute;
                inset: 0;
                background: linear-gradient(to top, rgba(0,25,13,0.9) 0%, rgba(0,25,13,0.4) 40%, transparent 100%);
                opacity: 0;
                transition: opacity 0.4s ease;
                display: flex;
                flex-direction: column;
                justify-content: flex-end;
                padding: 1.5rem;
                pointer-events: none;
            }
            .home-gallery-item:hover .home-gallery-overlay {
                opacity: 1;
            }
            .home-gallery-caption {
                color: #ffffff;
                font-size: 1.15rem;
                font-family: var(--font-heading);
                font-weight: 600;
                margin: 0;
                transform: translateY(15px);
                transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            }
            .home-gallery-item:hover .home-gallery-caption {
                transform: translateY(0);
            }
            .home-gallery-line {
                width: 40px;
                height: 3px;
                background: #00ea5d;
                border-radius: 2px;
                margin-top: 10px;
                transform: scaleX(0);
                transform-origin: left;
                transition: transform 0.5s cubic-bezier(0.165, 0.84, 0.44, 1) 0.1s;
            }
            .home-gallery-item:hover .home-gallery-line {
                transform: scaleX(1);
            }
        </style>
        
        <div class="home-gallery-masonry" data-aos="fade-up" data-aos-delay="100">
            @foreach($galleryImages as $index => $img)
            <div class="home-gallery-item group">
                <a href="{{ route('gallery.index') }}">
                    <img loading="lazy" src="{{ asset('storage/'.$img->image_path) }}" alt="{{ $img->caption ?? 'Gallery image' }}">
                    <div class="home-gallery-overlay">
                        <div>
                            @if($img->caption)
                            <h4 class="home-gallery-caption">{{ $img->caption }}</h4>
                            @endif
                            <div class="home-gallery-line"></div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
EOT;

$start = strpos($content, '<!-- Sharp Professional Grid Layout -->');
$end = strpos($content, '</div>', strpos($content, '@endforeach')) + 6;

$newContent = substr($content, 0, $start) . $newGallery . substr($content, $end);
file_put_contents($file, $newContent);
?>
