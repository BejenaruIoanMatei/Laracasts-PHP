<?php 

require 'functions.php';
// require 'router.php';

$dsn = "mysql:host=127.0.0.1;port=3306;dbname=myapp;user=root;charset=utf8mb4";

$pdo = new PDO($dsn);

$statement = $pdo->prepare('select * from notes');

$statement->execute();

$posts = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach ($posts as $post) {
    echo '<li>' . $post['body'] . '</li>';
}