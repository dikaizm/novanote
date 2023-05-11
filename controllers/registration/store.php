<?php

use Core\App;
use Core\Database;
use Core\Validator;

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

// // validate the form inputs
$errors = [];

if (!Validator::string($name, 1, 255)) {
    $errors['name'] = 'Please fill your name';
}

if (!Validator::email($email)) {
    $errors['email'] = 'Please provide a valid email address';
}

if (!Validator::string($password, 4, 255)) {
    $errors['password'] = 'Please provide a password of at least 4 characters';
}

if (! empty($errors)) {
    return view('registration/create.view.php', [
        'errors' => $errors
    ]);
}

$db =  App::resolve(Database::class);

// check if the account already exists
$user = $db->query('select * from users where email = :email', [
    'email' => $email
])->find();

if ($user) {
    // if true, then register to a login page
    header('location: /login');
    exit();
} else {
    // else create account to the database, then log user in and redirect
    $db->query('INSERT INTO users(name, email, password) VALUES(:name, :email, :password)', [
        'name' => $name,
        'email' => $email,
        'password' => $password
    ]);

    // initialize name and id
    $name = null;
    $id = null;

    // get name and id
    $userData = $db->query('SELECT name, id FROM users WHERE email = :email', [
        'email' => $email,
    ])->find();

    if ($userData) {
        $name = $userData['name'];
        $id = $userData['id'];
    }

    // if true, then login
    session_start();
    $_SESSION['user'] = [
        'email' => $email,
        'name' => $name,
        'id' => $id
    ];

    header('location: /');
    exit();
}