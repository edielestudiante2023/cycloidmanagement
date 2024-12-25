<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'LoginController::index');


$routes->get('/login', 'LoginController::index');
$routes->post('/login', 'LoginController::authenticate');


// Rutas de los dashboards
$routes->get('/dashboard/admin', 'DashboardController::admin');
$routes->get('/dashboard/consultor', 'DashboardController::consultor');
$routes->get('/dashboard/socio', 'DashboardController::socio');

$routes->get('/logout', 'LoginController::logout');

$routes->get('/profiles/list', 'ProfilesController::list');
$routes->get('/profiles/add', 'ProfilesController::add');
$routes->post('/profiles/add', 'ProfilesController::addPost');
$routes->get('/profiles/edit/(:num)', 'ProfilesController::edit/$1');
$routes->post('/profiles/edit/(:num)', 'ProfilesController::editPost/$1');
$routes->get('/profiles/delete/(:num)', 'ProfilesController::delete/$1');

$routes->get('/users/list', 'UsersController::list');
$routes->get('/users/add', 'UsersController::add');
$routes->post('/users/add', 'UsersController::addPost');
$routes->get('/users/edit/(:num)', 'UsersController::edit/$1');
$routes->post('/users/edit/(:num)', 'UsersController::editPost/$1');
$routes->get('/users/delete/(:num)', 'UsersController::delete/$1');

$routes->get('/info-socios', 'InfoSociosController::list');
$routes->get('/info-socios/add', 'InfoSociosController::add');
$routes->post('/info-socios/add-post', 'InfoSociosController::addPost');
$routes->get('/info-socios/edit/(:num)', 'InfoSociosController::edit/$1');
$routes->post('/info-socios/edit-post/(:num)', 'InfoSociosController::editPost/$1');
$routes->get('/info-socios/delete/(:num)', 'InfoSociosController::delete/$1');

$routes->get('/planillas/list-planillas', 'PlanillasController::list_planillas');
$routes->get('/planillas/add-planilla', 'PlanillasController::add_planilla');
$routes->post('/planillas/add-planilla-post', 'PlanillasController::add_planilla_post');
$routes->get('/planillas/edit-planilla/(:num)', 'PlanillasController::edit_planilla/$1');
$routes->post('/planillas/edit-planilla-post/(:num)', 'PlanillasController::edit_planilla_post/$1');
$routes->get('/planillas/delete-planilla/(:num)', 'PlanillasController::delete_planilla/$1');


$routes->get('videos-capacitaciones', 'VideosCapacitaciones::list'); // Listar videos
$routes->get('videos-capacitaciones/add', 'VideosCapacitaciones::add'); // Mostrar formulario de agregar
$routes->post('videos-capacitaciones/add', 'VideosCapacitaciones::addPost'); // Procesar formulario de agregar
$routes->get('videos-capacitaciones/edit/(:num)', 'VideosCapacitaciones::edit/$1'); // Mostrar formulario de editar
$routes->post('videos-capacitaciones/edit/(:num)', 'VideosCapacitaciones::editPost/$1'); // Procesar formulario de editar
$routes->get('videos-capacitaciones/delete/(:num)', 'VideosCapacitaciones::delete/$1'); // Eliminar video





