<?php

require_once __DIR__ . '/vendor/autoload.php';

use Controller\ProductController;

$model = new Model\Product;

$Controller = new ProductController;

$model->create();
echo "<br>";
$Controller->index();

echo "<br>";

//phân tích đường dẫn website
$url = $_SERVER['REQUEST_URI'];

$arr = explode('/', $url);
print_r($arr);

echo $url[count($arr) - 1];

