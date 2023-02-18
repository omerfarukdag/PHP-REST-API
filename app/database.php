<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'php_api');
define('DB_USER', 'root');
define('DB_PASS', '');

try {
    $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
} catch (PDOException $e) {
    exit(json_encode(array('status' => 500, 'message' => 'Database connection error' . $e->getMessage())));
}

function user_exists($id): bool
{
    global $db;
    $query = $db->prepare('SELECT * FROM users WHERE id = ?');
    $query->execute([$id]);
    $query->fetch(PDO::FETCH_ASSOC);
    if ($query->rowCount()) {
        return true;
    } else {
        return false;
    }
}