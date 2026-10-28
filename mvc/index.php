<?php
session_start();
use App\Controllers\Admin\ArticleController;
use App\Controllers\UserController;
use App\Models\Article;
// Require composer autoloader

require_once __DIR__ . '/env.php';
require __DIR__ . '/vendor/autoload.php';

// Create Router instance
$router = new \Bramus\Router\Router();

// Define routes
$router->get('about', function() {
    echo "About page";
});
$router->get("contact", function() {
    echo "Contact page";
});
$router->get("/", function() {
    // test 
    $data = [
        'title' => 'Iphone 14 pro max',
        'image' => 'https://cdn.tgdd.vn/Products/Images/42/264882/iphone-14-pro-max-den-thumb-600x600.jpg',
        'description' => 'Màu trắng 256GB',
        'content' => 'HOT HOT HOT',
        'category_id' => 3
    ];

    var_dump(Article::update(4, $data));
});

$router->get('/test','App\Controllers\TestController@index');

//admin
$router->before('GET|POST', '/admin/.*', function() {
    if (!isset($_SESSION['user'])) {
        header('location: ' . BASE_URL . 'auth/login');
        exit();
    }
});

// đăng ký 
$router->get('/register', UserController::class . '@register');
$router->get('/auth/login', UserController::class . '@login');
$router->post('/auth/login', UserController::class . '@loginPost');
$router->post('/auth/logout', UserController::class . '@logout');


$router->mount('/admin', function() use($router){

$router->get('/articles', ArticleController::class . '@index');
$router->get('/articles/create', ArticleController::class . "@create");
$router->post('/articles/create', ArticleController::class . "@store");

$router->get('/articles/edit/{id}', ArticleController::class . "@edit");
$router->post('/articles/edit/{id}', ArticleController::class . "@edit");

$router->post('/articles/delete/{id}', ArticleController::class . "@delete");


}); 

$router->set404(function() {
    header('HTTP/1.1 404 Not Found');
    echo "404 - Page not found";
});

// Run it!
$router->run();