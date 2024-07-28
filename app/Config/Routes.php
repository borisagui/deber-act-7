<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('users', 'UserController::getAllUsers');
$routes->get('users/insertar/(:segment)/(:segment)', 'UserController::insertar/$1/$2');
$routes->get('users/modificar/(:num)/(:segment)/(:segment)', 'UserController::modificar/$1/$2/$3');
$routes->get('users/eliminar/(:num)', 'UserController::eliminar/$1');