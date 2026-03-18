<?php
$lines = file('c:/xampp/htdocs/p/dcms/resources/views/pages/research-news.blade.php');
function slice($start, $end) {
    global $lines;
    return implode("", array_slice($lines, $start - 1, $end - $start + 1));
}

$dir = 'c:/xampp/htdocs/p/dcms/resources/views/pages/research-news-partials';
@mkdir($dir, 0777, true);

file_put_contents("$dir/hero.blade.php", slice(12, 28));
file_put_contents("$dir/research-areas.blade.php", slice(33, 80));
file_put_contents("$dir/publications.blade.php", slice(82, 127));
file_put_contents("$dir/news.blade.php", slice(129, 177));
file_put_contents("$dir/events.blade.php", slice(179, 228));
file_put_contents("$dir/gallery.blade.php", slice(230, 265));
file_put_contents("$dir/toc.blade.php", slice(268, 274));
file_put_contents("$dir/styles.blade.php", slice(277, 352));

$newContent = slice(1, 11) . "
@include('pages.research-news-partials.hero')

<div class=\"container page-layout reveal\" style=\"margin-top: -3rem; position: relative; z-index: 20; padding-bottom: 4rem;\">
    <div class=\"main-content blog-main\" style=\"background: white; border-radius: 16px; box-shadow: 0 20px 50px -12px rgba(0,0,0,0.1); padding: 3rem 4rem;\">

        @include('pages.research-news-partials.research-areas')

        @include('pages.research-news-partials.publications')

        @include('pages.research-news-partials.news')

        @include('pages.research-news-partials.events')

        @include('pages.research-news-partials.gallery')

    </div>

    @include('pages.research-news-partials.toc')
</div>

@include('pages.research-news-partials.styles')
@endsection
";

file_put_contents('c:/xampp/htdocs/p/dcms/resources/views/pages/research-news.blade.php', $newContent);
echo "Successfully split research-news.blade.php into partials.";
