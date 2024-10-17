<?php

//$router->get('/', function() { echo 'Dit is de index vanuit de route'; });
$router->setNamespace('\App\Controllers');
$router->get('/', 'HomeController@index');

// users
$router->get('/users', 'UserController@index');
$router->get('/users/(\d+)', 'UserController@show');

// projects
$router->get('/projects', 'ProjectController@index');
$router->get('/projects/(\d+)', 'ProjectController@show');

$router->get('/projects/create', 'ProjectController@create');
$router->post('/projects/create', 'ProjectController@create');

$router->get('/projects/edit/(\d+)', 'ProjectController@edit');
$router->post('/projects/edit/(\d+)', 'ProjectController@edit');

$router->get('/projects/delete/(\d+)', 'ProjectController@delete');

// tasks
$router->get('/tasks', 'TaskController@index');
$router->get('/tasks/(\d+)', 'TaskController@show');
