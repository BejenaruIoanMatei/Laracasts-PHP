<?php

use Core\App;
use Core\Response;

$db = App::resolve('Core\Database');

$currentUserId = 4;

$note = $db->query('select * from notes where id = :id',[
    'id' => $_GET['id']
])->findOrFail();

authorize($note['user_id'] === $currentUserId, Response::FORBIDDEN);

view('notes/edit.view.php', [
    'heading' => 'Edit Note',
    'errors' => [],
    'note' => $note
]);