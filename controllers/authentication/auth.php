<?php

use Core\App;
use Core\Database;
use Core\Validator;

$email = $_POST['email'];
$password = $_POST['password'];

// // validate the form inputs
$errors = [];

if (!Validator::email($email)) {
    $errors['email'] = 'Please provide a valid email address';
}

if (!Validator::string($password, 4, 255)) {
    $errors['password'] = 'Please provide a password of at least 4 characters';
}

if (! empty($errors)) {
    return view('authentication/login.view.php', [
        'errors' => $errors
    ]);
}

$db = App::resolve(Database::class);

// check if the account already exists
$user = $db->query('select * from users where email = :email and password = :password', [
    'email' => $email,
    'password' => $password
])->find();

if ($user) {
    // if true, then get name and id
    $name = null;
    $id = null;

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

    header('location: /notes');
    exit();
} else {
    // else alert for invalid email or unmatched password
    if (!$user) {
        $errors['email'] = 'Please provide a valid email address';
    }
    
    if (password_verify($password, $user['password'])) {
        $errors['password'] = 'Your password is invalid';
    }

    if (! empty($errors)) {
        return view('authentication/login.view.php', [
            'errors' => $errors,
        ]);
    }
}