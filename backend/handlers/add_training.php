<?php
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id === 0) {
    http_response_code(400);
    echo json_encode(['error' => 'ID не указан']);
    exit();
}

// Проверяем авторизацию
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Не авторизован']);
    exit();
}

// Ищем и увеличиваем счетчик
$found = false;
foreach ($athletes as &$a) {
    if ($a['id'] === $id) {
        $a['trainings_count']++;
        $found = true;
        break;
    }
}

if ($found) {
    saveAthletes($athletes);
    echo json_encode(['success' => true, 'new_count' => $a['trainings_count']]);
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Спортсмен не найден']);
}
?>