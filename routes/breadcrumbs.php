<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', url('/'));
});

// Home > About
Breadcrumbs::for('about', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('About', url('about'));
});

// Home > Academics
Breadcrumbs::for('academics', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Academics', url('academics'));
});

// Home > Faculty
Breadcrumbs::for('people', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Faculty', url('people'));
});

// Home > Blog
Breadcrumbs::for('research-news', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Blog', url('research-news'));
});

// Home > Contact & Alumni
Breadcrumbs::for('contact-alumni', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Contact & Alumni', url('contact-alumni'));
});
