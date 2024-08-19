<?php

// public/index.php
require_once '../vendor/autoload.php';

use App\Core\Database;
use App\Models\User;
use App\Core\Router;

$db = new Database('mysql:host=localhost;dbname=dbtest', 'root', '');
$userModel = new User($db->getConnection());
$router = new Router();

$router->add('GET', '/users/?', 'UserController@getAll');
$router->add('GET', '/user/{id}/?', 'UserController@indexSolo');
$router->add('POST', '/users/?', 'UserController@store');
$router->add('DELETE', '/users/{id}/?', 'UserController@delete'); 
$router->add('PUT', '/users/{id}/?', 'UserController@update'); 

// Add the dependency to the container
$container = [
    'App\\Controllers\\UserController' => $userModel
];

$router->setContainer($container);

$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Determine base path dynamically
$basePath = '/api';
if (strpos($path, $basePath) === 0) {
    $path = substr($path, strlen($basePath));
}

$router->dispatch($method, $path);

