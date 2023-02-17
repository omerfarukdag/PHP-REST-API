<?php
header('Content-Type: application/json');

require_once __DIR__ . '/app/database.php';
require_once __DIR__ . '/app/router.php';

get('/api/users', function () {
    global $db;
    $data = $db->query('SELECT * FROM users')->fetchAll(PDO::FETCH_ASSOC);
    if ($data) {
        http_response_code(200);
        echo json_encode(array('status' => 200, 'data' => $data));
    }
});

get('/api/users/$id', function ($id) {
    global $db;
    $data = $db->prepare('SELECT * FROM users WHERE id = ?');
    $data->execute([$id]);
    $data = $data->fetch(PDO::FETCH_ASSOC);
    if ($data) {
        http_response_code(200);
        echo json_encode(array('status' => 200, 'data' => $data));
    } else {
        http_response_code(404);
        echo json_encode(array('status' => 404, 'message' => 'User not found'));
    }
});

post('/api/users', function () {
    global $db;

    $data = json_decode(file_get_contents('php://input'), true);
    $name = htmlspecialchars(trim($data['name']));
    $country = htmlspecialchars(trim($data['country']));
    $age = htmlspecialchars(trim($data['age']));

    if (!isset($name, $country, $age) || empty($name) || empty($country) || empty($age) || !is_numeric($age) || !is_string($name) || !is_string($country)) {
        http_response_code(400);
        exit(json_encode(array('status' => 400, 'message' => 'Bad request')));
    }

    $query = $db->prepare('INSERT INTO users SET name = ?, country = ?, age = ?');
    $query->execute([$name, $country, $age]);
    if ($query->rowCount()) {
        http_response_code(201);
        echo json_encode(['status' => 201, 'message' => 'User created successfully', 'data' => ['id' => $db->lastInsertId(), 'name' => $name, 'country' => $country, 'age' => $age]]);
    } else {
        http_response_code(500);
        echo json_encode(array('status' => 500, 'message' => 'An error occurred while creating user'));
    }
});

put('/api/users/$id', function ($id) {
    global $db;

    $data = json_decode(file_get_contents('php://input'), true);
    $name = htmlspecialchars(trim($data['name']));
    $country = htmlspecialchars(trim($data['country']));
    $age = htmlspecialchars(trim($data['age']));

    if (!isset($name, $country, $age) || empty($name) || empty($country) || empty($age) || !is_numeric($age) || !is_string($name) || !is_string($country)) {
        http_response_code(400);
        exit(json_encode(array('status' => 400, 'message' => 'Bad request')));
    }

    $query = $db->prepare('UPDATE users SET name = ?, country = ?, age = ? WHERE id = ?');
    $query->execute([$name, $country, $age, $id]);
    if ($query->rowCount()) {
        http_response_code(200);
        echo json_encode(array('status' => 200, 'message' => 'User updated successfully', 'data' => ['id' => $id, 'name' => $name, 'country' => $country, 'age' => $age]));
    } else {
        http_response_code(500);
        echo json_encode(array('status' => 500, 'message' => 'An error occurred while updating user'));
    }
});

delete('/api/users/$id', function ($id) {
    global $db;
    $query = $db->prepare('DELETE FROM users WHERE id = ?');
    $query->execute([$id]);
    if ($query->rowCount()) {
        http_response_code(200);
        echo json_encode(array('status' => 200, 'message' => 'User deleted successfully'));
    } else {
        http_response_code(500);
        echo json_encode(array('status' => 500, 'message' => 'An error occurred while deleting user'));
    }
});