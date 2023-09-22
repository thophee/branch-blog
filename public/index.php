<?php
require_once __DIR__ . '/../vendor/autoload.php';
include __DIR__ . '/assets/images';

use App\Router;

if((!isset($_SESSION['isLoggedIn']) || (isset($_SESSION['isLoggedIn']) && !$_SESSION['isLoggedIn']))
    && $_SERVER['REQUEST_URI'] != '/login'
    && $_SERVER['REQUEST_URI'] != '/registration') {
    header('Location: /login');
}

define('BASEPATH', '/');

Router::add('/', function ($parameters) {
   require_once __DIR__ . '/../pages/home.php';
});
Router::add('/login', function () {
    require_once __DIR__ . '/../pages/login.php';
});
Router::add('/category', function ($parameters) {
    require_once __DIR__ . '/../pages/category.php';
});
Router::add('/registration', function () {
    require_once __DIR__ . '/../pages/registration.php';
});
Router::add('/login', function ($parameters) {
    require_once __DIR__ . '/../pages/login.php';
}, 'post');

Router::add('/category/([a-z-0-9-]*)', function($parameters) {
    require_once __DIR__ . '/../pages/category.php';
});
Router::add('/logout', function () {
    require_once __DIR__ . '/../pages/logout.php';
});
Router::add('/page/([a-z-0-9-]*)', function($parameters) {
    require_once __DIR__ . '/../pages/single-page.php';
});
Router::add('/page/([a-z-0-9-]*)', function($parameters) {
    require_once __DIR__ . '/../pages/single-page.php';
}, 'post');
Router::add('/edit-comment/([a-z-0-9-]*)/([a-z-0-9-]*)', function($parameters) {
    require_once __DIR__ . '/../app/include/edit.php';
});
Router::add('/comments/([a-z-0-9-]*)/([a-z-0-9-]*)/([a-z-0-9-]*)', function($parameters) {
    require_once __DIR__ . '/../pages/single-page.php';
});
Router::add('/edit-comment/([a-z-0-9-]*)/([a-z-0-9-]*)', function($parameters) {
    require_once __DIR__ . '/../app/include/edit.php';
}, 'post');

Router::add('/admin-panel', function ($parameters) {
    require_once __DIR__ . '/../app/admin/posts/index.php';
});
Router::add('/create-post', function ($parameters) {
    require_once __DIR__ . '/../app/admin/posts/create.php';
});
Router::add('/create-post', function ($parameters) {
    require_once __DIR__ . '/../app/admin/posts/create.php';
}, 'post');
Router::add('/edit-post/([a-z-0-9-]*)', function($parameters) {
    require_once __DIR__ . '/../app/admin/posts/edit.php';
});
Router::add('/edit-post/([a-z-0-9-]*)', function($parameters) {
    require_once __DIR__ . '/../app/admin/posts/edit.php';
}, 'post');
Router::add('/delete-post/([a-z-0-9-]*)/([a-z-0-9-]*)', function($parameters) {
    require_once __DIR__ . '/../app/admin/posts/index.php';
});
Router::add('/pub/([a-z-0-9-]*)/([a-z-0-9-]*)', function($parameters) {
    require_once __DIR__ . '/../app/admin/posts/index.php';
});

Router::add('/users', function ($parameters) {
    require_once __DIR__ . '/../app/admin/users/index.php';
});
Router::add('/create-user', function ($parameters) {
    require_once __DIR__ . '/../app/admin/users/create.php';
});
Router::add('/create-user', function ($parameters) {
    require_once __DIR__ . '/../app/admin/users/create.php';
}, 'post');
Router::add('/edit-user/([a-z-0-9-]*)', function($parameters) {
    require_once __DIR__ . '/../app/admin/users/edit.php';
});
Router::add('/edit-user/([a-z-0-9-]*)', function($parameters) {
    require_once __DIR__ . '/../app/admin/users/edit.php';
}, 'post');
Router::add('/delete-user/([a-z-0-9-]*)/([a-z-0-9-]*)', function($parameters) {
    require_once __DIR__ . '/../app/admin/users/index.php';
});

Router::add('/topics', function ($parameters) {
    require_once __DIR__ . '/../app/admin/topics/index.php';
});
Router::add('/create-topic', function ($parameters) {
    require_once __DIR__ . '/../app/admin/topics/create.php';
});
Router::add('/create-topic', function ($parameters) {
    require_once __DIR__ . '/../app/admin/topics/create.php';
}, 'post');
Router::add('/edit-topic/([a-z-0-9-]*)', function($parameters) {
    require_once __DIR__ . '/../app/admin/topics/edit.php';
});
Router::add('/edit-topic/([a-z-0-9-]*)', function($parameters) {
    require_once __DIR__ . '/../app/admin/topics/edit.php';
}, 'post');
Router::add('/delete-topic/([a-z-0-9-]*)/([a-z-0-9-]*)', function($parameters) {
    require_once __DIR__ . '/../app/admin/topics/index.php';
});

Router::add('/profile', function ($parameters) {
    require_once __DIR__ . '/../app/user/user-profile.php';
});
Router::add('/create-post-user', function ($parameters) {
    require_once __DIR__ . '/../app/user/add-post.php';
});
Router::add('/create-post-user', function ($parameters) {
    require_once __DIR__ . '/../app/user/add-post.php';
}, 'post');
Router::add('/edit-post-user/([a-z-0-9-]*)', function ($parameters) {
    require_once __DIR__ . '/../app/user/edit.php';
});
Router::add('/edit-post-user/([a-z-0-9-]*)', function ($parameters) {
    require_once __DIR__ . '/../app/user/edit.php';
}, 'post');
Router::add('/delete-post-user/([a-z-0-9-]*)/([a-z-0-9-]*)', function($parameters) {
    require_once __DIR__ . '/../app/user/user-profile.php';
});

Router::pathNotFound(function($path) {
    require_once __DIR__ . '/../pages/404.php';
});

Router::methodNotAllowed(function($path, $method) {
    header('HTTP/1.0 405 Method Not Allowed');
    echo 'Error 405 :-(<br>';
    echo 'The requested path "'.$path.'" exists. But the request method "'.$method.'" is not allowed on this path!';
});


Router::run();



