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

// Home > People
Breadcrumbs::for('people', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('People', url('people'));
});

// Home > Research & News
Breadcrumbs::for('research-news', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Research & News', url('research-news'));
});

// Home > Contact & Alumni
Breadcrumbs::for('contact-alumni', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Contact & Alumni', url('contact-alumni'));
});
