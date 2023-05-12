<?php

$router->get('/', 'controllers/index.php');
$router->get('/about', 'controllers/about.php');
$router->get('/contact', 'controllers/contact.php');

$router->get('/notes', 'controllers/notes/index.php')->only('auth');
$router->post('/notes', 'controllers/notes/store.php');

// $router->get('/note', 'controllers/notes/show.php');
$router->delete('/notes', 'controllers/notes/destroy.php');

// $router->get('/note/edit', 'controllers/notes/index.php');
$router->patch('/notes', 'controllers/notes/update.php');

// $router->get('/notes/create', 'controllers/notes/create.php');
// $router->post('/notes', 'controllers/notes/store.php');

$router->get('/register', 'controllers/registration/create.php')->only('guest');
$router->post('/register', 'controllers/registration/store.php');

$router->get('/login', 'controllers/authentication/login.php')->only('guest');
$router->post('/login', 'controllers/authentication/auth.php');
$router->get('/logout', 'controllers/authentication/logout.php');