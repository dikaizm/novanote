<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$currentUserId = $_SESSION['user']['id'];

$note = $db->query('select * from notes where id = :id', [
    'id' => $_POST['id']
])->findOrFail();

authorize($note['user_id'] == $currentUserId);

$db->query('delete from notes where id = :id', [
    'id' => $_POST['id'],
]);

header('location: /notes');
exit();