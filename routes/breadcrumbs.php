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

// Home > User
Breadcrumbs::for('user', function (BreadcrumbTrail $trail) {
    $trail->push('Пользователь', route('users.index'));
});

// User > [User]
Breadcrumbs::for('userEdit', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('user');
    $trail->push($user->name, route('users.edit', $user));
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

// Home > Category
Breadcrumbs::for('category', function (BreadcrumbTrail $trail) {
    $trail->push('Спикеры', route('categories.index'));
});

// Category > [Category]
Breadcrumbs::for('categoryEdit', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('category');
    $trail->push($category->title, route('categories.edit', $category));
});

// Home > Conference
Breadcrumbs::for('conference', function (BreadcrumbTrail $trail) {
    $trail->push('Мероприятия', route('conferences.index'));
});

// Conference > [Conference]
Breadcrumbs::for('conferenceEdit', function (BreadcrumbTrail $trail, $conference) {
    $trail->parent('conference');
    $trail->push($conference->title, route('conferences.edit', $conference));
});

// Home > Group
Breadcrumbs::for('group', function (BreadcrumbTrail $trail) {
    $trail->push('Год', route('groups.index'));
});

// Group > [Group]
Breadcrumbs::for('groupEdit', function (BreadcrumbTrail $trail, $group) {
    $trail->parent('group');
    $trail->push($group->title, route('groups.edit', $group));
});

