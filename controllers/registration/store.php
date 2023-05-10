<?php

use Core\App;
use Core\Database;
use Core\Validator;

$email = $_POST['email'];
$password = $_POST['password'];

// validate the form inputs
$errors = [];

if (Validator::email($email)) {
    $errors['email'] = 'Please provide a valid email address';
}

if (! Validator::string($password, 8, 255)) {
    $errors['password'] = 'Please provide a password of at least 8 characters';
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
    header('location: /');
    exit();
} else {
    // else create account to the database, then log user in and redirect
    $db->query('INSERT INTO users(email, password) VALUES(:email, :password)', [
        'email' => $email,
        'password' => $password
    ]);

    // mark that the user has login
    $_SESSION['user'] = [
        'email' => $email
    ];

    header('location: /');
    exit();
}