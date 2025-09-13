<?php

require 'Validator.php';

$config = require 'config.php';
$db = new Database($config['database']);

$heading = 'Create Note';

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $errors = [];

    if (! Validator::string($_POST['body'], min: 1, max: 10)){
        $errors['body'] = 'Body needs to be between 1 and 1000 characters.';
    }

    if (empty($errors)) {
        $db->query('insert into notes(body, user_id) values (:body, :user_id)',[
            'body' => $_POST['body'],
            'user_id' => 4,
        ]);
    }

}

require 'views/notes/create.view.php';