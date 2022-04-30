<?php
$dbname = 'php-crud-restapi';
$dbuser = 'root';
$dbpass = '';
try {
    $db = new PDO('mysql:host=localhost;dbname=' . $dbname, $dbuser, $dbpass);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>