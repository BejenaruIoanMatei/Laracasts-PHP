<?php

use Core\Validator;
use Core\App;
use Core\Database;
use Core\Authenticator;

$email = $_POST['email'];
$password = $_POST['password'];

$errors = [];

if (! Validator::email($email))
{
    $errors['email'] = 'Please provide a valid email address.';
}

if (! Validator::string($password, 7, 10))
{
    $errors['password'] = 'Provide a password between 7 and 10 characters.';
}

if (! empty($errors))
{
    return view('registration/create.view.php',[
        'errors' => $errors
    ]);
}

$db = App::resolve(Database::class);

$user = $db->query('select * from users where email = :email',[
    'email' => $email
])->find();

if ($user){
    header('location: /');
    exit();

} else {
    $db->query('insert into users(email, password) values (:email, :password)',[
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT)
    ]);

    (new Authenticator)->login([
        'email' => $email
    ]);

    header('location: /');
    exit();
}