<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$currentUserId = $_SESSION['user']['id'];

$note = $db->query('select * from notes where id = :id', [
    'id' => $_POST['id']
])->findOrFail();

authorize($note['user_id'] == $currentUserId);

$inputData = json_decode($_POST['inputData'], true);

$db->query('UPDATE notes SET title = :title, body = :body WHERE id = :id', [
    'id' => $_POST['id'],
    'title' => $inputData['note-title'],
    'body' => $inputData['note-body'],
]);

die();