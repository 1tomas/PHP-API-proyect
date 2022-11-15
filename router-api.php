<?php
require_once './Libs/router.php';
require_once './App/Controller/apiProductsController.php';
require_once './App/Controller/apiSelerrsController.php';
require_once './App/Controller/apiUsersController.php';

$router = new router();

//PRODUCTS
$router->addRoute('products', 'GET', 'apiProductsController', 'getAll');
$router->addRoute('products/:ID', 'GET', 'apiProductsController', 'getOne');
$router->addRoute('products/:ID', 'DELETE', 'apiProductsController', 'remove');
$router->addRoute('products', 'POST', 'apiProductsController', 'insert'); 
$router->addRoute('products/:ID', 'PUT', 'apiProductsController', 'update'); 

//SELLERS
$router->addRoute('sellers', 'GET', 'apiSellersController', 'getAll');
$router->addRoute('sellers/:ID', 'GET', 'apiSellersController', 'getOne');
$router->addRoute('sellers/:ID', 'DELETE', 'apiSellersController', 'remove');
$router->addRoute('sellers', 'POST', 'apiSellersController', 'insert'); 
$router->addRoute('sellers/:ID', 'PUT', 'apiSellersController', 'update'); 

//USERS
$router->addRoute('users', 'GET', 'apiUsersController', 'getAll');
$router->addRoute('users/:ID', 'GET', 'apiUsersController', 'getOne');
$router->addRoute('users/:ID', 'DELETE', 'apiUsersController', 'remove');
$router->addRoute('users', 'POST', 'apiUsersController', 'insert'); 
$router->addRoute('users/:ID', 'PUT', 'apiUsersController', 'update'); 



$router->addRoute("auth/token", 'GET', 'AuthApiController', 'getToken');



$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
