<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

use App\Controllers\Landing;
use App\Controllers\User;
use App\Controllers\Search;
use App\Controllers\Comments;

$routes->get('/', [Landing::class, 'index']);
$routes->post('login', [Landing::class, 'login']);
$routes->get('signup', [Landing::class, 'new']);
$routes->post('create-user', [Landing::class, 'create']);
$routes->get('logout', [Landing::class, 'logout']);
$routes->get('admin', [Landing::class, 'adminPanel']);
$routes->get('profile', [User::class, 'index']);
$routes->post('create-post', [User::class, 'create']);
$routes->get('delete-account', [User::class, 'deleteUser']);
$routes->get('userhome', [User::class, 'userblogs']);
$routes->post('delete-post', [User::class, 'delete']);
$routes->post('update', [User::class, 'updateInfo']);
$routes->get('searchusers', [Search::class, 'index']);
$routes->post('search', [Search::class, 'searchUsers']);
$routes->get('post/(:segment)', [Comments::class, 'index']);
$routes->post('create-comment', [Comments::class, 'create']);