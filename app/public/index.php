<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

error_reporting(E_ALL);
ini_set("display_errors", 1);

require __DIR__ . '/../vendor/autoload.php';

// Create Router instance
$router = new \Bramus\Router\Router();

$router->setNamespace('Controllers');

// routes for the articles endpoint
$router->get('/products', 'ProductController@getAll');
$router->get('/products/(\d+)', 'ProductController@getOne');
$router->put('/products/(\d+)', 'ProductController@update');
$router->post('/products', 'ProductController@create');
$router->delete('/products/(\d+)', 'ProductController@delete');
// Run it!
$router->run();