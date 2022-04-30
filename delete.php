<?php
error_reporting(0);
require 'db/connect.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
if (in_array($_SERVER['REQUEST_METHOD'], array('DELETE'))) {
    if ($_GET['id'] != null) {
        $id = $_GET['id'];
        $delete = $db->exec("DELETE FROM `users` WHERE `id` = $id");
        if ($delete) {
            http_response_code(200);
            echo json_encode(array('status' => 200, 'message' => 'User deleted successfully'));
        } else {
            http_response_code(500);
            echo json_encode(array('status' => 500, 'message' => 'User not deleted'));
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