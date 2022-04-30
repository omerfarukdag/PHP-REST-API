<?php
error_reporting(0);
require 'db/connect.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
if (in_array($_SERVER['REQUEST_METHOD'], array('POST'))) {
    $data = json_decode(file_get_contents("php://input"));
    if ($data != null && $data->name != null && $data->country != null && $data->age != null) {
        $add = $db->exec("INSERT INTO `users` (`name`, `country`, `age`) VALUES ('$data->name', '$data->country', '$data->age')");
        if ($add) {
            http_response_code(201);
            echo json_encode(array('status' => 201, 'message' => 'User created successfully'));
        } else {
            http_response_code(500);
            echo json_encode(array('status' => 500, 'message' => 'User not created'));
        }
    } else {
        http_response_code(400);
        echo json_encode(array('status' => 400, 'message' => 'Bad request'));
    }
} else {
    http_response_code(405);
    echo json_encode(array('status' => 405, 'message' => 'Method not allowed'));
}
?>