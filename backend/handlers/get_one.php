<?php
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id === 0) {
    http_response_code(400);
    echo json_encode(['error' => 'ID не указан']);
    exit();
}

checkAuth();

$found = null;
foreach ($athletes as $a) {
    if ($a['id'] === $id) {
        $found = $a;
        break;
    }
}

if ($found) {
    echo json_encode(['success' => true, 'data' => $found]);
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Спортсмен не найден']);
}
?>