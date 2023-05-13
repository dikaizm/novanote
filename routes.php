<?php

$router->get('/', 'controllers/index.php');
$router->get('/about', 'controllers/about.php');
$router->get('/contact', 'controllers/contact.php');

$router->get('/notes', 'controllers/notes/index.php')->only('auth');
$router->post('/notes', 'controllers/notes/store.php');

$router->get('/notes/all', 'controllers/notes/show.php');
$router->delete('/notes', 'controllers/notes/destroy.php');

$router->post('/note/edit', 'controllers/notes/edit.php');
$router->post('/note/update', 'controllers/notes/update.php');

// $router->patch('/note/update', 'controllers/notes/update.php');
// $router->get('/notes/create', 'controllers/notes/create.php');
// $router->post('/notes', 'controllers/notes/store.php');

$router->get('/register', 'controllers/registration/create.php')->only('guest');
$router->post('/register', 'controllers/registration/store.php');

$router->get('/login', 'controllers/authentication/login.php')->only('guest');
$router->post('/login', 'controllers/authentication/auth.php');
$router->get('/logout', 'controllers/authentication/logout.php');