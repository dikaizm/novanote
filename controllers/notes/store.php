<?php

use Core\App;
use Core\Validator;
use Core\Database;

$db = App::resolve(Database::class);

$currentUserId = $_SESSION['user']['id'];

$notes = $db->query('select * from notes where user_id = :user_id', [
    'user_id' => $currentUserId
])->get();

$errors = [];

if (! Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'Require a body text of no more than 1,000 characters.';
};

if (! empty($errors)) {
    return view("notes/index.view.php", [
        'errors' => $errors,
        'notes' => $notes
    ]);
}

if (empty($errors)) {
    $db->query('INSERT INTO notes(title, body, user_id) VALUES(:title, :body, :user_id)', [
        'title' => $_POST['title'],
        'body' => $_POST['body'],
        'user_id' => $_SESSION['user']['id'],
    ]);

    header('location: /notes');
    die();
}