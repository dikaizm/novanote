<?php

use Core\App;
use Core\Validator;
use Core\Database;

$db = App::resolve(Database::class);

$currentUserId = $_SESSION['user']['id'];

$inputData = json_decode($_POST['inputData'], true);

$errors = [];

if (! Validator::string($inputData['body'])) {
    $errors['body'] = 'Require a body text';
};

if (! empty($errors)) {
    $response = json_encode($errors);
    
    echo $response;
    die();
} else {
    
    $db->query('INSERT INTO notes(title, body, user_id) VALUES(:title, :body, :user_id)', [
        'title' => $inputData['title'],
        'body' => $inputData['body'],
        'user_id' => $_SESSION['user']['id'],
    ]);

    $errors['body'] = 'true';
    $response = json_encode($errors);
    echo $response;

    die();
}