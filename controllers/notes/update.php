<?php

use Core\Response;
use Core\App;
use Core\Validator;

$db = App::resolve('Core\Database');

$currentUserId = 4;

$note = $db->query('select * from notes where id = :id',[
    'id' => $_POST['id']
])->findOrFail();

authorize($note['user_id'] === $currentUserId, Response::FORBIDDEN);

$errors = [];


if (! Validator::string($_POST['body'], min: 1, max: 1000)){
    $errors['body'] = 'Body needs to be between 1 and 1000 characters.';
}

if (count($errors)){
    return view('notes/edit.view.php', [
        'heading' => 'Edit Note',
        'errors' => $errors,
        'note' => $note
    ]);
}

$db->query('update notes set body = :body where id = :id',[
    'id' => $_POST['id'],
    'body' => $_POST['body'],
]);

header('location: /notes');
die();
