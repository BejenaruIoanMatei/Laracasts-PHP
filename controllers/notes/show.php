<?php

use Core\Response;
use Core\App;

$db = App::resolve('Core\Database');

$currentUserId = 4;

$note = $db->query('select * from notes where id = :id',[
    'id' => $_GET['id']
])->findOrFail();

authorize($note['user_id'] === $currentUserId, Response::FORBIDDEN);

view('notes/show.view.php', [
    'heading' => 'Note',
    'note' => $note
]);

