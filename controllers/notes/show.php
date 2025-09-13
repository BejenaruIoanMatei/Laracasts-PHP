<?php

use Core\Database;
use Core\Response;

$config = require base_path('config.php');

$db = new Database($config['database']);

$currentUserId = 4;

$note = $db->query('select * from notes where id = :id',[
    'id' => $_GET['id']
])->findOrFail();

authorize($note['user_id'] === $currentUserId, Response::FORBIDDEN);

view('notes/show.view.php', [
    'heading' => 'Note',
    'note' => $note
]);