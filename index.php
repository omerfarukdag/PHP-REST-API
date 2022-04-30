<?php
error_reporting(0);
require 'db/connect.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
if (in_array($_SERVER['REQUEST_METHOD'], array('GET'))) {
    $data = $db->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);
    http_response_code(200);
    echo json_encode(array('status' => 200, 'data' => $data));
} else {
    http_response_code(405);
    echo json_encode(array('status' => 405, 'message' => 'Method Not Allowed'));
}
?>