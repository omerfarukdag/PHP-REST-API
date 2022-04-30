<?php
error_reporting(0);
require 'db/connect.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT,PATCH');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
if (in_array($_SERVER['REQUEST_METHOD'], array('PUT', 'PATCH'))) {
    $data = json_decode(file_get_contents("php://input"));
    if ($_GET['id'] != null && $data != null && $data->name != null && $data->country != null && $data->age != null) {
        $id = $_GET['id'];
        $edit = $db->exec("UPDATE `users` SET `name` = '$data->name', `country` = '$data->country', `age` = '$data->age' WHERE `id` = '$id'");
        if ($edit) {
            http_response_code(200);
            echo json_encode(array('status' => 200, 'message' => 'User updated successfully'));
        } else {
            http_response_code(500);
            echo json_encode(array('status' => 500, 'message' => 'User not updated'));
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
