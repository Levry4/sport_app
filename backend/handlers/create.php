<?php
$data = json_decode(file_get_contents('php://input'), true);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    echo json_encode(['success' => false, 'error' => 'Нет прав']);
    exit();
}

// Создаём спортсмена
$newAthlete = [
    'id' => getNextId(),
    'name' => $data['name'] ?? 'Без имени',
    'email' => $data['email'] ?? 'noemail@example.com',
    'login' => $data['email'] ?? 'noemail@example.com', // ЛОГИН = EMAIL
    'password' => '123', // ПАРОЛЬ ПО УМОЛЧАНИЮ
    'age' => $data['age'] ?? null,
    'sport_type' => $data['sport_type'] ?? null,
    'rank' => $data['rank'] ?? null,
    'team' => $data['team'] ?? null,
    'trainings_count' => 0,
    'role' => 'user', // РОЛЬ ПО УМОЛЧАНИЮ
    'bookings' => []
];

$athletes[] = $newAthlete;
incrementNextId();
saveAthletes($athletes);

http_response_code(201);
echo json_encode(['success' => true, 'data' => $newAthlete]);
?>