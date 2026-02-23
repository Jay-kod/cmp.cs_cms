<?php
$lines = file('c:/xampp/htdocs/p/dcms/resources/views/pages/about.blade.php');
function slice($start, $end) {
    global $lines;
    return implode("", array_slice($lines, $start - 1, $end - $start + 1));
}

$dir = 'c:/xampp/htdocs/p/dcms/resources/views/pages/about-partials';
@mkdir($dir, 0777, true);

file_put_contents("$dir/hero.blade.php", slice(13, 25));
file_put_contents("$dir/our-story.blade.php", slice(30, 98));
file_put_contents("$dir/vision-mission.blade.php", slice(100, 165));
file_put_contents("$dir/core-values.blade.php", slice(167, 198));
file_put_contents("$dir/programmes.blade.php", slice(200, 250));
file_put_contents("$dir/departmental-board.blade.php", slice(252, 295));
file_put_contents("$dir/entry-requirements.blade.php", slice(297, 330));
file_put_contents("$dir/facilities.blade.php", slice(332, 364));
file_put_contents("$dir/faculty.blade.php", slice(366, 391));
file_put_contents("$dir/toc.blade.php", slice(395, 408));
file_put_contents("$dir/styles.blade.php", slice(410, 485));

$newContent = slice(1, 12) . "
@include('pages.about-partials.hero')

<div class=\"container page-layout reveal\" style=\"margin-top: -3rem; position: relative; z-index: 20; padding-bottom: 4rem;\">
    <div class=\"main-content about-main\" style=\"background: white; border-radius: 16px; box-shadow: 0 20px 50px -12px rgba(0,0,0,0.1); padding: 3rem 4rem;\">

        @include('pages.about-partials.our-story')

        @include('pages.about-partials.vision-mission')

        @include('pages.about-partials.core-values')

        @include('pages.about-partials.programmes')

        @include('pages.about-partials.departmental-board')

        @include('pages.about-partials.entry-requirements')

        @include('pages.about-partials.facilities')

        @include('pages.about-partials.faculty')

    </div>

    @include('pages.about-partials.toc')
</div>

@include('pages.about-partials.styles')
@endsection
";

file_put_contents('c:/xampp/htdocs/p/dcms/resources/views/pages/about.blade.php', $newContent);
echo "Successfully split about.blade.php into partials.";
