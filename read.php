<?php
error_reporting(0);
require 'db/connect.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
if (in_array($_SERVER['REQUEST_METHOD'], array('GET'))) {
    if ($_GET['id'] != null) {
        $id = $_GET['id'];
        $data = $db->query("SELECT * FROM `users` WHERE `id` = '$id'")->fetchAll(PDO::FETCH_ASSOC);
        if ($data) {
            http_response_code(200);
            echo json_encode(array('status' => 200, 'data' => $data));
        } else {
            http_response_code(404);
            echo json_encode(array('status' => 404, 'message' => 'User not found'));
        }
    } else {
        http_response_code(400);
        echo json_encode(array('status' => 400, 'message' => 'Bad Request'));
    }
} else {
    http_response_code(405);
    echo json_encode(array('status' => 405, 'message' => 'Method Not Allowed'));
}
?>