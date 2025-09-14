<?php

use Core\Validator;
use Core\App;

$db = App::resolve('Core\Database');

$errors = [];

if (! Validator::string($_POST['body'], min: 1, max: 10)){
    $errors['body'] = 'Body needs to be between 1 and 1000 characters.';
}

if (! empty($errors)){
    view('notes/create.view.php', [
        'heading' => 'Create Note',
        'errors' => $errors
    ]);
}

if (empty($errors)) {
    $db->query('insert into notes(body, user_id) values (:body, :user_id)',[
        'body' => $_POST['body'],
        'user_id' => 4,
    ]);

    header('location: /notes');
    die();
}

