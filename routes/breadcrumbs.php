<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('user.dashboard'));
});

// Home > Post
Breadcrumbs::for('post', function (BreadcrumbTrail $trail) {
    $trail->push('Публикация', route('posts.index'));
});

// Post > [Post]
Breadcrumbs::for('postEdit', function (BreadcrumbTrail $trail, $post) {
    $trail->parent('post');
    $trail->push($post->title, route('posts.edit', $post));
});
