<?php
header('Content-Type: application/json');

require_once __DIR__ . '/app/database.php';
require_once __DIR__ . '/app/router.php';

function get_data(): ?array
{
    $data = json_decode(file_get_contents('php://input'), true);
    foreach ($data as $key => $value) {
        if (in_array($key, ['name', 'country'])) {
            if (!is_string($value) || empty($value)) {
                http_response_code(400);
                exit(json_encode(array('status' => 400, 'message' => 'Bad request')));
            } else {
                $data[$key] = htmlspecialchars(trim($value));
            }
        } else if ($key == 'age') {
            if (!is_numeric($value) || empty($value)) {
                http_response_code(400);
                exit(json_encode(array('status' => 400, 'message' => 'Bad request')));
            } else {
                $data[$key] = htmlspecialchars(trim($value));
            }
        }
    }
    return $data;
}

get('/api/users', function () {
    global $db;
    $data = $db->query('SELECT * FROM users')->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode(array('status' => 200, 'data' => $data));
});

get('/api/users/$id', function ($id) {
    global $db;
    $query = $db->prepare('SELECT * FROM users WHERE id = ?');
    $query->execute([$id]);
    $data = $query->fetch(PDO::FETCH_ASSOC);
    if ($query->rowCount()) {
        echo json_encode(array('status' => 200, 'data' => $data));
    } else {
        http_response_code(404);
        echo json_encode(array('status' => 404, 'message' => 'User not found'));
    }
});

post('/api/users', function () {
    global $db;
    $data = get_data();
    $query = $db->prepare('INSERT INTO users SET name = ?, country = ?, age = ?');
    $query->execute([$data['name'], $data['country'], $data['age']]);
    if ($query->rowCount()) {
        $data['id'] = $db->lastInsertId();
        http_response_code(201);
        echo json_encode(['status' => 201, 'data' => $data]);
    } else {
        http_response_code(500);
        echo json_encode(array('status' => 500, 'message' => 'Internal server error'));
    }
});

put('/api/users/$id', function ($id) {
    global $db;
    if (user_exists($id)) {
        $data = get_data();
        $query = $db->prepare('UPDATE users SET name = ?, country = ?, age = ? WHERE id = ?');
        $query->execute([$data['name'], $data['country'], $data['age'], $id]);
        if ($query->rowCount()) {
            $data['id'] = $id;
            echo json_encode(array('status' => 200, 'data' => $data));
        } else {
            http_response_code(500);
            echo json_encode(array('status' => 500, 'message' => 'Internal server error or no changes'));
        }
    } else {
        http_response_code(404);
        echo json_encode(array('status' => 404, 'message' => 'User not found'));
    }
});

_delete('/api/users/$id', function ($id) {
    global $db;
    if (user_exists($id)) {
        $query = $db->prepare('DELETE FROM users WHERE id = ?');
        $query->execute([$id]);
        if ($query->rowCount()) {
            echo json_encode(array('status' => 200, 'message' => 'User deleted'));
        } else {
            http_response_code(500);
            echo json_encode(array('status' => 500, 'message' => 'Internal server error'));
        }
    } else {
        http_response_code(404);
        echo json_encode(array('status' => 404, 'message' => 'User not found'));
    }
});