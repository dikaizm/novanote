<?php

use Core\App;
use Core\Database;
use Core\Validator;



$db = App::resolve(Database::class);

$currentUserId = $_SESSION['user']['id'];

$note = $db->query('select * from notes where id = :id', [
    'id' => $_POST['id']
])->findOrFail();

$notes = $db->query('select * from notes where user_id = :user_id', [
    'user_id' => $currentUserId
])->get();

authorize($note['user_id'] == $currentUserId);

$errors = [];

if (! Validator::string($_POST['body'])) {
    $errors['body'] = 'Require a body text';
};

if (count($errors)) {
    // return view('notes/index.view.php', [
    //     'errors' => $errors,
    //     'notes' => $notes
    // ]);
    $response = [
        'id' => $note['id'],
        'title' => $note['title'],
        'body' => $note['body']
    ];
    
    echo json_encode($response);
    exit;
}

$db->query('INSERT INTO notes(title, body, user_id) VALUES(:title, :body, :user_id)', [
    'title' => $_POST['title'],
    'body' => $_POST['body'],
    'user_id' => $_SESSION['user']['id'],
]);

header('location: /notes');
die();