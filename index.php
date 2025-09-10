<?php 

require 'functions.php';
require 'Database.php';
// require 'router.php';

$config = require 'config.php';

$db = new Database($config);
$posts = $db->query('select * from notes')->fetchAll();

foreach ($posts as $post) {
    echo '<li>' . $post['body'] . '</li>';
}