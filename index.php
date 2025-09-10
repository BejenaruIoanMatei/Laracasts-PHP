<?php 

require 'functions.php';
require 'Database.php';
// require 'router.php';


$db = new Database();
$posts = $db->query('select * from notes')->fetchAll();

foreach ($posts as $post) {
    echo '<li>' . $post['body'] . '</li>';
}