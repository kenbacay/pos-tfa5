<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Public pages
$routes->get('/', 'Tasks::today');
$routes->get('tasks', 'Tasks::index');
$routes->get('profile', 'Profile::index');
$routes->get('about', 'Pages::about');

// Authentication
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::login');
$routes->get('logout', 'Auth::logout');

// Protected routes
$routes->group('', ['filter' => 'auth'], static function ($routes) {

    // Task management
    $routes->get('tasks/new', 'Tasks::newTask');
    $routes->post('tasks/create', 'Tasks::create');
    $routes->get('tasks/edit/(:num)', 'Tasks::edit/$1');
    $routes->post('tasks/update/(:num)', 'Tasks::update/$1');
    $routes->post('tasks/delete/(:num)', 'Tasks::delete/$1');

    // Customer routes
    $routes->get('customers', 'Customers::index');
    $routes->get('customers/new', 'Customers::newForm');
    $routes->post('customers/create', 'Customers::create');
    $routes->get('customers/edit/(:num)', 'Customers::edit/$1');
    $routes->post('customers/update/(:num)', 'Customers::update/$1');

    // User routes
    $routes->get('users', 'Users::index');
    $routes->get('users/new', 'Users::newForm');
    $routes->post('users/create', 'Users::create');
    $routes->get('users/edit/(:num)', 'Users::edit/$1');
    $routes->post('users/update/(:num)', 'Users::update/$1');
});