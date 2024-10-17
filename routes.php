<?php

//$router->get('/', function() { echo 'Dit is de index vanuit de route'; });
$router->setNamespace('\App\Controllers');
$router->get('/', 'HomeController@index');

// users
$router->get('/users', 'UserController@index');
$router->get('/users/(\d+)', 'UserController@show');

$router->get('/users/create', 'UserController@create');
$router->post('/users/create', 'UserController@create');

$router->get('/users/edit/(\d+)', 'UserController@edit');
$router->post('/users/edit/(\d+)', 'UserController@edit');

$router->get('/users/delete/(\d+)', 'UserController@delete');

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

$router->get('/tasks/create', 'TaskController@create');
$router->post('/tasks/create', 'TaskController@create');

$router->get('/tasks/edit/(\d+)', 'TaskController@edit');
$router->post('/tasks/edit/(\d+)', 'TaskController@edit');

$router->get('/tasks/delete/(\d+)', 'TaskController@delete');

// comments
$router->get('/comments', 'CommentController@index');
$router->get('/comments/(\d+)', 'CommentController@show');

$router->get('/comments/create', 'CommentController@create');
$router->post('/comments/create', 'CommentController@create');

$router->get('/comments/edit/(\d+)', 'CommentController@edit');
$router->post('/comments/edit/(\d+)', 'CommentController@edit');

$router->get('/comments/delete/(\d+)', 'CommentController@delete');